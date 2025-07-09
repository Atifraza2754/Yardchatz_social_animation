// Updated video_call.js based on working audio_call.js structure
document.addEventListener("DOMContentLoaded", () => {
    const localVideo = document.getElementById("localVideo");
    const remoteVideo = document.getElementById("remoteVideo");
    const receiveBtn = document.getElementById("receiveBtn");
    const hangupBtn = document.getElementById("hangupBtn");
    const recordBtn = document.getElementById("recordBtn");
    const recordTimer = document.getElementById("recordTimer");

    let peer, localStream;
    let remoteDescSet = false;
    let offerSent = false;
    let callConnected = false;
    let iceQueue = [];

    let mediaRecorder, recordedChunks = [];
    let recordingStartTime, recordInterval, isRecording = false, callStartTime = null;

    let ringtoneAudio = null;

    function playCustomRingtone(file) {
        if (ringtoneAudio || !file) return;
        ringtoneAudio = new Audio(`/ringtones/${file}`);
        ringtoneAudio.loop = true;
        ringtoneAudio.play().catch(console.warn);
    }

    function stopRingtone() {
        if (ringtoneAudio) {
            ringtoneAudio.pause();
            ringtoneAudio.currentTime = 0;
            ringtoneAudio = null;
        }
    }

    function getCallDuration() {
        return callStartTime ? Math.floor((Date.now() - callStartTime) / 1000) : 0;
    }

    function toggleCallControls(show = false, recordingAllowed = false) {
        hangupBtn.style.display = show ? "inline-block" : "none";
        recordBtn.style.display = (show && recordingAllowed && callConnected) ? "inline-block" : "none";

        if (!show || !recordingAllowed) {
            recordTimer.style.display = "none";
            stopRecording();
        }
    }

    function createPeerConnection() {
        const pc = new RTCPeerConnection({
            iceServers: [{ urls: "stun:stun.l.google.com:19302" }]
        });

        pc.ontrack = (event) => {
            remoteVideo.srcObject = event.streams[0];
        };

        pc.onicecandidate = (e) => {
            if (e.candidate) {
                axios.post("/signal/candidate", { candidate: e.candidate });
            }
        };

        return pc;
    }

    const urlParts = window.location.pathname.split("/");
    const TARGET_USER_ID = parseInt(urlParts[urlParts.length - 1]);

    window.startCall = async function () {
        if (offerSent) return;
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;

        peer = createPeerConnection();
        localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

        const offer = await peer.createOffer();
        await peer.setLocalDescription(offer);
        callStartTime = Date.now();
        offerSent = true;
        toggleCallControls(true, false);

        try {
            const response = await axios.post("/signal/offer", {
                type: offer.type,
                sdp: offer.sdp,
                receiver_id: TARGET_USER_ID,
                call_type: 'video'
            });

            const receiverRingtone = response.data?.receiver_ringtone;
            if (receiverRingtone) playCustomRingtone(receiverRingtone);
        } catch (err) {
            console.error("Offer send failed:", err);
        }
    };

    async function handleReceiveCall() {
        try {
            receiveBtn.style.display = "none";
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            localVideo.srcObject = localStream;

            peer = createPeerConnection();
            localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

            const offer = window.pendingOffer;
            await peer.setRemoteDescription(new RTCSessionDescription(offer));
            callStartTime = Date.now();
            const answer = await peer.createAnswer();
            await peer.setLocalDescription(answer);
            axios.post("/signal/answer", {
                type: answer.type,
                sdp: answer.sdp,
                call_type: 'video'
            });

            remoteDescSet = true;
            callConnected = true;
            toggleCallControls(true, true);

            while (iceQueue.length) {
                peer.addIceCandidate(new RTCIceCandidate(iceQueue.shift()));
            }
        } catch (err) {
            console.error("Error in handleReceiveCall:", err);
        }
    }

    receiveBtn.addEventListener("click", handleReceiveCall);

    hangupBtn.addEventListener("click", () => {
        if (peer) peer.close();
        peer = null;
        offerSent = false;
        callConnected = false;
        localVideo.srcObject = null;
        remoteVideo.srcObject = null;
        toggleCallControls(false);
        stopRingtone();

        axios.post('/signal/hangup', {
            receiver_id: TARGET_USER_ID,
            duration: getCallDuration(),
            call_type: 'video'
        }).finally(() => {
            window.location.href = "/users";
        });
    });

    recordBtn.addEventListener("click", () => {
        isRecording ? stopRecording() : startRecording();
    });

    window.Echo.channel("video-call")
        .listen(".offer", (e) => {
            if (!offerSent && !callConnected) {
                window.pendingOffer = e;
                receiveBtn.style.display = "inline-block";
            }
        })
        .listen(".answer", async (e) => {
            stopRingtone();
            if (peer && peer.signalingState === "have-local-offer") {
                await peer.setRemoteDescription(new RTCSessionDescription(e));
                remoteDescSet = true;
                callConnected = true;
                toggleCallControls(true, true);
            }
        })
        .listen(".ice-candidate", (e) => {
            const candidate = e;
            if (candidate?.candidate?.includes(":")) {
                const rtcCandidate = new RTCIceCandidate({
                    candidate: candidate.candidate,
                    sdpMid: candidate.sdpMid,
                    sdpMLineIndex: candidate.sdpMLineIndex,
                });
                if (remoteDescSet) {
                    peer.addIceCandidate(rtcCandidate).catch(console.error);
                } else {
                    iceQueue.push(rtcCandidate);
                }
            }
        })
        .listen(".hangup", (e) => {
            if (e.receiverId !== window.Laravel.userId) return;

            if (peer) peer.close();
            peer = null;
            offerSent = false;
            callConnected = false;
            localVideo.srcObject = null;
            remoteVideo.srcObject = null;
            toggleCallControls(false);
            stopRingtone();

            const modal = document.getElementById("incomingCallModal");
            if (modal) modal.style.display = "none";
            if (receiveBtn) receiveBtn.style.display = "none";
        });

    function startRecording() {
        recordedChunks = [];
        recordBtn.style.backgroundColor = "red";

        const canvas = document.createElement("canvas");
        canvas.width = 640;
        canvas.height = 480;
        const ctx = canvas.getContext("2d");
        const fps = 30;

        const drawFrame = () => {
            ctx.drawImage(remoteVideo, 0, 0, canvas.width, canvas.height);
            ctx.drawImage(localVideo, canvas.width - 160, canvas.height - 120, 150, 100);
        };

        recordInterval = setInterval(drawFrame, 1000 / fps);
        const canvasStream = canvas.captureStream(fps);

        const audioTracks = localStream.getAudioTracks();
        if (audioTracks.length > 0) canvasStream.addTrack(audioTracks[0]);

        try {
            mediaRecorder = new MediaRecorder(canvasStream);
        } catch (e) {
            console.error("MediaRecorder error:", e);
            alert("Media recording not supported.");
            return;
        }

        mediaRecorder.ondataavailable = (event) => {
            if (event.data.size > 0) recordedChunks.push(event.data);
        };

        mediaRecorder.onstop = () => {
            const blob = new Blob(recordedChunks, { type: mediaRecorder.mimeType });
            const url = URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "video_call_recording.webm";
            a.click();
            URL.revokeObjectURL(url);
        };

        mediaRecorder.start();
        recordBtn.textContent = "Stop Recording";
        recordTimer.style.display = "inline";
        startTimer();
        isRecording = true;
    }

    function stopRecording() {
        if (!mediaRecorder) return;
        mediaRecorder.stop();
        stopTimer();
        recordBtn.textContent = "Start Recording";
        recordTimer.style.display = "none";
        recordBtn.style.backgroundColor = "green";
        isRecording = false;
    }

    function startTimer() {
        recordingStartTime = Date.now();
        recordInterval = setInterval(() => {
            const elapsed = Math.floor((Date.now() - recordingStartTime) / 1000);
            const minutes = String(Math.floor(elapsed / 60)).padStart(2, "0");
            const seconds = String(elapsed % 60).padStart(2, "0");
            recordTimer.textContent = `${minutes}:${seconds}`;
        }, 1000);
    }

    function stopTimer() {
        clearInterval(recordInterval);
    }
});
