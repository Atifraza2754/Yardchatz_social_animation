document.addEventListener("DOMContentLoaded", () => {
    const localAudio = document.getElementById("localAudio");
    const remoteAudio = document.getElementById("remoteAudio");
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
            remoteAudio.srcObject = event.streams[0];
        };

        pc.onicecandidate = (e) => {
            if (e.candidate) {
                axios.post("/audio-signal/candidate", { candidate: e.candidate });
            }
        };

        return pc;
    }

    const urlParts = window.location.pathname.split("/");
    const TARGET_USER_ID = parseInt(urlParts[urlParts.length - 1]);

    window.startCall = async function () {
        if (offerSent) return;
        localStream = await navigator.mediaDevices.getUserMedia({ audio: true });
        localAudio.srcObject = localStream;

        peer = createPeerConnection();
        localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

        const offer = await peer.createOffer();
        await peer.setLocalDescription(offer);
        callStartTime = Date.now();
        offerSent = true;
        toggleCallControls(true, false);

        try {
            const response = await axios.post("/audio-signal/offer", {
                type: offer.type,
                sdp: offer.sdp,
                receiver_id: TARGET_USER_ID,
                call_type: 'audio'
            });

            const receiverRingtone = response.data?.receiver_ringtone;
            if (receiverRingtone) {
                playCustomRingtone(receiverRingtone);
            }
        } catch (err) {
            console.error("Offer send failed:", err);
        }
    };

    async function handleReceiveCall() {
        try {
            receiveBtn.style.display = "none";
            localStream = await navigator.mediaDevices.getUserMedia({ audio: true });
            localAudio.srcObject = localStream;

            peer = createPeerConnection();
            localStream.getTracks().forEach(track => peer.addTrack(track, localStream));

            const offer = window.pendingOffer;
            await peer.setRemoteDescription(new RTCSessionDescription(offer));
            callStartTime = Date.now();
            const answer = await peer.createAnswer();
            await peer.setLocalDescription(answer);
            axios.post("/audio-signal/answer", {
                type: answer.type,
                sdp: answer.sdp,
                call_type: 'audio'
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
        localAudio.srcObject = null;
        remoteAudio.srcObject = null;
        toggleCallControls(false);
        stopRingtone();

        axios.post('/audio-signal/hangup', {
            receiver_id: TARGET_USER_ID,
            duration: getCallDuration(),
            call_type: 'audio'
        }).finally(() => {
            window.location.href = "/users";
        });
    });

    recordBtn.addEventListener("click", () => {
        isRecording ? stopRecording() : startRecording();
    });

    window.Echo.channel("audio-call")
        .listen(".audio-offer", (e) => {
            if (!offerSent && !callConnected) {
                window.pendingOffer = e;
                receiveBtn.style.display = "inline-block";
            }
        })
        .listen(".audio-answer", async (e) => {
            stopRingtone();
            if (peer && peer.signalingState === "have-local-offer") {
                await peer.setRemoteDescription(new RTCSessionDescription(e));
                remoteDescSet = true;
                callConnected = true;
                toggleCallControls(true, true);
            }
        })
        .listen(".audio-ice-candidate", (e) => {
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
.listen(".audio-hangup", (e) => {
    if (e.receiverId !== window.Laravel.userId) return;

    if (peer) peer.close();
    peer = null;
    offerSent = false;
    callConnected = false;
    localAudio.srcObject = null;
    remoteAudio.srcObject = null;
    toggleCallControls(false);
    stopRingtone();

    const modal = document.getElementById("incomingCallModal");
    if (modal) modal.style.display = "none";
    const receiveBtn = document.getElementById("receiveBtn");
    if (receiveBtn) receiveBtn.style.display = "none";
});


    function startRecording() {
        recordedChunks = [];
        recordBtn.style.backgroundColor = "red";

        const audioStream = new MediaStream();
        localStream.getAudioTracks().forEach(track => audioStream.addTrack(track));

        try {
            mediaRecorder = new MediaRecorder(audioStream);
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
            a.download = "audio_call_recording.mp3";
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
