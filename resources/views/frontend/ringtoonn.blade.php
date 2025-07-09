@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
    }

    @media (max-width: 480px) {
        .map-title-top {
            margin-top: 26%;
            margin-left: 6%;

        }

        .map-title-bottom {
            margin-top: 100%;
            margin-left: 43%;
            font-size: 25px;
        }
    }
</style>
<style>
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


    body {
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');
    }

    .banner {
        width: 100%;
        height: 400px;
        position: relative;
        overflow: hidden;
    }

    .title {
        position: absolute;
        left: 167px;
        top: 67%;
        transform: translateY(-50%);
        color: white;
        font-size: 28px;
        font-weight: 900;
        line-height: 1;
        text-transform: uppercase;
        width: 300px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 2;
    }

    .profile-container {
        position: absolute;
        top: 62%;
        transform: translateY(-50%);
        width: 100%;
        height: 300px;
        z-index: 1;
        left: 27%;
    }

    .profile-circle {
        width: 100%;
        height: 100%;
        overflow: hidden;
        background-image: url(assets/img/Maskdfdfroup.svg);
        background-repeat: no-repeat;
    }

    .profile-circle img {
        width: 8%;
        object-fit: cover;
        margin-top: 47px;
        margin-left: 24px;
    }

    .name {
        position: absolute;
        top: 47%;
        color: white;
        font-size: 17px;
        font-weight: bold;
        text-transform: uppercase;
        left: 49%;
    }

    /* Icons */
    .speaker-icon,
    .phone-icon,
    .video-icon,
    .chat-icon {
        position: absolute;
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .speaker-icon {
        background: transparent;
    }

    .speaker-icon {
        left: 15%;
        top: 30%;
    }

    .phone-icon {
        top: 25%;
        left: 39%;
    }

    .video-icon {
        bottom: 24%;
        left: 39%;
    }

    .chat-icon {
        bottom: 42%;
        left: 43%;
    }

    /* Animation for icons */
    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .speaker-icon {
        animation-delay: 0s;
    }

    .phone-icon {
        animation-delay: 0.5s;
    }

    .video-icon {
        animation-delay: 1s;
    }

    .chat-icon {
        animation-delay: 1.5s;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .title {
            font-size: 60px;
            width: 250px;
        }

        .profile-container {
            width: 250px;
            height: 250px;
        }
    }

    @media (max-width: 768px) {
        .title {
            font-size: 40px;
            width: 200px;
            left: 30px;
        }

        .profile-container {
            width: 200px;
            height: 200px;
            right: 30%;
        }

        .speaker-icon,
        .phone-icon,
        .video-icon,
        .chat-icon {
            width: 50px;
            height: 50px;
        }

        .speaker-icon img,
        .phone-icon img,
        .video-icon img,
        .chat-icon img {
            width: 25px;
            height: 25px;
        }

        .name {
            font-size: 20px;
            right: 30px;
        }
    }
</style>

<div class="container">
    <div class="banner">
        <div class="speaker-icon">
            <img src="{{ asset('assets/img/mic.png')}}" alt="Speaker">
        </div>
        <div class="phone-icon">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0yMiAxNi45MnYzYTIgMiAwIDAgMS0yLjE4IDIgMTkuNzkgMTkuNzkgMCAwIDEtOC42My0zLjA3IDE5LjUgMTkuNSAwIDAgMS02LTYgMTkuNzkgMTkuNzkgMCAwIDEtMy4wNy04LjY3QTIgMiAwIDAgMSA0LjExIDJoM2EyIDIgMCAwIDEgMiAxLjcyYy4xMjcuOTYuMzYxIDEuOTAzLjcgMi44MWEyIDIgMCAwIDEtLjQ1IDIuMTFMOC4wOSA5LjkxYTE2IDE2IDAgMCAwIDYgNmwxLjI3LTEuMjdhMiAyIDAgMCAxIDIuMTEtLjQ1Yy45MDcuMzM5IDEuODUuNTczIDIuODEuN0EyIDIgMCAwIDEgMjIgMTYuOTJ6Ii8+PC9zdmc+"
                alt="Phone">
        </div>
        <div class="video-icon">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwb2x5Z29uIHBvaW50cz0iMjMgNyAxNiAxMiAyMyAxNyAyMyA3Ii8+PHJlY3QgeD0iMSIgeT0iNSIgd2lkdGg9IjE1IiBoZWlnaHQ9IjE0IiByeD0iMiIgcnk9IjIiLz48L3N2Zz4="
                alt="Video">
        </div>
        <div class="chat-icon">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0yMSAxNWEyIDIgMCAwIDEtMiAySDdsLTQgNFY1YTIgMiAwIDAgMSAyLTJoMTRhMiAyIDAgMCAxIDIgMnoiLz48L3N2Zz4="
                alt="Chat">
        </div>
        <div class="title">Ringing</div>
        <div class="profile-container">
            <div class="profile-circle">
                @if($user->profile_picture)
                    <img src="{{ asset($user->profile_picture) }}" alt="Mallory" class="profile-image" style="width:90px; height:90px; border-radius:50%;">

                 @else
                    <img src="assets/img/person.png" alt="profile" class="profile-image">
                @endif
            </div>
        </div>
        <div class="name">{{ $user->name }}</div>
    </div>
    @include('frontend.layout.navbar')

    <script>
        function navigateTo(url) {
            window.location.href = url; // Navigate to the provided URL
        }
    </script>
</div>
@include('frontend.layout.footer')
