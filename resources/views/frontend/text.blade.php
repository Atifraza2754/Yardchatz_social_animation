@include('frontend.layout.header')
<link rel="stylesheet" href="assets/css/text.css">
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url(assets/img/setting2.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .apple-logo {
        width: 100%;
        height: 100%;
        background-image: url(./assets/img/tree_apple.png);
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container">
    <div class="content">
        <p class="text">
            TEXT THREAD<br>
            THIS WILL BE<br>
            SIMILAR TO<br>
            TWITTER<br>
            AKA, X.<br>
            USERS<br>
            WILL BE ABLE<br>
            TO CHANGE<br>
            THEIR FONT<br>
            AND FORMAT
        </p>
    </div>
</div>
<div class="logo-wrapper">
    <div class="apple-logo">
        <a href="{{route('text_two')}}" class="video-link">Text</a>
    </div>
</div>
@include('frontend.layout.footer')
