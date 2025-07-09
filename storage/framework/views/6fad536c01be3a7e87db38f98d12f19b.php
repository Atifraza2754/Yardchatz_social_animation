 <?php echo $__env->make('frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <style>
    @import url('https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #000;
        font-family: Arial, sans-serif;
        color: white;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .video-container {
        position: relative;
        width: 100%;
        /* max-width: 1200px; */
        /* margin: 20px auto; */
        background: #000;
        height: 63vh;
    }

    #liveVideo {
        width: 100%;
        height: 85vh;
        object-fit: cover;
        background: #1a1a1a;
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 20px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), transparent);
        z-index: 2;
    }

    .video-title {
        font-family: 'Bubblegum Sans', cursive;
        font-size: 2.5em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        text-align: center;
    }


    .live-indicator {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #e74c3c;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 0.9em;
        z-index: 2;
    }

    .live-indicator::before {
        content: "●";
        color: white;
        margin-right: 5px;
        animation: blink 1s infinite;
    }

    .controls {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 3;
    }

    .start-button {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .start-button:hover {
        background: #c0392b;
    }

    .error-message {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(231, 76, 60, 0.9);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        display: none;
        z-index: 4;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.3;
        }

        100% {
            opacity: 1;
        }
    }


    .name-label {
        background: rgba(200, 200, 200, 0.9);
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        white-space: nowrap;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .name-label a {
        text-decoration: none;
        color: inherit;
        display: block;
        pointer-events: auto;
        /* Add this line */
    }

    .name-label a:hover {
        text-decoration: underline;
    }

    .navbar .icon {
        width: 11% !important;
    }


    .interaction-icons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        gap: 10px;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    /* .icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transform: scale(0);
        transition: transform 0.3s ease;
    } */

    .profile-card.active .interaction-icons {
        opacity: 1;
        visibility: visible;
    }

    .profile-card.active .icon {
        transform: scale(1);
    }

    .profile-card.active .icon:nth-child(1) {
        transition-delay: 0s;
    }

    .profile-card.active .icon:nth-child(2) {
        transition-delay: 0.1s;
    }

    .profile-card.active .icon:nth-child(3) {
        transition-delay: 0.2s;
    }

    .profile-card.active .profile-image {
        transform: scale(0.9);
        filter: brightness(0.7);
    }

    /* .icon:hover {
        transform: scale(1.1) !important;
        background: #f0f0f0;
    } */

    .navigation {
        display: flex;
        justify-content: space-around;
        padding: 15px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
        border-radius: 15px;
        position: relative;
        margin-top: auto;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        text-decoration: none;
        gap: 8px;
        transition: transform 0.2s;
    }

    .nav-icon {
        width: 45px;
        height: 45px;
        position: relative;
        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.3));
    }

    .nav-icon::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 20px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
    }

    .phone-icon {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 35px;
        height: 35px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .chat-bubble {
        position: absolute;
        top: -5px;
        left: 20px;
        width: 35px;
        height: 35px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .nav-text {
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #myBtn {
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: transparent;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }

    .links {
        display: flex;
        gap: 70px;
        text-align: center;
        justify-content: center;
        padding: 16px 0px;
        font-size: 35px;
        color: #fff;
    }

    .gallery {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 1rem;
        flex-wrap: wrap;
        gap: 10rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .section:hover {
        transform: translateY(-10px);
    }

    .title {
        font-family: 'Cinzel Decorative', cursive;
        color: white;
        font-size: 2.5rem;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }

    .section:hover .title {
        opacity: 1;
    }

        .live-indicator {
            display: none; 
        }

    .image-wrapper {
        width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 10px;
        position: relative;
    }

    .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .section:hover .image {
        transform: scale(1.1);
    }

    @media (max-width: 1200px) {
        .gallery {
            padding: 1rem;
        }

        .image-wrapper {
            width: 150px;
            height: 150px;
        }

        .title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .gallery {
            flex-direction: column;
        }

        .section {
            width: 100%;
            max-width: 300px;
        }

        .image-wrapper {
            width: 100%;
            height: 200px;
        }
    }

    @media screen and (max-width: 896px) and (orientation: landscape) {
        .gallery {
            gap: 0 !important;
            bottom: 30px;
        }

        .section {
            gap: 0rem;
            transition: transform 0.3s ease;
        }
    }

</style>

<div class="gallery">
    <a href="<?php echo e(route('signal_audio')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Audio</h2>
        </div>
    </a>
    <a href="<?php echo e(route('stills')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Stills</h2>
        </div>
    </a>
    <a href="<?php echo e(route('text_upload')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Text</h2>
        </div>
    </a>
    <a href="<?php echo e(route('live_page')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Video</h2>
        </div>
    </a>
    <a href="<?php echo e(route('live_screen')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Live</h2>
        </div>
    </a>
</div>



 <div class="video-container">
    <video id="liveVideo" autoplay playsinline></video>
    <div class="controls">
      <button class="start-button" id="toggleStreamButton">Start Streaming</button>
    </div>
    <div class="live-indicator" id="liveIndicator">LIVE</div>
  </div>


<?php echo $__env->make('frontend.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const appId = "e5388ed01e1d4689bf2880469b3c4703";
const channel = "<?php echo e($channel); ?>";
let client = AgoraRTC.createClient({ mode: "live", codec: "vp8" });
let localTracks = [], uid, isStreaming = false;

const button = document.getElementById("toggleStreamButton");
const indicator = document.getElementById("liveIndicator");
const videoEl = document.getElementById("liveVideo");

button.addEventListener("click", async () => {
  if (!isStreaming) {
    try {
      const res = await $.get('/api/agora/token', { channel, role: 'host' });
      uid = res.uid;

      await client.join(appId, channel, res.token, uid);
      await client.setClientRole("host");

      localTracks = await AgoraRTC.createMicrophoneAndCameraTracks();
      localTracks[0].setMuted(false); // Enable audio
      videoEl.muted = false;
      localTracks[1].play("liveVideo");

      await client.publish(localTracks);

      isStreaming = true;
      button.textContent = "Stop Streaming";
      indicator.style.display = "block";
    } catch (err) {
      console.error("Streaming failed:", err.responseJSON || err);
      alert("Could not start stream. Check console.");
    }
  } else {
    try {
      localTracks.forEach(track => {
        track.stop();
        track.close();
      });
      await client.unpublish(localTracks);
      await client.leave();
      videoEl.srcObject = null;

      isStreaming = false;
      button.textContent = "Start Streaming";
      indicator.style.display = "none";
    } catch (err) {
      console.error("Failed to stop:", err);
    }
  }
});
</script>


<!-- Add these in your Blade file, preferably before the closing </body> tag -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo@1.11.3/dist/echo.iife.js"></script>

<script>
    window.Pusher = Pusher; // Assign Pusher to the global object
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '2d1bf5af3517b2dc31df', // Use your actual Pusher key
        cluster: 'ap2', // Use your actual Pusher cluster
        wsHost: window.location.hostname, // Automatically use the current host
        wsPort: 6001, // Port for WebSocket connection
        forceTLS: false, // Force TLS (set to true if you're using https)
        disableStats: true, // Disable stats (optional)
        enabledTransports: ['ws', 'wss'], // Use WebSockets and WSS
    });
</script>

<script>
    const channel = "<?php echo e($channel); ?>";  // Channel passed from the server (Blade variable)

    // Listen for the 'ViewerJoinedNotification' event on the channel
    Echo.channel('live-stream.' + channel)
        .listen('ViewerJoinedNotification', (event) => {
            // Display a real-time alert for the host (viewer joined)
            alert(event.message);  // This will show the message in an alert
        });
</script>

<?php /**PATH E:\laragon\www\animation_social\animation_social_project\resources\views/frontend/live_screen.blade.php ENDPATH**/ ?>