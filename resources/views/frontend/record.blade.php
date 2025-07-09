@include('frontend.layout.header')
<style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 200 !important;
            font-style: normal;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-image: url(assets/img/ssdRectangle.svg);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .record-container {
            text-align: center;
            color: white;
        }

        .record-container .icon {
            cursor: pointer;
            transition: transform 0.3s;
        }

        .record-container.recording .icon {
            transform: scale(1.2);
            color: red;
        }

        .record-container .text {
            font-size: 24px;
            font-weight: bold;
        }

        .playback-container {
            margin-top: 20px;
            text-align: center;
        }

        audio {
            margin-top: 10px;
            outline: none;
        }

        @media (max-width: 768px) {
            .record-container .icon {
                font-size: 70px;
            }

            .record-container .text {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .record-container .icon {
                font-size: 50px;
            }

            .record-container .text {
                font-size: 16px;
            }
        }
    </style>

    <div class="record-container">
        <div class="icon"><img src="assets/img/Clipdfdrewpath group.svg" alt=""></div>
        <div class="text">Record</div>
    </div>
        @include('frontend.layout.navbar')
    <!-- <div class="playback-container"></div>

    <script>
        const recordContainer = document.querySelector('.record-container');
        const icon = document.querySelector('.icon');
        const text = document.querySelector('.text');
        const playbackContainer = document.querySelector('.playback-container');

        let mediaRecorder;
        let chunks = [];

        // Toggle recording state
        recordContainer.addEventListener('click', async () => {
            if (!mediaRecorder || mediaRecorder.state === 'inactive') {
                startRecording();
            } else if (mediaRecorder.state === 'recording') {
                stopRecording();
            }
        });

        async function startRecording() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                mediaRecorder = new MediaRecorder(stream);

                mediaRecorder.ondataavailable = (event) => {
                    chunks.push(event.data);
                };

                mediaRecorder.onstop = () => {
                    const audioBlob = new Blob(chunks, { type: 'audio/wav' });
                    chunks = [];
                    playRecording(audioBlob);
                };

                mediaRecorder.start();
                recordContainer.classList.add('recording');
                text.textContent = 'Recording... Click to Stop';
            } catch (error) {
                alert('Microphone access is required for recording.');
                console.error(error);
            }
        }

        function stopRecording() {
            mediaRecorder.stop();
            recordContainer.classList.remove('recording');
            text.textContent = 'Click to Record';
        }

        function playRecording(audioBlob) {
            const url = URL.createObjectURL(audioBlob);

            const audioElement = document.createElement('audio');
            audioElement.controls = true;
            audioElement.src = url;

            playbackContainer.appendChild(audioElement);
            text.textContent = 'Recording saved! Click to record again.';
        }
    </script> -->
    @include('frontend.layout.footer')

