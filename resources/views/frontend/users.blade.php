@include('frontend.layout.header')
<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 200 !important;
        font-style: normal;
        min-height: 100vh;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url(assets/img/ssdRectangle.png);
    }

    .profiles-container {
        display: flex;
        flex-direction: column;
        gap: 40px;
        margin-bottom: 40px;
        overflow-y: auto;
        /* Yaha per scroll enable kiya */
        max-height: 80vh;
        /* Height set kardi taki scroll ho sake */
        padding-right: 10px;
        /* Scrollbar ke liye jagah di */
    }

    .profiles-container::-webkit-scrollbar {
        width: 8px;
    }

    .profiles-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .profiles-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }


    .profile-row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        /* Automatically fills the row with cards */
        gap: 30px;
        /* Space between cards */
        justify-items: start;
        /* Align items to the left */
    }

    .profile-card {
        text-align: center;
        position: relative;
        cursor: default;
        width: 150px;
    }


    .profile-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
        cursor: pointer;
        /* Add this line */
    }

    .name-label {
        background: rgba(200, 200, 200, 0.9);
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        max-width: 150px;
        /* Limit the width of the name container */
        word-wrap: break-word;
        /* Break words when they exceed the container width */
        display: block;
        /* Ensures the container is block-level and will wrap text */
        line-height: 1.4;
        /* Space between lines */
    }

    .name-label a {
        text-decoration: none;
        color: inherit;
        display: block;
        pointer-events: auto;
        /* Add this line */
    }

    .name-label a:hover {
        text-decoration: underline;
    }


    .interaction-icons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        gap: 10px;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    /*
    .icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transform: scale(0);
        transition: transform 0.3s ease;
    } */

    .profile-card.active .interaction-icons {
        opacity: 1;
        visibility: visible;
    }

    .profile-card.active .icon {
        transform: scale(1);
    }

    .profile-card.active .icon:nth-child(1) {
        transition-delay: 0s;
    }

    .profile-card.active .icon:nth-child(2) {
        transition-delay: 0.1s;
    }

    .profile-card.active .icon:nth-child(3) {
        transition-delay: 0.2s;
    }

    .profile-card.active .profile-image {
        transform: scale(0.9);
        filter: brightness(0.7);
    }

    /* .icon:hover {
        transform: scale(1.1) !important;
        background: #f0f0f0;
    } */

    .navbar {
        margin-left: -21px !important;
    }

</style>

<div class="profiles-container">
    <!-- First Row -->
    <div class="profile-row">
        @foreach($users as $user )
        @if(canViewProfile(auth()->user(), $user))
        <div class="profile-card">
            <div>
                @if($user->profile_picture)
                <img src="{{ asset($user->profile_picture) }}" alt="Mallory" class="profile-image">
                @else
                <img src="assets/img/person.png" alt="profile" class="profile-image">
                @endif
            </div>

            <div class="interaction-icons">
                <div class="icon" role="button" style="background: #fff;padding: 3px 4px;" aria-label="Call" onclick="navigateTo('{{ url('audio_cal/' . $user->id) }}?autocall=1')">📞</div>
                <div class="icon" role="button" style="background: #fff;padding: 3px 4px;" aria-label="Message" onclick="navigateTo('{{ url('text_messg/'. $user->id ) }}')">💬</div>
                <div class="icon" role="button" style="background: #fff;padding: 3px 4px;" aria-label="video-call" onclick="navigateTo('{{ url('video_cal/' . $user->id) }}?autocall=1')">🎥</div>

            </div>
            <div class="name-label"><a href="{{ url('user/profile/' . $user->id) }}">{{$user->name}}</a></div>
        </div>
        @endif
        @endforeach
    </div>


</div>

@include('frontend.layout.navbar')


<script>
    function addEllipsis() {
        // Select all name-label elements
        const nameLabels = document.querySelectorAll('.name-label a');

        nameLabels.forEach(nameLink => {
            let text = nameLink.textContent || nameLink.innerText;

            // Check if the length of the name exceeds 14 characters
            if (text.length > 14) {
                nameLink.textContent = text.slice(0, 14) + '...'; // Slice name to 14 characters and add ellipsis
            }
        });
    }

    // Run the function when the page loads
    window.onload = addEllipsis;

</script>


<script>
    // Add hover effects and interactions
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('mouseover', () => {
            item.style.transform = 'scale(1.1)';
        });
        item.addEventListener('mouseout', () => {
            item.style.transform = 'scale(1)';
        });
    });

    // Add smooth transitions for all interactive elements
    document.querySelectorAll('.profile-card').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.transition = 'transform 0.3s ease';
        });
        card.addEventListener('mouseout', () => {
            card.style.transform = 'translateY(0)';
        });
    });

    // Add click handlers for profile cards
    document.querySelectorAll('.profile-card').forEach(card => {
        let isActive = false;

        // Handle click on profile image
        const profileImage = card.querySelector('.profile-image');
        profileImage.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent body click

            // Remove active class from all other cards
            document.querySelectorAll('.profile-card').forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('active');
                }
            });

            // Toggle active state
            isActive = !isActive;
            card.classList.toggle('active');
        });

        // Prevent name link from toggling icons
        const nameLink = card.querySelector('.name-label a');
        nameLink.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent card click
        });

        // Handle icon clicks (unchanged)
        card.querySelectorAll('.icon').forEach(icon => {
            icon.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent card click
                const action = icon.getAttribute('aria-label');
                const name = card.querySelector('.name-label').textContent;
                console.log(`${action} ${name}`);
                // Add your actual interaction handling here
            });
        });
    });

    // Close active card when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.profile-card')) {
            document.querySelectorAll('.profile-card').forEach(card => {
                card.classList.remove('active');
            });
        }
    });

</script>
@include('frontend.layout.footer')

