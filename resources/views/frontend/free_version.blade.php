@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 200 !important;
        font-style: normal;
        display: flex;
        justify-content: center;
        height: 100vh;
        align-items: center;
        background-size: cover;
        color: white;
        text-shadow: 2px 2px 5px black;
        /* Adds a shadow to the text like in the image */
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url(assets/img/ssdRectangle.png);
    }

    .text-container {
        text-align: center;
        line-height: 1.6;
        /* Adjust line spacing */
    }

    .text-container h1 {
        font-size: 3em;
        /* Matches the header size */
        margin: 0;
    }

    .text-container p {
        font-size: 2em;
        /* Matches the paragraph size */
        margin: 0.5em 0;
    }
    a.button_proceed {
    background: #3498db;
    color: #fff;
    padding: 8px 21px;
    border-radius: 15px;
    text-decoration: none;
    font-size: 20px;
}
@media screen and (max-width: 896px) and (orientation: landscape) {
    .text-container h1 {
    font-size: 24px !important;
    margin: 0;
}
.text-container p {
    font-size: 20px !important;
    margin: 0.5em 0;
}
}
</style>
<!-- Add Google Fonts for Creepster -->
<link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">

<div class="text-container">
    <h1>The Free Version of  Yard <br> Chatz</h1>
    <p>Allows you to have a <br> limited profile</p>
    <p>Have a friends list</p>
    <a href="{{route('person')}}" class="button_proceed">proceed</a>
</div>
@include('frontend.layout.footer')
