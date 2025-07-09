document.addEventListener("DOMContentLoaded", () => {
    let ringtoneAudio = null;
    let pendingOffer = null;

    function playRingtoneLoop(file) {
        if (ringtoneAudio || !file) return;
        ringtoneAudio = new Audio(`/ringtones/${file}`);
        ringtoneAudio.loop = true;
        ringtoneAudio.muted = true;
        ringtoneAudio.play().then(() => {
            ringtoneAudio.muted = false;
        }).catch(console.warn);
    }

    function stopRingtone() {
        if (ringtoneAudio) {
            ringtoneAudio.pause();
            ringtoneAudio.currentTime = 0;
            ringtoneAudio = null;
        }
    }

    function showModal(callType, offerData) {
        const modal = document.getElementById('incomingCallModal');
        modal.style.display = 'flex';

        const videoIcon = document.querySelector('.video-icon');
        const videoDecline = document.getElementById('declineVideoBtn');
        const audioIcon = document.querySelector('.phone-icon');
        const audioDecline = document.getElementById('declineAudioBtn');

        if (callType === 'video') {
            videoIcon.style.display = '';
            videoDecline.style.display = '';
            videoIcon.classList.add('icon-animate');
            videoDecline.classList.add('icon-animate');
            videoIcon.style.pointerEvents = 'auto';
            videoDecline.style.pointerEvents = 'auto';

            audioIcon.style.display = 'none';
            audioDecline.style.display = 'none';
            audioIcon.style.pointerEvents = 'none';
            audioDecline.style.pointerEvents = 'none';
        } else {
            audioIcon.style.display = '';
            audioDecline.style.display = '';
            audioIcon.classList.add('icon-animate');
            audioDecline.classList.add('icon-animate');
            audioIcon.style.pointerEvents = 'auto';
            audioDecline.style.pointerEvents = 'auto';

            videoIcon.style.display = 'none';
            videoDecline.style.display = 'none';
            videoIcon.style.pointerEvents = 'none';
            videoDecline.style.pointerEvents = 'none';
        }

        document.querySelector('.caller-profile-container .profile-image').src =
            offerData.caller_picture ? `/${offerData.caller_picture}` : `/assets/img/person.png`;

        document.querySelector('.caller-profile-container + .call-name').textContent =
            offerData.caller_name || 'Unknown';
    }

    function hideModal() {
        const modal = document.getElementById('incomingCallModal');
        modal.style.display = 'none';
        stopRingtone();
        document.querySelectorAll('.icon-animate').forEach(el => el.classList.remove('icon-animate'));
    }

    function handleHangup(callType) {
        stopRingtone();
        hideModal();
        const url = callType === 'audio' ? '/audio-signal/hangup' : '/signal/hangup';
        axios.post(url, {
            receiver_id: pendingOffer?.from_user_id || null,
            duration: 0
        }).catch(err => console.warn("Failed to send hangup:", err));
    }

    // Accept buttons
    document.getElementById("acceptAudioCallBtn").addEventListener("click", function () {
        stopRingtone();
        hideModal();
        localStorage.setItem("pending_offer", JSON.stringify(pendingOffer));
        const receiverUserId = pendingOffer.from_user_id;
        window.location.href = `/audio_cal/${receiverUserId}?autoanswer=1`;
    });

    document.getElementById("acceptCallBtn").addEventListener("click", function () {
        stopRingtone();
        hideModal();
        localStorage.setItem("pending_offer", JSON.stringify(pendingOffer));
        const receiverUserId = pendingOffer.from_user_id;
        window.location.href = `/video_cal/${receiverUserId}?autoanswer=1`;
    });

    // Decline buttons
    document.getElementById("declineAudioBtn").addEventListener("click", () => {
        handleHangup('audio');
    });

    document.getElementById("declineVideoBtn").addEventListener("click", () => {
        handleHangup('video');
    });

    // ✅ VIDEO CALL LISTENER
    window.Echo.channel("video-call")
        .listen(".offer", (e) => {
            if (e.receiver_id === window.Laravel.userId && e.call_type === "video" && !window.isCaller) {
                pendingOffer = e;
                showModal('video', e);
                if (e.receiver_ringtone) playRingtoneLoop(e.receiver_ringtone);
            }
        })
        .listen(".hangup", () => {
            stopRingtone();
            hideModal();
            window.location.href = "/users";
        });

    // ✅ AUDIO CALL LISTENER
    window.Echo.channel("audio-call")
        .listen(".audio-offer", (e) => {
            if (e.receiver_id === window.Laravel.userId && e.call_type === "audio" && !window.isCaller) {
                pendingOffer = e;
                showModal('audio', e);
                if (e.receiver_ringtone) playRingtoneLoop(e.receiver_ringtone);
            }
        })
        .listen(".audio-hangup", () => {
            stopRingtone();
            hideModal();
            window.location.href = "/users";
        });
});
