@include('frontend.layout.header')
<link rel="stylesheet" href="assets/css/payment.css">
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
</style>
<div class="container">
    <h1>Add a Payment Method</h1>
    <div class="payment-options">
        <div class="payment-option credit-card">
            <span>Credit Card</span>
            <a href="{{route('month')}}"> <img src="assets/img/Screenshot 2024-11-23 053729.png" alt="Credit Card"
                    class="card-image"></a>
        </div>
        <div class="payment-option apple-pay">
            <span>Apple Pay</span>
            <a href="{{route('month')}}"><img src="assets/img/Screenshot 2024-11-23 053734.png" alt="Apple Pay"
                    class="apple-pay-image"></a>

        </div>
        <div class="payment-option appleyard">
            <span>Appleyard Card</span>
            <a href="{{route('month')}}"> <img src="assets/img/Screenshot 2024-11-23 053743.png" alt="Appleyard Card"
                    class="card-image"></a>
            <span>What's Appleyard <br> Card? We Dont Know <br> Its Just An Idea, Bro Chill</span>

        </div>
    </div>
    <div class="yard-chaatz">
        <div class="logo">
            <span class="yard">Yard</span>
            <span class="chaatz">Chaatz</span>
            <div class="apple-icon">🍎</div>
        </div>
    </div>
    <div class="disclaimer">
        What's Appleyard Card? We don't know,<br>
        it's just an idea, bro chill.
    </div>
</div>
@include('frontend.layout.footer')
