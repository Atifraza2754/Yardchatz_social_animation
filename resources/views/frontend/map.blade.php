@include('frontend.layout.header')

<div class="container">
    <div class="map-background">
        <h1 class="map-title" style="color: #000">MAP</h1>
    </div>

    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d602000.1221224142!2d34.728152401988375!3d30.912943961594063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1500492432a7c98b%3A0x6a6b422013352cba!2sIsrael!5e0!3m2!1sen!2s!4v1740130499310!5m2!1sen!2s" 
            frameborder="0" allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    @include('frontend.layout.navbar')
</div>

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        margin: 0;
        padding: 0;
    }

    .map-container {
        position: relative;
        width: 100%;
        height: 96%; /* Adjust height as needed */
        /* background: url('assets/img/map3.jpg') no-repeat center center/cover; */
        border-radius: 12px;
        overflow: hidden;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        opacity: 0.85; /* Slight transparency for better blending */
        position: relative;
        z-index: 2;
    }

    /* Dark Overlay Effect */
    .map-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2); /* Light black overlay */
        z-index: 1;
    }

    .icon {
        position: relative;
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

    /* Adjust text positions */
    span.map-text.Radio-text { left: 15%; }
    span.map-text.music { left: 26%; }
    span.map-text.feed { left: 36%; }
    span.map-text.cameras { left: 46%; }
    span.map-text.Room { left: 57%; }
    span.map-text.Friends { left: 67%; }
    span.map-text.name { left: 77%; }
    span.map-text.setting { left: 87%; }
    span.map-text.fam { left: 96%; }
    @media screen and (max-width: 896px) and (orientation: landscape) {
            .navbar {
                bottom: 20px !important;
            }
          }
</style>

@include('frontend.layout.footer')
