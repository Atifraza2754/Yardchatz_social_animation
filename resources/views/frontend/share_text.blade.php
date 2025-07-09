@include('frontend.layout.header')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        font-family: "Irish Grover", serif;
        font-weight: 200 !important;
        font-style: normal;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');
        height: 100vh;
        /* Full viewport height */
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


    .profiles-container {
        display: flex;
        flex-direction: column;
        gap: 40px;
        margin-bottom: 115px;
        flex-grow: 1;
        /* Take up remaining space */
        overflow-y: auto;
        /* Make it scrollable if content overflows */
    }

    .profile-row {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        width: 90%;
    }

    .profile-card {
        text-align: center;
        position: relative;
        width: 150px;
        cursor: default;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
        cursor: pointer;
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

    .profile-card.active .interaction-icons {
        opacity: 1;
        visibility: visible;
    }

    .profile-card.active .profile-image {
        transform: scale(0.9);
        filter: brightness(0.7);
    }

    .navigation {
        display: flex;
        justify-content: space-around;
        padding: 15px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
        border-radius: 15px;
        position: fixed;
        bottom: 20px;
        /* Fixed at the bottom */
        width: 100%;
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

    @media screen and (max-width: 896px) and (orientation: landscape) {
        .profile-row {
            width: 85% !important;
        }

        .overflowww {
            overflow-y: auto !important;
            max-height: 60vh !important;
        }
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

   
    
    #textOverlay {
    width: auto;
    color: black;
    font-size: 24px;
    font-weight: bold;
    word-wrap: break-word; /* Allow long words to break if necessary */
    white-space: normal; /* Allow normal text wrapping */
    text-align: left; /* Align text to the left */
    font-family: 'Courier New', monospace; /* Monospace font to ensure consistent character width */
}

.card-icons {
        margin-left: -158px;
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-top: -30px;
    }

    /* Individual icons */
    .card-icons img {
        width: 30px;
        height: 30px;
        cursor: pointer;
        transition: transform 0.2s;
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
        max-height: 800px;
        /* Adjust this value to your needs */
        overflow-y: auto;
        /* This will enable vertical scrolling */
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
        margin-left: 2px;
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

.page-header {
    font-size: 20px;
    text-align: center;
    margin-bottom: 10px;
}

.flip-book {
    margin: 0 auto;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
}

.page-text {
    font-size: 14px;
    margin-top: 15px;
    text-align: justify;
}

.page-footer {
    margin-top: auto;
    text-align: right;
    font-size: 12px;
    color: black;
}

.page-content {
    padding: 25px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    height: auto;
}

.page-dynamic-height {
    margin-bottom: 30px;
    border-radius: 6px;
    overflow: hidden;
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


<div class="container-fluid" style="height: 80vh; overflow-y: auto;">
    <div class="container py-5">
        <div class="flip-book" id="demoBookExample">
                <div class="page page-dynamic-height" id="text-wrapper-{{ $frame->id }}">
                    <div class="page-content">
                        <!-- Description -->
                        <div class="page-text">
                            {!! $frame->text_in_image !!}
                        </div>

                    <!-- Profile picture of the user who uploaded the text/image -->
                    <div style="position: absolute; top: -5px; right:-7px;">
                        @if($frame->user && $frame->user->profile_picture)
                        <a href="{{ url('user/profile/' . $frame->user->id) }}">
                            <img src="{{ asset($frame->user->profile_picture) }}" alt="{{ $frame->user->name }}" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid white;">
                        </a>
                            @else
                            <img src="{{ asset('assets/img/default-avatar.png') }}" alt="Default Avatar" style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid white;">
                        @endif
                    </div>

                        <div id="pin-badge-{{ $frame->id }}" style="position: absolute; top:10px; left: -467px; z-index: 2;">
                            @if($frame->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count())
                                <img src="{{ asset('assets/img/pinned.svg') }}" alt="Pinned" style="width: 25px; height: 25px; margin-left:475px; top:10px;" />
                            @endif
                        </div>
                    </div>

                     <!-- Social Icons Grouped Below Image -->
                        <div class="card-icons d-flex align-items-center gap-4 mt-2">
                            <!-- Like Icon -->
                            <img id="likeIcon-{{ $frame->id }}" src="{{ $frame->likes->isEmpty() ? asset('assets/img/white.png') : asset('assets/img/likee.svg') }}" alt="Heart" onclick="likeText({{ $frame->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img id="commentIcon" src="{{ asset('assets/img/comment.svg') }}" alt="Chat" class="comment-icon" onclick="openCommentPanel({{ $frame->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img src="{{ asset('assets/img/Share.svg') }}" alt="Share" onclick="shareContent({{ $frame->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                            @php
                                $isPinned = $frame->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count() > 0;
                            @endphp
                            <img src="{{ asset($isPinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg') }}" alt="pin" onclick="pinText({{ $frame->id }}, this)" style="filter: brightness(0) invert(1);  width: 24px; height: 24px; cursor: pointer;" />

                            <span id="likeCount-{{ $frame->id }}" style="font-size: 16px; color:white; margin-top:50px; margin-left:-185px;">
                                {{ $frame->getLikeCount() }}
                            </span>
                            <span id="commentCount-{{ $frame->id }}" style="font-size: 16px; color:white; margin-top:50px; margin-left:16px;">
                                {{ $frame->comments->count() }}
                            </span>
                        </div>
                </div>
        </div>
    </div>
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









<!-- Include JavaScript file -->
<script src="{{ asset('assets/js/text.js') }}"></script>

{{-- end upload text --}}
@include('frontend.layout.footer')

