
@include('frontend.layout.header')
   
   
   <div class="container">
        <div class="main_img_apple">
            <img src="assets/img/camera-one.png" class="img_apple first-one-apple-img"
                onclick="navigateTo('{{route('main_cam')}}')">
        </div>
        <div class="main_img_apple apple_two">
            <img src="assets/img/camera-two.png" class="img_apple apple_two_img"
                onclick="navigateTo('{{route('second_cam')}}')">
        </div>
        <div class="main_img_apple apple_three ">
            <img src="" class="img_apple apple_three_img position-dey"
                onclick="navigateTo('{{route('third_cam')}}')">
        </div>

        <div class="main_img_apple apple_four ">
            <img src="assets/img/camera-three.png" class="img_apple apple_four_img foru"
                onclick="navigateTo('{{route('third_cam')}}')">

        </div>
        <div class="main_img_apple apple_three five">
            <img src="assets/img/camera-four.png" class="img_apple apple_three_img img_five"
                onclick="navigateTo('{{route('forth_cam')}}')">
        </div>


        @include('frontend.layout.navbar')

        <script>
            function navigateTo(url) {
                window.location.href = url; // Navigate to the provided URL
            }
        </script>


    </div>
    <style>
        body {
            font-family: "Irish Grover", serif;
            font-weight: 400;
            font-style: normal;
            background-image: url(assets/img/tree2.jpg);
        }
    
        @media (max-width: 480px) {
            img.img_apple {
                width: 33%;
                margin-top: 171px;
                margin-left: 5%;
            }
    
            img.img_apple.apple_three_img.position-dey {
                position: absolute;
                margin-top: -164px;
                margin-left: 62%;
            }
    
            img.img_apple.apple_two_img {
                margin-left: -7%;
                margin-top: 0px;
                width: 56%;
            }
    
            img.img_apple.apple_three_img {
                margin-top: 0px;
                margin-left: 7%;
            }
    
            img.img_apple.apple_four_img {
                margin-left: 41% !important;
                position: absolute !important;
                top: 14px !important;
            }
    
            img.img_apple.apple_three_img.img_five {
                position: absolute;
                top: 41%;
                left: 0%;
            }
    
            .audio_span {
                margin-top: 94px;
                left: 35%;
            }
    
            span.audio_span.audio_span_two {
                left: 13%;
                margin-top: -22%;
    
            }
    
            span.audio_span.audio_span_three {
                position: absolute;
                margin-top: -235px;
                left: 58%;
                font-size: 32px;
                color: #fff;
                z-index: 999999999;
            }
    
            span.audio_span.audio_span_three.span_five {
                margin-top: -90px;
                left: 69%;
            }
    
            span.audio_span.audio_span_four {
                margin-top: -77px;
                left: 17%;
                font-size: 25px;
                color: #fff;
                z-index: 999999999;
            }
        }
    
        .icon {
            position: relative;
            /* Make sure the image is positioned relative */
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
    
        img.img_apple.apple_four_img.foru {
            margin-top: 47px;
            position: absolute;
        }
    
        img.img_apple.apple_three_img.img_five {
            margin-top: -16px;
            margin-left: 53%;
        }
    </style>
@include('frontend.layout.footer')
   