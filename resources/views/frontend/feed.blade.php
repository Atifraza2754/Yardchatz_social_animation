@include('frontend.layout.header')

<style>
    img.img_apple.apple_three_img {
        margin-top: -193px !important;
        margin-left: 52%;
    }

    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url({{ asset('assets/img/tree2.jpg') }});

    }

    @media (max-width: 480px) {
        img.img_apple {
            width: 33%;
            margin-top: 171px;
            margin-left: 5%;
            font-size: 28px;
        }

        img.img_apple.apple_three_img.position-dey {
            position: absolute;
            margin-top: -164px;
            margin-left: 62%;
            font-size: 28px;
        }

        img.img_apple.apple_two_img {
            margin-left: 5%;
            margin-top: 0px;
            width: 34%;
            font-size: 28px;
        }

        img.img_apple.apple_three_img {
            margin-top: 0px;
            margin-left: 7%;
            font-size: 28px;
        }

        img.img_apple.apple_four_img {
            margin-left: 25% !important;
            position: absolute !important;
            top: 70px !important;
            font-size: 28px;
        }

        img.img_apple.apple_three_img.img_five {
            position: absolute;
            top: 23%;
            left: 41%;
            font-size: 28px;
        }

        .audio_span {
            margin-top: 94px;
            left: 33%;
            font-size: 28px;
        }

        span.audio_span.audio_span_two {
            left: 15%;
            margin-top: -20%;
            font-size: 28px;

        }

        span.audio_span.audio_span_three {
            position: absolute;
            margin-top: -230px;
            left: 57%;
            font-size: 32px;
            color: #fff;
            z-index: 999999999;
            font-size: 28px;
        }

        span.audio_span.audio_span_three.span_five {
            margin-top: -90px;
            left: 69%;
            font-size: 28px;
        }

        span.audio_span.audio_span_four {
            margin-top: -77px;
            left: 15%;

            color: #fff;
            z-index: 999999999;
            font-size: 28px;
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
</style>
<div class="container">

    <div class="map-background">
        <h1 class="map-title">Feed</h1>
    </div>
    <div class="main_img_apple ">
        <img src="assets/img/tree_apple.png" class="img_apple first-one-apple-img">
        <a href="{{route('music')}}"><span class="audio_span first-one-apple-text">Audio</span></a>
    </div>
    <div class="main_img_apple apple_two">
        <img src="assets/img/tree_apple.png" class="img_apple apple_two_img">
        <a href="{{route('text')}}"> <span class="audio_span audio_span_two">Text</span></a>
    </div>
    <div class="main_img_apple apple_three  ">
        <img src="assets/img/tree_apple.png" class="img_apple apple_three_img position-dey">
        <a href="{{route('nav_camera')}}"> <span class="audio_span audio_span_three">Live</span></a>
    </div>

    <div class="main_img_apple apple_four ">
        <img src="assets/img/tree_apple.png" class="img_apple apple_four_img">
        <a href="#"> <span class="audio_span audio_span_four">Multi</span></a>

    </div>
    <div class="main_img_apple apple_three five">
        <img src="assets/img/tree_apple.png" class="img_apple apple_three_img img_five">
        <a href="{{route('video_page')}}"> <span class="audio_span audio_span_three span_five">Video</span></a>
    </div>



    @include('frontend.layout.navbar')

    <script>
        function navigateTo(url) {
            window.location.href = url; // Navigate to the provided URL
        }
    </script>


</div>
@include('frontend.layout.footer')
