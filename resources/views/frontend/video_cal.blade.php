@include('frontend.layout.header')

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        margin: 0;
        padding: 0;
        color: white;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');
    }

    .container {
        max-width: 600px;
        margin: auto;
        text-align: center;
    }

    .video-box {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .video-box video {
        width: 45%;
        aspect-ratio: 1 / 1;
        border-radius: 10px;
        margin: 5px;
        background: #000;
    }

    .left {
        order: 1;
    }

    .right {
        order: 2;
    }

    button {
        padding: 10px 20px;
        margin: 10px 5px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background: #007bff;
        color: white;
        cursor: pointer;
        margin-top: 135px;
    }

    button:hover {
        background: #0056b3;
    }


    .video-box {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        top: 120px;
    }

    .video-container {
        position: absolute;
        border-radius: 10px;
        overflow: hidden;
    }

    .video-container video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .video-container.main {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .video-container.pip {
        width: 25%;
        height: 25%;
        bottom: 10px;
        right: 10px;
        cursor: pointer;
        z-index: 10;
    }

    
    .avatar {
            position: absolute;
            top: 50%;
            left: -17%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            cursor: pointer;
        } 

     .avatar .camera-icon {
            position: absolute;
            right: -10px;
            bottom: 50px;
            color: black;
            border-radius: 50%;
            padding: 5px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
        #videorecordbtn{
            margin-left: -135%;
            margin-top:-9%;
        }
</style>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo@1.11.3/dist/echo.iife.js"></script>

<script>
  window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher'
            , key: '2d1bf5af3517b2dc31df'
            , cluster: 'ap2'
            , wsHost: window.location.hostname
            , wsPort: 6001
            , forceTLS: false
            , disableStats: true
            , enabledTransports: ['ws', 'wss']
        });

    axios.defaults.headers.common['X-CSRF-TOKEN'] =
        document.querySelector('meta[name="csrf-token"]').getAttribute('content');

</script>
</head>

    <div class="container">
        <div class="video-box">
            <div id="mainVideoContainer" class="video-container main">
                <video id="remoteVideo" autoplay playsinline></video>
            </div>
            <div id="pipVideoContainer" class="video-container pip" onclick="swapVideos()">
                <video id="localVideo" autoplay muted playsinline></video>     
            </div>
          <div class="avatar" onclick="startCamera()">
            <img src="{{ asset('assets/img/Clipdsspathdgroup.svg') }}" alt="Avatar">
            <div class="camera-icon"><img src="{{ asset('assets/img/Groupcamera.svg')}}"></div>
        </div>  
        </div>

        <div id='videorecordbtn'>
        <button id="recordBtn" style="display: none; background-color:green;">Start Recording</button>
        <span id="recordTimer" style="display: none; color: red; font-weight: bold; ">00:00</span>
        </div>

        <div>
            {{-- <button id="startBtn" onclick="startCall()">Start Call</button> --}}
            <button id="receiveBtn" style="display:none;">Receive Call</button>
            <button id="hangupBtn" style="display:none; background-color:red; margin-top:10px; margin-left:450px;">Leave</button>
        </div>
    </div>
    
    <script src="{{ asset('assets/js/video_call.js') }}"></script>
    <script>
   window.onload = function () {
    const params = new URLSearchParams(window.location.search);
    if (params.get('autocall') === '1') {
        startCall();
    } 
};
</script>



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


    @include('frontend.layout.footer')
