@include('frontend.layout.header')

<link rel="stylesheet" href="assets/css/video.page.css">
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
          background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Background image stays fixed */
            background-size: cover;
            background-image: url(assets/img/ssdRectangle.svg);
    }

    .apple-logo {
        width: 100%;
        height: 100%;
        background-image: url(./assets/img/tree_apple.png);
        background-size: contain;
        /* Ensure image fits within the container */
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /*body {*/
    /*    background-image: url(assets/img/main.png);*/
    /*    background-size: cover;*/
    /*    background-position: center;*/
    /*    background-repeat: no-repeat;*/
        /*min-height: 100vh;*/
    /*}*/

    @media (max-width: 768px) {
        .logo-wrapper {
            bottom: 70px;
        }
    }
</style>
    <div class="video-container-div">
        <div class="logo-wrapper">
            <div class="apple-logo">
                <a href="{{route('camera')}}" class="video-link">VIDEO</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Your JavaScript code here (if needed)
        });
    </script>
@include('frontend.layout.footer')

