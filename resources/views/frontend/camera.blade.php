@include('frontend.layout.header')
  
  <link rel="stylesheet" href="assets/css/camera.css">
        <style>
            body{
                font-family: "Irish Grover", serif;
            font-weight: 400;
            font-style: normal;
            }
        </style>
        <div class="camera-frame">
            <div class="top-bar">
                <h1 class="camera-title">Classic M</h1>
                <div class="viewfinders">
                    <div class="viewfinder"></div>
                    <div class="viewfinder"></div>
                </div>
            </div>
            <div class="main-section">
                <div class="controls leather-texture">
                    <button class="control-button" onclick="toggleEV()">EV</button>
                    <button class="control-button" onclick="togglePower()">⏻</button>
                    <button class="control-button" onclick="toggleCamera()">⇄</button>
                </div>
                <div class="display">
                    <video id="camera-feed" autoplay playsinline muted></video>
                    <canvas id="photo-canvas" style="display: none;"></canvas>
                </div>
                <div class="controls leather-texture">
                    <button class="control-button" onclick="adjustFocus()">⊕</button>
                    <button class="control-button" onclick="adjustAperture()">⌀</button>
                    <button class="control-button" onclick="capturePhoto()">📷</button>
                    <button class="control-button" id="recordButton" onclick="toggleRecording()">🎥</button>
                    <button class="control-button" style="background: #ffd700">●</button>
                    <div class="slider">
                        <div class="slider-thumb"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let isOn = true;
            let evMode = false;
            let mediaRecorder;
            let recordedChunks = [];
            let isRecording = false;
            let isBackCamera = false;
            let currentStream = null;

            function togglePower() {
                isOn = !isOn;
                const cameraFeed = document.getElementById('camera-feed');
                cameraFeed.style.opacity = isOn ? '1' : '0';
            }

            function toggleEV() {
                evMode = !evMode;
                const cameraFeed = document.getElementById('camera-feed');
                cameraFeed.style.filter = evMode ? 'brightness(1.5)' : 'brightness(1)';
            }

            function adjustFocus() {
                const cameraFeed = document.getElementById('camera-feed');
                cameraFeed.style.filter = 'blur(2px)';
                setTimeout(() => {
                    cameraFeed.style.filter = 'none';
                }, 500);
            }

            function adjustAperture() {
                const cameraFeed = document.getElementById('camera-feed');
                cameraFeed.style.transition = 'all 0.3s ease';
                cameraFeed.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    cameraFeed.style.transform = 'scale(1)';
                }, 300);
            }

            function capturePhoto() {
                const canvas = document.getElementById('photo-canvas');
                const video = document.getElementById('camera-feed');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                canvas.getContext('2d').drawImage(video, 0, 0);
                
                canvas.toBlob(function(blob) {
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = 'classic-m-photo.png';
                    document.body.appendChild(a);
                    a.click();
                    setTimeout(() => {
                        document.body.removeChild(a);
                        window.URL.revokeObjectURL(url);
                    }, 100);
                });
            }

            function toggleRecording() {
                const video = document.getElementById('camera-feed');
                const recordButton = document.getElementById('recordButton');

                if (!isRecording) {
                    mediaRecorder = new MediaRecorder(video.srcObject);
                    mediaRecorder.ondataavailable = (event) => {
                        if (event.data.size > 0) {
                            recordedChunks.push(event.data);
                        }
                    };
                    mediaRecorder.onstop = () => {
                        const blob = new Blob(recordedChunks, { type: 'video/webm' });
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.style.display = 'none';
                        a.href = url;
                        a.download = 'classic-m-video.webm';
                        document.body.appendChild(a);
                        a.click();
                        setTimeout(() => {
                            document.body.removeChild(a);
                            window.URL.revokeObjectURL(url);
                        }, 100);
                    };
                    mediaRecorder.start();
                    isRecording = true;
                    recordButton.style.background = '#ff0000';
                } else {
                    mediaRecorder.stop();
                    isRecording = false;
                    recordedChunks = [];
                    recordButton.style.background = 'radial-gradient(circle at 30% 30%, #e0e0e0, #888)';
                }
            }

            async function startCamera() {
                try {
                    if (currentStream) {
                        currentStream.getTracks().forEach(track => track.stop());
                    }
                    const constraints = {
                        video: {
                            facingMode: isBackCamera ? "environment" : "user"
                        },
                        audio: false
                    };
                    const stream = await navigator.mediaDevices.getUserMedia(constraints);
                    currentStream = stream;
                    const cameraFeed = document.getElementById('camera-feed');
                    cameraFeed.srcObject = stream;
                } catch (err) {
                    console.error("Error accessing the camera: ", err);
                }
            }

            function toggleCamera() {
                isBackCamera = !isBackCamera;
                startCamera();
            }

            startCamera();

            const thumb = document.querySelector('.slider-thumb');
            let isDragging = false;

            thumb.addEventListener('mousedown', () => {
                isDragging = true;
            });

            document.addEventListener('mousemove', (e) => {
                if (isDragging) {
                    const slider = document.querySelector('.slider');
                    const rect = slider.getBoundingClientRect();
                    const y = Math.max(0, Math.min(rect.height - thumb.offsetHeight,
                        e.clientY - rect.top - thumb.offsetHeight / 2));
                    thumb.style.transform = `translateY(${y}px)`;
                }
            });

            document.addEventListener('mouseup', () => {
                isDragging = false;
            });
        </script>
@include('frontend.layout.footer')

