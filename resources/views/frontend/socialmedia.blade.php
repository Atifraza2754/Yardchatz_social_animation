@include('frontend.layout.header')
<style>
        body {
            font-family: "Irish Grover", serif !important;
            font-weight: 200 !important;
            font-style: normal;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-image: url(assets/img/ssdRectangle.svg);
        }

        .container {
            position: relative;
        }

        .apple-container {
            position: relative;
            text-align: center;
            margin-top: 12%;
        }

        .apple {
            width: 300px;
        }

        .astronaut {
            position: absolute;
            top: -21%;
            right: -40%;
        }

        .text {
            position: absolute;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 24px;
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .social-icons {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 20px;
        }

        .icon {
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        @keyframes scaleUp {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        @keyframes floatAstronaut {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @media (max-width: 768px) {
            .apple {
                width: 206px;
            }

            .astronaut {
                top: -38%;
                right: -40%;
            }

            .Astronaut {
                width: 75%;
            }

            .text {
                top: 80px;
            }
        }
    </style>

    <div class="container">
        <div class="apple-container">
            <img src="assets/img/Clippatgroup.svg" alt="Green Apple" class="apple">
            <div class="astronaut">
                <img src="assets/img/Groupdsd.svg" alt="Astronaut" class="Astronaut">
            </div>
            <div class="text" onclick="window.location.href='{{route('eastjackson')}}';">
                Import your <br>
                Traditional <br>
                Social Media <br>
                Content
            </div>
            <div class="social-icons">
                <img src="assets/img/insta.png" alt="Instagram Icon" class="icon" style="width: 67px; height: 57px;">
                <img src="assets/img/fb.svg" alt="Facebook Icon" class="icon" style="    margin-top: 10px;">
            </div>
        </div>
    </div>

    // <script>
    //     document.querySelector('.text').addEventListener('click', () => {
    //         alert('okay');
    //     });
    // </script>
    @include('frontend.layout.footer')
