@include('frontend.layout.header')
<style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 400;
            font-style: normal;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Background image stays fixed */
            background-size: cover !important;
            background-image: url(assets/img/ssdRectangle.svg) !important;
        }

        .container {
            text-align: center;
            color: white;
            position: relative;
            height : 78vh !important;
            margin: 10% 0%;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-family: 'Comic Sans MS', cursive;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        .cards {
            position: relative;
            width: 150px;
            height: 100px;
            margin: 0 auto;
        }

        .card {
            width: 100%;
            height: 100%;
            position: absolute;
            border-radius: 10px;
            background-size: cover;
            background-position: center;
            transform-origin: bottom right;
            animation: float 3s ease-in-out infinite;
        }



        @keyframes float {

            0%,
            100% {
                transform: rotate(0deg) translateY(0);
            }

            50% {
                transform: rotate(-5deg) translateY(-10px);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .cards {
                width: 120px;
                height: 80px;
            }

            .container {
                margin: 50% 0%;
            }

        }
    </style>

    <div class="container">
        <h1>Venmo</h1>
        <div class="cards">
            <div class="card">
                <a href="#"><img src="assets/img/imagesxsd.svg" alt="" width='100%'></a>
            </div>
        </div>
        @include('frontend.layout.navbar')
    </div>
    @include('frontend.layout.footer')
