@include('frontend.layout.header')
    <link rel="stylesheet" href="assets/css/idcard.css">
    <style>
        body{
            font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
           background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Background image stays fixed */
            background-size: cover;
            background-image: url(assets/img/ssdRectangle.svg);
        }
    </style>
    <div class="logo">
        <span>YARD</span>
        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234CAF50'%3E%3Cpath d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z'/%3E%3C/svg%3E" alt="Apple icon">
        <span>CHATZ</span>
    </div>

    <div class="container">
        <h1>Let's Get Started</h1>
        <h2>Take a pic of your ID</h2>

        <div class="content-wrapper">
            <div class="apple-camera">
                <img src="assets/img/live-apple.png" alt="Green Apple with Camera" class="apple-image">
                <div class="camera-text" >
                   <a href="{{route('main_cam')}}"> Click on<br>Camera</a>
                </div>
            </div>

            <div class="id-card">
               <img src="assets/img/caed.png" width="100%">
            </div>
        </div>

        <div class="warning">
            No fake IDs dude.<br>
            This isn't a college dive bar
        </div>
    </div>
    @include('frontend.layout.footer')

