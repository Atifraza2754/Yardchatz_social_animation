@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
    }
     body {
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');
}

    .icon {
        position: relative;
    }

    .map-text {
        display: none;
        position: absolute;
        top: -50px;
        left: 5%;
        transform: translateX(-50%);
        color: #fff;
        z-index: 9999;
        background-color: #2d6a30;
        color: white;

        font-size: 22px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 7px 21px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: transform 0.3s ease;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .icon:hover+.map-text {
        display: block;
    }

    span.map-text.Radio-text {
        left: 15%;
    }

    span.map-text.music {
        left: 26%;
    }

    span.map-text.feed {
        left: 36%;
    }

    span.map-text.cameras {
        left: 46%;
    }

    span.map-text.Room {
        left: 57%;
    }

    span.map-text.Friends {
        left: 67%;
    }

    span.map-text.name {
        left: 77%;
    }

    span.map-text.setting {
        left: 87%;
    }

    span.map-text.fam {
        left: 96%;
    }

    /* .navbar .icon {
            width: 10%;
        } */

    .container {
        height: 100vh;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    /* Profile Section Styles */
    .profile-section {
        padding: 80px 40px;
        position: relative;
        z-index: 2;
        margin-left:40%;
    }

    .apple-container {
        width: 11%;
        height: 135px;
        position: relative;
    }

    .golden-apple {
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('assets/img/Clippathscdsdgroup.svg') }}');
        border-radius: 50%;
        position: relative;
        animation: pulse 2s infinite ease-in-out;
        transform: rotate(3deg);
        transition: transform 0.3s;
        background-repeat: no-repeat;
    }

    .golden-apple:hover {
        transform: rotate(12deg);
    }

    .phone-icon {
        position: absolute;
        top: -8px;
        right: -50px;
        width: 62px;
        height: 62px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .phone-svg {
        width: 20px;
        height: 20px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
    }

    .name-tag {
        margin-top: 8px;
        background: rgba(255, 255, 255, 0.8);
        padding: 8px 16px;
        border-radius: 4px;
        display: inline-block;
    }

    .name-tag h2 {
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1px;
        color: #000;
    }

    /* Navigation Styles */
    .navigation {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to right, rgba(139, 0, 0, 0.8), rgba(165, 42, 42, 0.8));
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .nav-item:hover {
        transform: scale(1.1);
    }

    .icon {
        width: 24px;
        height: 24px;
        margin-bottom: 4px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .nav-item span {
        color: white;
        font-size: 12px;
        opacity: 0.8;
    }

    /* Icon specific styles */
    .settings-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%239B5DE5" viewBox="0 0 24 24"><path d="M12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>');
    }

    .music-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23333" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/></svg>');
    }

    .map-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%234CAF50" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/></svg>');
    }

    .profile-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%234299E1" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/></svg>');
    }

    .friends-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23F56565" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>');
    }

    .rooms-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23FFFFFF" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>');
    }

    .feed-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23D1D5DB" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2z"/></svg>');
    }

    .cameras-icon {
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" fill="%23333" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/></svg>');
    }

    /* Animations */
    .icon-animate {
    animation: pulse 1.2s infinite ease-in-out;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.15);
    }
    100% {
        transform: scale(1);
    }
}
     
    
     .call-action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .call-action-buttons button {
        padding: 10px 16px;
        font-weight: bold;
        border-radius: 5px;
        border: none;
        color: white;
    }

    #recordBtn {
        background-color: green;
    }

    #hangupBtn {
        background-color: red;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo@1.11.3/dist/echo.iife.js"></script>

<script>
    window.Pusher = Pusher;
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '2d1bf5af3517b2dc31df',
        cluster: 'ap2',
        wsHost: window.location.hostname,
        wsPort: 6001,
        forceTLS: false,
        disableStats: true,
        enabledTransports: ['ws', 'wss']
    });
    axios.defaults.headers.common['X-CSRF-TOKEN'] =
        document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>

<div class="container">
    <audio id="localAudio" autoplay muted></audio>
    <audio id="remoteAudio" autoplay></audio>
    <!-- Top Section -->
    <div class="profile-section">
        <div class="apple-container">
            <div class="golden-apple">
                <div class="phone-icon">
                    <svg viewBox="0 0 24 24" class="phone-svg">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                    </svg>
                </div>
            </div>
        </div>

    <div class="name-tag">
        <h2>{{ $user->name }}</h2>
    </div>
        <div class="call-action-buttons">
            <button id="receiveBtn" style="display: none;">Receive Call</button>
            <button id="recordBtn" style="display: none;">Start Recording</button>
            <button id="hangupBtn" style="display: none;">Leave</button>
            <span id="recordTimer" style="display: none; color: red; font-weight: bold;">00:00</span>
        </div>

    </div>

    @include('frontend.layout.navbar')
</div>

<script src="{{ asset('assets/js/audio_call.js') }}"></script>

<script>
    window.onload = function () {
        const params = new URLSearchParams(window.location.search);
        if (params.get('autocall') === '1') {
            startCall();
        } else if (params.get('autoanswer') === '1') {
            const offerData = JSON.parse(localStorage.getItem('pending_offer'));
            if (offerData) {
                window.pendingOffer = offerData;
                document.getElementById('receiveBtn').click();
                localStorage.removeItem('pending_offer');
            }
        }
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.classList.add('bouncing');
            });
            item.addEventListener('mouseleave', () => {
                item.classList.remove('bouncing');
            });
        });

        const goldenApple = document.querySelector('.golden-apple');
        goldenApple.addEventListener('click', () => {
            goldenApple.style.transform = 'rotate(360deg)';
            setTimeout(() => {
                goldenApple.style.transform = 'rotate(3deg)';
            }, 1000);
        });
    });
</script>
@include('frontend.layout.footer')