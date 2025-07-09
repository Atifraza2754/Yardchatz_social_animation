
@include('frontend.layout.header')
<style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 200 !important;
            font-style: normal;
            min-height: 100vh;
            background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-image: url(assets/img/ssdRectangle.svg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
        }

        .container {
            text-align: center;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in;
        }

        .address {
            font-size: 2.5rem;
            margin-bottom: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1s ease-in 0.5s backwards;
        }

        .options {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 9rem;
            margin-top: 2rem;
            animation: fadeIn 1s ease-in 1s backwards;
        }

        .astronaut {
            width: 150px;
            height: 150px;
            animation: float 3s ease-in-out infinite;
        }

        .apple {
            width: 150px;
            height: 150px;
            cursor: pointer;
            position: relative;
            transition: transform 0.3s ease;
        }

        .apple:hover {
            transform: scale(1.1);
        }

        .apple-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            .address {
                font-size: 1.8rem;
            }
            .options {
                flex-direction: column;
            }
            .astronaut, .apple {
                width: 120px;
                height: 120px;
            }
        }
    </style>
    <div class="container">
        <h1>Is this where you live?</h1>
        <div class="address">220 East Jackson St.</div>
        <div class="options">
            <img src="assets/img/sdsdefe.svg" alt="Astronaut" class="astronaut">
            <div class="apple" onclick="window.location.href='{{route('household')}}';">
                <img src="assets/img/Masdgroup.svg" alt="Yes Apple" width="150" height="150">
                <div class="apple-text">Yes</div>
            </div>
            <div class="apple" onclick="window.location.href='{{route('uploadpic')}}';">
                <img src="assets/img/Masdgroup.svg" alt="Elsewhere Apple" width="150" height="150">
                <div class="apple-text">I stay<br>Somewhere<br>Else</div>
            </div>
        </div>
    </div>

    <script>
        function handleClick(choice) {
            const apple = event.currentTarget;
            apple.style.transform = 'scale(0.9)';
            
            setTimeout(() => {
                apple.style.transform = 'scale(1)';
                if (choice === 'yes') {
                    alert('Welcome home! 🏠');
                } else {
                    alert('Safe travels! 🚀');
                }
            }, 200);
        }

       
    </script>
@include('frontend.layout.footer')


