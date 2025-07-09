@include('frontend.layout.header')

<link rel="stylesheet" href="assets/css/fam.css">
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url(assets/img/tree2.jpg);
    }

    @media (max-width: 480px) {
        .frame3 {
            top: 27%;
            right: 20%;
        }

        .frame6 {
            top: 63%;
            left: 45%;
        }

        .navbar .icon {
            width: 17%;
        }

        .navbar {
            bottom: 0px;
            overflow-x: auto !important;
            /* Horizontal scroll ke liye */
            overflow-y: hidden !important;
            /* Vertical overflow ko remove karne ke liye */
            height: 65px;
        }
    }

    img.icon.extra.active {
        transform: scale(1.2);
        margin-top: 0;
        z-index: 5;
        overflow: visible;
    }

    .frame-6 {
        left: -33px !important;
        top: 33% !important;
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

    img.icon.extra:hover {
        transform: scale(1.2) !important;
    }
</style>

<div class="container">

    <div class="tree-container">
        <div class="apple-frame frame1">
            <img src="assets/img/1.png" alt="Family Photo 1">
        </div>
        <div class="apple-frame frame2">
            <img src="assets/img/2.png" alt="Family Photo 2">
        </div>
        <div class="apple-frame frame3">
            <img src="assets/img/3.png" alt="Family Photo 3">
        </div>
        <div class="apple-frame frame4">
            <img src="assets/img/1.png" alt="Family Photo 4">
        </div>
        <div class="apple-frame frame5">
            <img src="assets/img/2.png" alt="Family Photo 5">
        </div>
        <div class="apple-frame frame6">
            <img src="assets/img/3.png" alt="Family Photo 6" class="frame-6">
        </div>
    </div>

    @include('frontend.layout.navbar')

    <script>
        function navigateTo(url) {
            window.location.href = url; // Navigate to the provided URL
        }
    </script>
</div>

@include('frontend.layout.footer')
