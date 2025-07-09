@include('frontend.layout.header')

    <style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 200 !important;
            font-style: normal;
            font-style: normal;
            min-height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-image: url(assets/img/dsded.svg); /* Ensure the path is correct */
        }

        .container {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .action-buttons {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            gap: 40%;
            padding: 20px;
        }

        .button {
            flex: 1;
            margin-bottom: 10%;
            padding: 15px 20px;
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .write-button {
            background-color: rgba(255, 89, 89, 0.67);
            box-shadow: 0 4px 15px rgba(255, 89, 89, 0.3);
        }

        .photo-button {
            background-color: rgba(46, 167, 76, 0.55);
            box-shadow: 0 4px 15px rgba(46, 167, 76, 0.3);
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .button:active {
            transform: translateY(0px);
        }

        .button-text {
            display: block;
            font-size: 28px;
            line-height: 1.2;
            white-space: nowrap;
        }

        .name-text {
            display: block;
            font-size: 22px;
            margin-top: 2px;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 20px; /* Adjust gap for smaller screens */
            }

            .button {
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <!-- Background image is applied to the body -->
        <div class="action-buttons">
            <button class="button write-button" onclick="animateClick(this)">
                <span class="button-text">Write something on</span>
                <span class="name-text">Rick's Profile</span>
            </button>
            <button class="button photo-button" onclick="animateClick(this)">
                <span class="button-text">Post a photo on</span>
                <span class="name-text">Rick's Profile</span>
            </button>
        </div>
        
    </div>
    @include('frontend.layout.navbar')
    <script>
        function animateClick(button) {
            button.style.transform = 'scale(0.95)';
            button.style.opacity = '0.9';

            setTimeout(() => {
                button.style.transform = '';
                button.style.opacity = '';
            }, 150);
        }
    </script>
    @include('frontend.layout.footer')

