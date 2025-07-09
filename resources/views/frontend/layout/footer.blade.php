

<div id="incomingCallModal" class="custom-modal-overlay" style="display: none;background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');">

    <div class="container">
        <div class="call-banner">
            <div class="speaker-icon">
                <img src="{{ asset('assets/img/mic.png')}}" alt="Speaker">
            </div>
          <div class="phone-icon" id="acceptAudioCallBtn" style="cursor: pointer;">
                <img src="{{ asset('assets/img/audio-answer.png') }}" alt="" width="50px" height="50px">
            </div>

            <div class="video-icon btn-accept" id="acceptCallBtn" style="cursor: pointer;">
                <img src="{{ asset('assets/img/video-answered.png') }}" alt="" width="50px" height="50px">
            </div>
{{--             <div class="chat-icon">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0yMSAxNWEyIDIgMCAwIDEtMiAySDdsLTQgNFY1YTIgMiAwIDAgMSAyLTJoMTRhMiAyIDAgMCAxIDIgMnoiLz48L3N2Zz4=" alt="Chat">
            </div> --}}
             <div class="decline-icon btn-decline" id="declineVideoBtn">
                <img src="{{ asset('assets/img/video-decline.png') }}" alt="Chat" width="50px" height="50px">
            </div> 

            <div class="audio-decline-icon btn-decline" id="declineAudioBtn">
                <img src="{{ asset('assets/img/audio-decline (2).png') }}" alt="Chat" width="50px" height="50px">
            </div>
            <div class="call-title">Ringing</div>
            <div class="caller-profile-container">
                <div class="profile-circle">
                    <img src="{{ asset('assets/img/person.png') }}" alt="profile" class="profile-image" style="width:100px; height:100px; border-radius:50%;">
                    {{-- <img src="{{ asset($user->profile_picture) }}" alt="Mallory" class="profile-image" style="width:100px; height:100px; border-radius:50%;"> --}}
                </div>
            </div>
            <div class="call-name">Loading...</div>
        </div>
    </div>
</div>

<script>
@auth
  window.Laravel = {
    userId: {{ auth()->id() }},
    ringtone: "{{ auth()->user()->ringtone }}"
  };
@endauth
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://unpkg.com/laravel-echo@1.11.3/dist/echo.iife.js"></script>
<script>
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher'
        , key: '2d1bf5af3517b2dc31df'
        , cluster: 'ap2'
        , wsHost: window.location.hostname
        , wsPort: 6001
        , forceTLS: false
        , disableStats: true
        , enabledTransports: ['ws', 'wss']
    , });




    function navigateTo(url) {
        window.location.href = url; // Navigate to the provided URL
    }

</script>

</div>

<script src="{{ asset('assets/js/audio_video_call_client.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-QFhVmsAP/yds9NGNlR0MRoqh0hjCoNhthlZIu0DkLqq5/8ifJ44aNs1fgJqS3XiC" crossorigin="anonymous">
</script>



<script>
    function showText(id) {
        document.getElementById(id).style.display = 'block';
    }

    function hideText(id) {
        document.getElementById(id).style.display = 'none';
    }

</script>
<script>
    // Initial setup: Check if there's a saved active item in localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const savedActiveIndex = localStorage.getItem('activeIconIndex');
        if (savedActiveIndex !== null) {
            const icons = document.querySelectorAll('.navbar .icon');
            icons[savedActiveIndex].classList.add('active');

            // Scroll to the saved active item
            icons[savedActiveIndex].scrollIntoView({
                behavior: 'smooth'
                , inline: 'center'
                , block: 'nearest'
            });
        }
    });

    // Add event listener to all icons
    document.querySelectorAll('.navbar .icon').forEach((icon, index) => {
        icon.addEventListener('click', function() {
            // Remove active class from all icons
            document.querySelectorAll('.navbar .icon').forEach(item => {
                item.classList.remove('active');
            });

            // Add active class to the clicked icon
            this.classList.add('active');

            // Save the index of the clicked icon in localStorage
            localStorage.setItem('activeIconIndex', index);

            // Scroll to the clicked icon
            this.scrollIntoView({
                behavior: 'smooth'
                , inline: 'center'
                , block: 'nearest'
            });
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
