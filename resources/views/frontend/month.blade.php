
@include('frontend.layout.header')

    <link rel="stylesheet" href="assets/css/month.css">

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

    <a href="{{url('/')}}" class="logo" aria-label="YardChatz Home">
        <img src="https://www.freepnglogos.com/uploads/apple-png/apple-icon-paradise-fruits-iconset-artbees-0.png" alt="Small red apple">
        <div class="logo-text">YARD<br>CHATZ</div>
    </a>

    <main>
        <h1>YARDCHATZ IS $5 A MONTH</h1>

        <div class="apple-container" onclick="handlePayment()" role="button" tabindex="0" aria-label="Click to pay">
            <img src="assets/img/live-apple.png" alt="Green Apple" class="apple">
            <div class="click-text"><a href="#"> CLICK TO PAY </a></div>
        </div>

        <div class="pay-text">
            PAY <span class="strikethrough">LATER</span> NOW?
        </div>
    </main>
    @include('frontend.layout.footer')
