@include('frontend.layout.header')

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url(assets/img/personwe.png);
    }

    @media (max-width: 480px) {
        h1.map-title.person-heading {
            top: 24% !important;
            justify-content: center;
            left: 20%;
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

    <div class="map-background ">
        <h1 class="map-title person-heading">Name
            <br>
            <span class="map-title-category"><a href="{{url('/')}}" class="links-text-person">Hometown</a> </span>
            <br>
            <span class="map-title-category"><a href="{{route('terms_condition')}}" class="links-text-person">Current
                    City</a></span>
            <br>
            <span class="map-title-category "><a href="{{route('permission')}}" class="links-text-person">Favorite Song
                    Rn</a></span>
            <br>
            <span class="map-title-category "><a href="#" class="links-text-person">Employer</a></span>
            <br>
            <span class="map-title-category "><a href="#" class="links-text-person">Job
                    Title</a></span>
            <br>
            <br>
            <span class="map-title-category ">Currently In:</span>
            <br>
            <span class="map-title-category ">"PENSACOLA BASEBALL <br> ROOM"</span>


        </h1>
    </div>
    <div>
        <img src="assets/img/logo.png" alt="" onclick="navigateTo('{{url('/')}}')"
            style="position: absolute; z-index: 9999999999;">
    </div>

    @include('frontend.layout.navbar')

    <script>
        function navigateTo(url) {
            window.location.href = url; // Navigate to the provided URL
        }
    </script>
</div>
@include('frontend.layout.footer')
