@include('frontend.layout.header')

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 200 !important;
        font-style: normal;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.svg') }}');
    }

    .navbar {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 60px;
    background: linear-gradient(to right, #264d26c2, #7b2f2fe8, #4e1f1fd4);
    display: flex !important;
    justify-content: center !important;
    align-items: flex-end !important;         /* force icon grow UP */
    overflow: visible !important;  /* allow icon to grow outside */
    white-space: nowrap !important;
    gap: 35px !important;
    z-index: 1000;
}

.navbar .icon {
    width: 48px !important;
    height: 48px !important;
    object-fit: contain !important;
    transition: transform 0.3s ease !important;
    cursor: pointer !important;
    position: relative !important;
    z-index: 2 !important;
}

.navbar .icon:hover,
.navbar .icon.active {
    transform: scale(3); /* 48px x 3 = 144px */
    transform-origin: bottom center; /* grow upward */
    z-index: 10;
}


    .name-label {
        background: rgba(200, 200, 200, 0.9);
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        white-space: nowrap;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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

    /* .icon {
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

    .navigation {
        display: flex;
        justify-content: space-around;
        padding: 15px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
        border-radius: 15px;
        position: relative;
        margin-top: auto;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        text-decoration: none;
        gap: 8px;
        transition: transform 0.2s;
    }

    .nav-icon {
        width: 45px;
        height: 45px;
        position: relative;
        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.3));
    }

    .nav-icon::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 20px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
    }

    .phone-icon {
        position: absolute;
        top: -10px;
        left: -10px;
        width: 35px;
        height: 35px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .chat-bubble {
        position: absolute;
        top: -5px;
        left: 20px;
        width: 35px;
        height: 35px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .nav-text {
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #myBtn {
        position: fixed;
        bottom: 160px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: transparent;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 4px;
    }

    .links {
        display: flex;
        gap: 70px;
        text-align: center;
        justify-content: center;
        padding: 16px 0px;
        font-size: 35px;
        color: #fff;
    }


    .gallery {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-around;
        align-items: center;
        padding: 2rem;
        flex-wrap: wrap;
        gap: 10rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .section {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .section:hover {
        transform: translateY(-10px);
    }

    .title {
        font-family: 'Cinzel Decorative', cursive;
        color: white;
        font-size: 2.5rem;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }

    .section:hover .title {
        opacity: 1;
    }

    .image-wrapper {
        width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 10px;
        position: relative;
    }

    .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .section:hover .image {
        transform: scale(1.1);
    }

    @media (max-width: 1200px) {
        .gallery {
            padding: 1rem;
        }

        .image-wrapper {
            width: 150px;
            height: 150px;
        }

        .title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .gallery {
            flex-direction: column;
        }

        .section {
            width: 100%;
            max-width: 300px;
        }

        .image-wrapper {
            width: 100%;
            height: 200px;
        }
    }

    @media screen and (max-width: 896px) and (orientation: landscape) {
        .gallery {
            gap: 0 !important;
            bottom: 30px;
        }

        .section {
            gap: 0rem;
            transition: transform 0.3s ease;
        }
    }


    /* Profile Container and Profile Row */
    .profiles-container {
        display: flex;
        flex-direction: column;
        gap: 40px;
        margin-bottom: 40px;
    }

    .profile-row {
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        width: 100%;
    }

    .profile-card {
        text-align: center;
        width: 100%;
        cursor: default;
        transition: transform 0.3s ease;
    }

    /* Image inside profile card */
    .profile-image {
        width: 420px;
        height: 220px;
        object-fit: cover;
        margin-bottom: 10px;
        cursor: pointer;
    }

    /* Icons container */
    .card-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 5px;
    }

    /* Individual icons */
    .card-icons img {
        width: 20px;
        height: 20px;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .card-icons img:hover {
        transform: scale(1.1);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .profile-row {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 900px) {
        .profile-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .profile-row {
            grid-template-columns: 1fr;
        }
    }

    /* Comment Panel Style */
    .comment-panel {
        position: fixed;
        top: 0;
        right: -100%;
        width: 40%;
        height: 100%;
        background: #111;
        color: white;
        transition: right 0.3s ease-in-out;
        padding: 20px;
        z-index: 1000;
        box-shadow: -4px 0px 10px rgba(0, 0, 0, 0.5);
    }

    .comment-panel.open {
        right: 0;
    }

    .comment-panel header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
    }

    .comment-panel header h3 {
        margin: 0;
    }

    .comment-panel button {
        background: #ff4d4d;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px;
        cursor: pointer;
    }

    .comment-panel button:hover {
        background: #ff1a1a;
    }

    .comment-panel .comment-section {
        margin-top: 20px;
    }

    .comment-panel textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        resize: vertical;
        min-height: 100px;
        font-size: 14px;
    }

    .comment-panel .send-button {
        background: #0084ff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


    .comment-panel .send-button:hover {
        background: #006bb3;
    }
    .comment-panel {
    /* Maximum height for the comment panel */
    max-height: 800px; /* Adjust this value to your needs */
    overflow-y: auto;  /* This will enable vertical scrolling */
}



    .comment-card {
        background-color: gray;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        padding: 15px;
        display: flex;
        flex-direction: column;
    }

    .comment-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .comment-user-info {
        display: flex;
        align-items: center;
    }

    .comment-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    .comment-username {
        font-weight: bold;
        font-size: 18px;
        color: white;
    }

    .comment-body {
        margin-top: 10px;
        font-size: 1rem;
        color: white;
    }

    .comment-footer {
        margin-left:2px; 
        font-size: 0.9rem;
        color: white;
    }

    .comment-actions {
        display: flex;
        justify-content: space-between;
    }

    .comment-actions .comment-action {
        cursor: pointer;
    }

    .comment-actions .heart-icon {
        width: 25px;
        height: 25px;
        margin-top: -5px;
    }

    .comment-actions span:hover {
        color: white;
    }

    .reply-card {
    margin-left: 20px;
    padding: 10px;
    background-color: #f9f9f9;
    border-left: 2px solid #ccc;
}



.reply-box {
    margin-top: 10px;
    padding: 10px;
    background-color: #f0f0f0;
}
.comment-action {
        cursor: pointer;
    }

    .replies-list {
    padding-left: 20px;
    margin-top: 10px;
}

/* Styling each individual reply */
.reply {
    display: flex;
    flex-direction: column;
    background-color: #1c1c1c; /* Dark background color for replies */
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 10px;
    color: #fff; /* White text color for better readability */
    font-size: 14px;
    max-width: 400px; /* Optional, for limiting width */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Optional shadow for card-like effect */
}

/* Styling the reply header */
.reply-header {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}

/* Profile image (circular) */
.reply-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    object-fit: cover; /* Ensures the image covers the circle nicely */
}

/* User info (name and time) */
.reply-info {
    display: flex;
    flex-direction: column;
}

/* User name style */
.reply-user-name {
    font-weight: bold;
    font-size: 16px;
    color: #fff; /* White for user name */
}

/* Reply time style */
.reply-time {
    font-size: 12px;
    color: #ccc; /* Light gray color for the time */
    margin-top: 4px;
}

/* Styling the reply text */
.reply-body {
    margin-top: 8px;
    font-size: 14px;
    line-height: 1.4;
    color: #ddd; /* Slightly lighter text color for reply content */
}

/* Optional button styles */
.view-replies {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 5px 10px;
    margin-top: 40px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;

}


/* Share Modal Styles */
.share-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 60px;
    }

    .share-modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 10px;
    }

    .share-modal-header {
        text-align: right;
    }

    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .share-options {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .share-options a img {
        width: 50px;
        height: 50px;
    }

    /* Full-width input field */
    .share-modal .input-field {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .share-modal .copy-btn {
        background: #0084ff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .share-modal .copy-btn:hover {
        background: #006bb3;
    }

    .links {
        display: flex;
        gap: 70px;
        text-align: center;
        justify-content: center;
        padding: 16px 0px;
        font-size: 35px;
        color: #fff;
    }



</style>

<div class="gallery">
    <a href="{{ route('signal_audio') }}" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Audio</h2>
        </div>
    </a>


    <a href="{{ route('stills') }}" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Stills</h2>
        </div>
    </a>

    <a href="{{ route('text_upload') }}" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Text</h2>
        </div>
    </a>

    <a href="{{ route('live_page') }}" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Video</h2>
        </div>
    </a>


    <a href="{{ route('live_screen') }}" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Live</h2>
        </div>
    </a>

</div>


<div class="profiles-container overflowww" style="overflow-y: auto !important;max-height: 53vh !important;">
    <!-- First Row -->
    <div class="profile-row">

        <div class="profile-card">
            <!-- Display image -->
            <img src="{{ asset($item->image) }}" class="profile-image" data-audio="{{ asset($item->audio) }}" onclick="toggleAudio(this)">

            <!-- Icons below the image -->
{{--             <div class="card-icons">
                <img id="likeIcon-{{ $item->id }}" src="{{ asset('assets/img/white.png') }}" alt="Heart" onclick="toggleAudioLike({{ $item->id }})" />
                <img id="commentIcon" src="{{ asset('assets/img/comment.svg') }}" alt="Chat" class="comment-icon" onclick="openCommentPanel({{ $item->id }})" />
            
                <img src="assets/img/Share.svg" alt="Share" onclick="shareContent({{ $item->id }})">
            </div>

            <div id="likeCount-{{ $item->id }}" style="font-size: 14px; margin-top: 4px; color:white; margin-left:-70px;">0</div>
            <div id="commentCountRight" style="font-size: 14px; margin-top:-22px; color:white; ">0</div>
 --}}
        </div>

    </div>


    <!-- Hidden audio element for controlling the playback -->
    <audio id="audioPlayer" style="display: none;">
        <source id="audioSource" type="audio/mp3">
    </audio>
</div>



@include('frontend.layout.navbar')



<!-- Comment Panel -->
<div class="comment-panel" id="commentPanel">
    <header>
        <h3>Comments</h3>
        <button onclick="closeCommentPanel()">Close</button>
    </header>
    <div class="comment-section">
        <textarea id="commentInput" class="comment-input" placeholder="Write a comment..." rows="4"></textarea>
        <button class="send-button" onclick="submitComment()">Send</button>
    </div>
    <hr>
    <div id="commentsList" class="comments-list"></div>
</div>


<!-- Share Modal -->
<div class="share-modal" id="shareModal">
    <div class="share-modal-content">
        <div class="share-modal-header">
            <span class="close" onclick="closeShareModal()">&times;</span>
        </div>
        <input type="text" id="shareLink" class="input-field" value="" readonly>
        <button class="copy-btn" onclick="copyLink()">Copy Link</button>

        <div class="share-options">
            <a id="whatsappShare" href="#" target="_blank">
                <i class="fab fa-whatsapp" style="font-size: 36px; color: #25d366;"></i>
            </a>
            <a id="facebookShare" href="#" target="_blank">
                <i class="fab fa-facebook" style="font-size: 36px; color: #3b5998;"></i>
            </a>
            <a id="twitterShare" href="#" target="_blank">
                <i class="fab fa-twitter" style="font-size: 36px; color: #1da1f2;"></i>
            </a>
            <a id="linkedinShare" href="#" target="_blank">
                <i class="fab fa-linkedin" style="font-size: 36px; color: #0077b5;"></i>
            </a>
        </div>
    </div>
</div>


<!--Upload audio & Fetch Audio-->
<script>
    document.querySelector('#uploadModal form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        const form = e.target;
        const formData = new FormData(form); // Create FormData object with the form data

        fetch("{{ route('upload-audio') }}", { // Make sure the route is correct
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include the CSRF token for security
                }
                , body: formData // Send the FormData as the body of the request
            })
            .then(res => res.json()) // Parse the response as JSON
            .then(data => {
                if (data.success) {
                    // Show success message
                    alert('Files Uploaded Successfully!');

                    // Reset the form after successful upload
                    form.reset();

                    // Hide the modal after successful upload
                    const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
                    modal.hide();

                    // Reload the page after a short delay to reflect the uploaded content
                    setTimeout(() => {
                        location.reload(); // Reload the page
                    }, 500);
                } else {
                    // Show error message if upload failed
                    alert('Upload failed!');
                }
            })
            .catch(err => {
                // Handle any errors that occur during the fetch request
                console.error('Error:', err);
                alert('An error occurred. Please try again later.');
            });
        fetchComments(audioId);
    });


    function toggleAudio(imageElement) {
        var audioSrc = imageElement.getAttribute('data-audio'); // Get the audio file path from the image's data-audio attribute
        var audioPlayer = document.getElementById('audioPlayer'); // Get the audio player element
        var audioSource = document.getElementById('audioSource'); // Get the audio source element

        // If the source has changed, update it
        if (audioSource.src !== audioSrc) {
            audioSource.src = audioSrc; // Set the audio player's source to the selected audio file
            audioPlayer.load(); // Reload the audio player with the new audio file
        }

        // If the audio is currently paused, play it, otherwise pause it
        if (audioPlayer.paused) {
            audioPlayer.play(); // Play the audio
        } else {
            audioPlayer.pause(); // Pause the audio
        }
        fetchComments(audioId);
    }

</script>

<!--audio like & Fetch Audio like -->
<script>
    const likeIcon = {
        liked: "{{ asset('assets/img/likee.svg') }}"
        , unliked: "{{ asset('assets/img/white.png') }}"
    };


    function toggleAudioLike(audioId) {
        fetch('/toggle-audio-like', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                , body: JSON.stringify({
                    audio_id: audioId
                })
            })
            .then(res => res.json())
            .then(data => {
                updateAudioLikeIcon(audioId, data.liked);
                loadAudioLikes(audioId); // Reload count
            })
            .catch(err => console.error(err));
    }

    function updateAudioLikeIcon(audioId, liked) {
        const icon = document.getElementById(`likeIcon-${audioId}`);
        if (icon) {
            icon.src = liked ? likeIcon.liked : likeIcon.unliked;
        }
    }

    function loadAudioLikes(audioId) {
        fetch(`/get-audio-likes?audio_id=${audioId}`)
            .then(res => res.json())
            .then(data => {
                const countEl = document.getElementById(`likeCount-${audioId}`);
                countEl.innerText = `${data.likes_count} ${data.likes_count !== 1 ? '' : ''}`;
                updateAudioLikeIcon(audioId, data.user_liked);
            })
            .catch(err => console.error(err));
    }

    // Optional: Load all audio like counts on page load
    window.onload = function() {
        const allAudioIds = @json($item -> pluck('id'));
        allAudioIds.forEach(id => loadAudioLikes(id));
    };

</script>
<!--end audio like & Fetch Audio like -->

<script>
    
    function timeAgo(dateString) {
        const now = new Date();
        const commentDate = new Date(dateString);
        const seconds = Math.floor((now - commentDate) / 1000);

        if (seconds < 60) return 'Just now';
        const minutes = Math.floor(seconds / 60);
        if (minutes < 60) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
        const hours = Math.floor(minutes / 60);
        if (hours < 24) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
        const days = Math.floor(hours / 24);
        return `${days} day${days > 1 ? 's' : ''} ago`;
    }

    function openCommentPanel(audioId) {
        const panel = document.getElementById('commentPanel');
        const commentInput = document.getElementById('commentInput');

        // Set the audio_id in the comment input to maintain state
        commentInput.setAttribute('data-audio-id', audioId);

        // Show the comment panel smoothly
        panel.classList.add('open');

        // Fetch and display the comments in real-time
        fetchComments(audioId);
    }


    function closeCommentPanel() {
        const panel = document.getElementById('commentPanel');

        // Remove the class to smoothly close the modal
        panel.classList.remove('open');
    }

    function submitComment() {
        const commentInput = document.getElementById('commentInput');
        const audioId = commentInput.getAttribute('data-audio-id'); // Get the audio_id
        const comment = commentInput.value.trim();

        if (!comment) {
            alert('Please write a comment.');
            return;
        }

        fetch('/submit-audio-comment', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                , body: JSON.stringify({
                    audio_id: audioId
                    , comment: comment
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('commentInput').value = "";
                fetchComments(audioId);

            })
            .catch(err => console.error(err));
    }

    



    function fetchComments(audioId) {
        fetch(`/get-comments?audio_id=${audioId}`)
        .then(response => response.json())
        .then(data => {
            const commentsList = document.getElementById('commentsList');
            commentsList.innerHTML = '';

            const commentCountRight = document.getElementById('commentCountRight');
            commentCountRight.innerText = `${data.comments.length} Comment${data.comments.length > 1 ? 's' : ''}`;

            data.comments.forEach(comment => {
                const commentElement = document.createElement('div');
                commentElement.classList.add('comment-card');

                const hasReplies = comment.replies_count > 0;
                const likeClass = comment.user_has_liked ? 'liked' : '';

                commentElement.innerHTML = `
                    <div class="comment-header">
                        <div class="comment-user-info">
                            <img src="${comment.user.profile_picture}" alt="${comment.user.name}" class="comment-user-avatar">
                            <strong class="comment-username">${comment.user.name}</strong>
                        </div>
                    </div>
                    <div class="comment-body">${comment.comment}</div>
                    <div class="comment-footer">
                        <span class="comment-time">${timeAgo(comment.created_at)}</span>
                        <span class="comment-action" onclick="toggleReplyBox(event)">Reply</span>

                        <span id="heartIcon-${comment.id}" class="comment-action">
                            <img src="${comment.user_has_liked ? 'assets/img/likee.svg' : 'assets/img/white.png'}"
                                 alt="Heart"
                                 id="likeIcon-${comment.id}"
                                 class="heart-icon ${likeClass}"
                                 onclick="AudioCommentLike(${comment.id})"
                                 style="width: 25px; height: 25px; margin-top: -5px;">
                        </span>

                        <span id="likeCount-${comment.id}" class="like-count">${comment.likes_count} Like</span>
                    </div>

                    <div class="reply-box" style="display: none;">
                        <textarea class="reply-input" placeholder="Write a reply..."></textarea>
                        <button class="reply-send" onclick="sendReply(event, ${comment.id})">Reply</button>
                    </div>

                    ${hasReplies ? `
                    <span class="view-replies" onclick="viewReplies(event, ${comment.id})">View reply</span>
                    ` : ''}

                    <div class="replies-list" id="replies-${comment.id}" style="display: none;"></div>
                `;
                commentsList.appendChild(commentElement);
            });
        });
}

function AudioCommentLike(commentId) {
    fetch('/toggle-audio-comment-like', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ comment_id: commentId })
    })
    .then(res => res.json())
    .then(data => {
        updateAudioCommentLikeIcon(data.liked, commentId);
        loadAudioCommentLikes(commentId);
    })
    .catch(err => console.error(err));
}

function updateAudioCommentLikeIcon(liked, commentId) {
    const likeIcon = document.getElementById(`likeIcon-${commentId}`);
    if (liked) {
        likeIcon.src = 'assets/img/likee.svg'; // Liked icon
    }
    else {
            likeIcon.src = 'assets/img/white.png'; // Unliked icon
        }
}

function loadAudioCommentLikes(commentId) {
    fetch(`/get-audio-comment-likes?comment_id=${commentId}`)
        .then(response => response.json())
        .then(data => {
            const likeCountElement = document.getElementById(`likeCount-${commentId}`);
            likeCountElement.innerText = `${data.likes_count} Like${data.likes_count !== 1 ? 's' : ''}`;
            updateAudioCommentLikeIcon(data.user_liked, commentId);
        })
        .catch(err => console.error(err));
}

    


    // Function to toggle the visibility of the reply box
    function toggleReplyBox(event) 
    {
        const replyBox = event.target.closest('.comment-card').querySelector('.reply-box');
        if (replyBox) {
            replyBox.style.display = replyBox.style.display === 'none' ? 'block' : 'none';
        }
    }

    // Function to send the reply to the backend
    function sendReply(event, commentId)
    {
        const replyText = event.target.closest('.reply-box').querySelector('.reply-input').value;

        if (!replyText.trim()) {
            return alert("Reply cannot be empty!");
        }

        // Log the commentId and replyText to see what is being sent
        console.log('Comment ID:', commentId);
        console.log('Reply Text:', replyText);

        // Sending the reply to the backend
        fetch("/submit-reply", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                comment_id: commentId, // Make sure this is correctly passed from the button
                reply_text: replyText,  // The reply text entered by the user
            })
        })
        .then(res => {
            if (!res.ok) {
                throw new Error('Failed to post reply');
            }
            return res.json();
        })
        .then(data => {
            if (data.success) {
                // Clear the reply input field after submission
                event.target.closest('.reply-box').querySelector('.reply-input').value = "";
            } else {
                alert('Failed to post reply');
            }
        })
        .catch(err => {
            console.error(err);
            alert('There was an error posting the reply.');
        });
    }

        // Function to get the reply 
    function viewReplies(event, commentId) {
        const repliesContainer = document.getElementById(`replies-${commentId}`);

        // Toggle the visibility of the replies section
        if (repliesContainer.style.display === 'none') {
            fetch(`/replies/${commentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.replies.length === 0) {
                        repliesContainer.innerHTML = '<p>No replies yet.</p>';
                    } else {
                        // Clear existing replies
                        repliesContainer.innerHTML = '';
                        data.replies.forEach(reply => {
                            const replyElement = document.createElement('div');
                            replyElement.classList.add('reply');
                            replyElement.innerHTML = `
                            <div class="reply-header">
                                <img src="${reply.user.profile_picture}" class="reply-avatar" alt="${reply.user.name}" />
                                <div class="reply-info">
                                    <strong class="reply-user-name">${reply.user.name}</strong>
                                </div>
                            </div>
                            <div class="reply-body">
                                ${reply.reply}
                            </div>
                             <span class="reply-time">${timeAgo(reply.created_at)}</span>
                        `;
                            repliesContainer.appendChild(replyElement);
                        });
                    }

                    // Show the replies section
                    repliesContainer.style.display = 'block';
                });
        } else {
            // Hide the replies if already visible
            repliesContainer.style.display = 'none';
        }
    }


</script>



{{-- Share audio --}}
<script>
    function shareContent(audioId) {
        const baseUrl = window.location.origin;
        const audioUrl = `${baseUrl}/share-audio/${audioId}`; // Make sure this matches your route

        document.getElementById('shareLink').value = audioUrl;

        // Set share links
        document.getElementById('whatsappShare').href = `https://api.whatsapp.com/send?text=Check this audio: ${audioUrl}`;
        document.getElementById('facebookShare').href = `https://www.facebook.com/sharer/sharer.php?u=${audioUrl}`;
        document.getElementById('twitterShare').href = `https://twitter.com/intent/tweet?url=${audioUrl}`;
        document.getElementById('linkedinShare').href = `https://www.linkedin.com/shareArticle?mini=true&url=${audioUrl}`;

        // Show modal
        document.getElementById('shareModal').style.display = 'block';
    }

    function closeShareModal() {
        document.getElementById('shareModal').style.display = 'none';
    }

    // Optional: Click outside to close
    window.onclick = function(event) {
        const modal = document.getElementById('shareModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }

    function copyLink() {
        const linkInput = document.getElementById('shareLink');
        linkInput.select();
        linkInput.setSelectionRange(0, 99999);
        document.execCommand('copy');
        alert('Link copied to clipboard!');
    }
</script>

{{-- end Share audio --}}



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
<script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "block";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>
@include('frontend.layout.footer')

