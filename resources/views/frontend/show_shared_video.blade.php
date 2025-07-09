@include('frontend.layout.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="{{asset('assets/css/atif.css')}}">

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

<div class="container">

    <div class="video-section" onclick="togglePlayPause()">
        <video id="videoPlayer" src="{{ asset($videos->video_path) }}" loop playsinline></video>

        <div id="playPauseOverlay" class="play-pause-overlay">
            <span id="playPauseIcon">►</span>
        </div>
    </div>

    <div class="user-info">
        <div class="user-profile">
            <a id="userProfileImage" class="userProfileImage" href="{{ url('user/profile/' . $videos->user->id) }}">
                <img id="userProfileImage" src="{{ asset($videos->user->profile_picture) }}" class="profile-img">
            </a>
            <a id="username" class="username" href="{{ url('user/profile/' . $videos->user->id) }}">
                {{ $videos->user->name }}
            </a>
        </div>
        <div class="video-info">
            <span id="videoTitle" class="video-title">{{ $videos->title }}</span>
        </div>
    </div>

    {{-- <div class="controls">
        <button onclick="changeVideo('prev')">⬆ Previous</button>
        <button onclick="changeVideo('next')">⬇ Next</button>
    </div>
 --}}

    <div class="sidebar">
        <a href="{{ route('preview_video') }}" style="text-decoration: none;"><img src="{{asset('assets/img/avatarrr.svg')}}" alt="Avatar"></a>
        <img id="likeIcon" src="{{asset('assets/img/white.png')}}" alt="Heart" onclick="toggleLike({{ $videos->id }})">
        <div id="likeCount">0 Likes</div>
        <div class="comment-icon-wrapper" onclick="openCommentPanel()">
            <img src="{{asset('assets/img/comment.svg')}}" alt="Chat" class="comment-icon">
            <div id="commentCountRight" class="comment-icon-count">0 Comment</div>
        </div>

        <img id="favoriteIcon" src="{{asset('assets/img/Save.svg')}}" alt="Favorite" onclick="toggleFavorite({{ $videos->id }})" />
        <div id="favoritesCount" class="comment-icon-count">0 Favorites</div> <!-- New count element -->


        <img src="{{asset('assets/img/Share.svg')}}" alt="Share" onclick="shareContent({{ $videos->id }})">
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

{{-- like,comment and favorite icon --}}
<script>
    const likeIconPath = {
        liked: "{{ asset('assets/img/likee.svg') }}"
        , unliked: "{{ asset('assets/img/white.png') }}"
    };

    const commentLikeIconPath = {
        liked: "{{ asset('assets/img/likee.svg') }}"
        , unliked: "{{ asset('assets/img/white.png') }}"
    };

    const favoriteIconPath = {
        favorited: "{{ asset('assets/img/save2.svg') }}"
        , notFavorited: "{{ asset('assets/img/Save.svg') }}"
    };

    const baseAssetUrl = "{{ asset('') }}"; // Ends with trailing slash

</script>

{{-- end like,comment and favorite icon --}}


{{-- video js --}}
<script>
    const videos = [@json($videos)]; // 👈 Make it an array
    let currentIndex = 0;
    const videoElement = document.getElementById('videoPlayer');
    const playPauseIcon = document.getElementById('playPauseIcon');
    const playPauseOverlay = document.getElementById('playPauseOverlay');

    function updateVideoContent(index) {
        const video = videos[index];
        videoElement.src = `/${video.video_path}`;
        document.getElementById('username').innerText = video.user.name;
        document.getElementById('username').href = `/user/profile/${video.user.id}`;

        const profileImageAnchor = document.getElementById('userProfileImage');
        const profileImage = profileImageAnchor.querySelector('img');
        profileImage.src = `/${video.user.profile_picture}`;
        profileImageAnchor.href = `/user/profile/${video.user.id}`;

        document.getElementById('videoTitle').innerText = video.title;

        loadLikes(video.id);
        loadFavorites(video.id);
        loadComments(video.id);

        // Reset play icon
        playPauseIcon.innerHTML = "►";
        playPauseOverlay.style.display = "block";
        videoElement.pause();
    }

    window.onload = () => {
        updateVideoContent(currentIndex);
        videoElement.play().then(() => {
            playPauseIcon.innerHTML = "❚❚";
        });
    };

    function togglePlayPause() {
        if (videoElement.paused || videoElement.ended) {
            videoElement.play();
            playPauseIcon.innerHTML = "❚❚";
            playPauseOverlay.style.display = "block";
        } else {
            videoElement.pause();
            playPauseIcon.innerHTML = "►";
            playPauseOverlay.style.display = "block";
        }

        setTimeout(() => {
            playPauseOverlay.style.display = "none";
        }, 1000);
    }

</script>

{{-- end video --}}


{{-- comment js --}}
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


    function openCommentPanel() {
        document.getElementById('commentPanel').classList.add('open');
        loadComments(videos[currentIndex].id); // Load comments for current video
    }

    function closeCommentPanel() {
        document.getElementById('commentPanel').classList.remove('open');
    }

    function submitComment() {
        const commentText = document.getElementById('commentInput').value;
        const videoId = videos[currentIndex].id;

        if (!commentText.trim()) return alert("Comment cannot be empty!");

        fetch("/add-comment", {
                method: "POST"
                , headers: {
                    "Content-Type": "application/json"
                    , "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
                , body: JSON.stringify({
                    video_id: videoId
                    , comment: commentText
                })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById('commentInput').value = "";
                loadComments(videoId);
            })
            .catch(err => console.error(err));
    }
    document.addEventListener("DOMContentLoaded", function() {
        const videoId = videos[currentIndex].id;
        loadComments(videoId);
    });

    function loadComments(videoId) {
        fetch(`/comments?video_id=${videoId}`)
            .then(response => response.json())
            .then(data => {
                const commentsList = document.getElementById('commentsList');
                commentsList.innerHTML = ''; // Clear previous comments

                const commentCountRight = document.getElementById('commentCountRight');
                commentCountRight.innerText = `${data.comments.length} Comment${data.comments.length > 1 ? 's' : ''}`;


                // Loop through each comment
                data.comments.forEach(comment => {
                    const commentElement = document.createElement('div');
                    commentElement.classList.add('comment-card');

                    const hasReplies = comment.replies_count > 0;

                    // Add the 'liked' class if the user has liked the comment
                    const likeClass = comment.user_has_liked ? 'liked' : '';

                    commentElement.innerHTML = `
                    <div class="comment-header">
                        <div class="comment-user-info">
                    <img src="${baseAssetUrl + comment.user.profile_picture}" alt="${comment.user.name}" class="comment-user-avatar">

                            <strong class="comment-username">${comment.user.name}</strong>
                        </div>
                    </div>
                    <div class="comment-body">${comment.comment}</div>
                    <div class="comment-footer">
                        <span class="comment-time">${timeAgo(comment.created_at)}</span>
                        <span class="comment-action" onclick="toggleReplyBox(event)">Reply</span>
                        
                        <!-- Heart icon for like/unlike -->
                        <span id="heartIcon-${comment.id}" class="comment-action">
                            <img src="${comment.user_has_liked ? commentLikeIconPath.liked : commentLikeIconPath.unliked}"
                                alt="Heart" id="likeIcon-${comment.id}" class="heart-icon ${likeClass}" onclick="CommentLike(${comment.id})" style="width: 25px; height: 25px; margin-top: -5px;">
                        </span>

                        <!-- Like count -->
                        <span id="likeCount-${comment.id}" class="like-count">${comment.likes_count} Like</span>
                    </div>

                    <div class="reply-box" style="display: none;">
                        <textarea class="reply-input" placeholder="Write a reply..."></textarea>
                        <button class="reply-send" onclick="sendReply(event, ${comment.id})">Reply</button>
                    </div>
                    
                    <!-- Conditionally render the View Reply button if there are replies -->
                    ${hasReplies ? `
                    <span class="view-replies" onclick="viewReplies(event, ${comment.id})">View reply</span>
                    ` : ''}

                    <div class="replies-list" id="replies-${comment.id}" style="display: none;">
                        <!-- Replies will be displayed here -->
                    </div>
                `;
                    commentsList.appendChild(commentElement);
                });
            });
    }

    function CommentLike(commentId) {
        fetch('/toggle-comment-like', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                , body: JSON.stringify({
                    comment_id: commentId
                })
            })
            .then(res => res.json())
            .then(data => {
                // Update like icon based on the response
                updateCommentLikeIcon(data.liked, commentId);
                loadCommentLikes(commentId); // Reload like count
            })
            .catch(err => console.error(err));
    }

    function updateCommentLikeIcon(liked, commentId) {
        const likeIcon = document.getElementById(`likeIcon-${commentId}`);
        likeIcon.src = liked ? commentLikeIconPath.liked : commentLikeIconPath.unliked;
    }


    function loadCommentLikes(commentId) {
        fetch(`/get-comment-likes?comment_id=${commentId}`)
            .then(response => response.json())
            .then(data => {
                const likeCountElement = document.getElementById(`likeCount-${commentId}`);
                likeCountElement.innerText = `${data.likes_count} Like${data.likes_count !== 1 ? 's' : ''}`;
                updateCommentLikeIcon(data.user_liked, commentId); // Update the like icon based on user status
            })
            .catch(err => console.error(err));
    }


    // Function to toggle the visibility of the reply box
    function toggleReplyBox(event) {
        const replyBox = event.target.closest('.comment-card').querySelector('.reply-box');
        if (replyBox) {
            replyBox.style.display = replyBox.style.display === 'none' ? 'block' : 'none';
        }
    }

    // Function to send the reply to the backend
    function sendReply(event, commentId) {
        const replyText = event.target.closest('.reply-box').querySelector('.reply-input').value;

        if (!replyText.trim()) {
            return alert("Reply cannot be empty!");
        }

        fetch("/add-reply", {
                method: "POST"
                , headers: {
                    "Content-Type": "application/json"
                    , "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                }
                , body: JSON.stringify({
                    comment_id: commentId
                    , reply_text: replyText
                })
            })
            .then(res => res.json())
            .then(data => {
                // Clear the reply input field after submission
                event.target.closest('.reply-box').querySelector('.reply-input').value = "";



                // Reload the comments (this will reload both comments and replies)
                loadComments(videos[currentIndex].id);
            })
            .catch(err => console.error(err));
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
                               <img src="${baseAssetUrl + reply.user.profile_picture}" class="reply-avatar" alt="${reply.user.name}" />
                                <div class="reply-info">
                                    <strong class="reply-user-name">${reply.user.name}</strong>
                                </div>
                            </div>
                            <div class="reply-body">
                                ${reply.reply_text}
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
{{-- end comment --}}


{{-- like video --}}
<script>
    function toggleLike() {
        const videoId = videos[currentIndex].id;

        fetch('/toggle-like', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                , body: JSON.stringify({
                    video_id: videoId
                })
            })
            .then(res => res.json())
            .then(data => {
                updateLikeIcon(data.liked);
                loadLikes(videoId);
            })
            .catch(err => console.error(err));
    }

    function updateLikeIcon(liked) {
        const likeIcon = document.getElementById('likeIcon');
        likeIcon.src = liked ? likeIconPath.liked : likeIconPath.unliked;
    }

    function loadLikes(videoId) {
        fetch(`/get-likes?video_id=${videoId}`)
            .then(response => response.json())
            .then(data => {
                const likeCountElement = document.getElementById('likeCount');
                likeCountElement.innerText = `${data.likes_count} Like${data.likes_count !== 1 ? 's' : ''}`;
                updateLikeIcon(data.user_liked);
            })
            .catch(err => console.error(err));
    }

    window.onload = () => {
        updateVideoContent(currentIndex);
        loadLikes(videos[currentIndex].id);
    };

    function updateVideoContent(index) {
        const video = videos[index];
        videoElement.src = `/${video.video_path}`;
        document.getElementById('username').innerText = video.user.name;
        document.getElementById('username').href = `/user/profile/${video.user.id}`;
        document.getElementById('videoTitle').innerText = video.title;

        loadLikes(video.id);
    }

</script>

{{-- end like video --}}

{{-- favorite video --}}
<script>
    function toggleFavorite() {
        const videoId = videos[currentIndex].id;

        fetch('/toggle-favorite', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                , body: JSON.stringify({
                    video_id: videoId
                })
            })
            .then(res => res.json())
            .then(data => {
                // Update favorite icon based on the response
                updateFavoriteIcon(data.favorited);
                loadFavorites(videoId); // Reload favorite count
            })
            .catch(err => console.error(err));
    }

    function updateFavoriteIcon(favorited) {
        const favoriteIcon = document.getElementById('favoriteIcon');
        favoriteIcon.src = favorited ? favoriteIconPath.favorited : favoriteIconPath.notFavorited;
    }


    function loadFavorites(videoId) {
        fetch(`/get-favorites?video_id=${videoId}`)
            .then(response => response.json())
            .then(data => {
                updateFavoriteIcon(data.user_favorited); // Update the favorite icon based on user status
                updateFavoritesCount(data.favorites_count);
            })
            .catch(err => console.error(err));
    }

    function updateFavoritesCount(count) {
        const favoritesCountElement = document.getElementById('favoritesCount');
        favoritesCountElement.innerText = `${count} Favorite${count > 1 ? 's' : ''}`; // Display the count
    }
    // Call loadFavorites when the page loads or the video changes
    window.onload = () => {
        updateVideoContent(currentIndex);
        loadFavorites(videos[currentIndex].id); // Load initial favorites for the video
    };

    function updateVideoContent(index) {
        const video = videos[index];
        videoElement.src = `/${video.video_path}`;
        document.getElementById('username').innerText = video.user.name;
        document.getElementById('username').href = `/user/profile/${video.user.id}`;
        document.getElementById('videoTitle').innerText = video.title;

        loadFavorites(video.id); // Load favorites for the new video
        loadLikes(video.id);
    }

</script>
{{-- end favorite video --}}


@include('frontend.layout.footer')

