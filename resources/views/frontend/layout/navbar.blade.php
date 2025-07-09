
<div class="navbar">
    <img src="{{ asset('assets/img/setting.png') }}" class="icon {{ request()->routeIs('setting') ? 'active' : '' }}"
        onclick="navigateTo('{{ route('setting') }}')"  >
    <span class="map-text setting" id="setting" style="display: none;">Setting</span>

    <img src="{{ asset('assets/img/message.png') }}" class="icon {{ request()->routeIs('allchats') ? 'active' : '' }}"
        onclick="navigateTo('{{ url('allchats') }}')" >
    <span class="map-text Conversation" id="Conversation" style="display: none;">Conversation</span>

    <img src="{{ asset('assets/img/map-icon.png') }}" class="icon {{ request()->routeIs('map') ? 'active' : '' }}"
        onclick="navigateTo('{{ route('map') }}')"  >
    <span class="map-text" id="map-text" style="display: none;">Map</span>

<img src="{{ asset('assets/img/person.png') }}" class="icon {{ request()->routeIs('person') ? 'active' : '' }}"
    onclick="navigateTo('{{ route('person') }}')" >
<span class="map-text name" id="name" style="display: none;">Name</span>

 <img src="{{ asset('assets/img/phone.png') }}" class="icon {{ request()->routeIs('new_feed') ? 'active' : '' }}"
        onclick="navigateTo('{{ route('new_feed') }}')" >
    <span class="map-text new_feed" id="new_feed" style="display: none;">new_feed</span>
    
    <img src="{{ asset('assets/img/apple.png') }}" class="icon {{ request()->routeIs('apple') ? 'active' : '' }}"
        onclick="navigateTo('{{ route('apple') }}')">
    <span class="map-text Room" id="Room" style="display: none;">Rooms</span>

   <img src="{{ asset('assets/img/heart.png') }}" class="icon {{ request()->routeIs('friends') ? 'active' : '' }}"
        onclick="navigateTo('{{ route('users') }}')">
    <span class="map-text Friends" id="Friends" style="display: none;">Users</span>


{{--     <img src="{{ asset('assets/img/camera.png') }}"
        class="icon {{ request()->routeIs('nav-camera') ? 'active' : '' }}"
        onclick="navigateTo('{{ route('nav_camera') }}')">
    <span class="map-text cameras" id="cameras" style="display: none;">Cameras</span> --}}




    





    {{-- <img src="{{ asset('assets/img/tree_icon.png') }}"
        class="icon extra {{ request()->routeIs('fam') ? 'active' : '' }}" onclick="navigateTo('{{ route('fam') }}')"
        onmouseover="showText('fam')" onmouseout="hideText('fam')">
    <span class="map-text fam" id="fam">Fam</span> --}}
</div>
<style>
    .icon {
        position: relative;
        /* Make sure the image is positioned relative */
    }

    /* .map-text {
        display: none;
        position: absolute;
        top: -50px;
        left: 5%;
        transform: translateX(-50%);
        color: #fff;
        z-index: 9999;
        background-color: #2d6a30;
        color: white;
        font-family: Impact, sans-serif;
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
    } */

    .icon:hover+.map-text {
        display: block;
    }

    span.map-text.Radio-text {
        left: 15%;
    }

    span.map-text.Invite-friends {
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

<script>
    function startCamera() {
        const videoContainer = document.getElementById('videoContainer');
        // Remove existing placeholder image
        videoContainer.innerHTML = '<video autoplay></video>';
        const videoElement = videoContainer.querySelector('video');

        // Access the user's webcam
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then((stream) => {
                videoElement.srcObject = stream;
            })
            .catch((error) => {
                console.error('Error accessing webcam:', error);
            });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-QFhVmsAP/yds9NGNlR0MRoqh0hjCoNhthlZIu0DkLqq5/8ifJ44aNs1fgJqS3XiC" crossorigin="anonymous">
</script>
<script>
/*     function showText(id) {
        document.getElementById(id).style.display = 'block';
    }

    function hideText(id) {
        document.getElementById(id).style.display = 'none';
    } */
</script>
