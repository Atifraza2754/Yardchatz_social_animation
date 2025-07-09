@include('frontend.layout.header')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Bootstrap Bundle JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/audio.css')}}">



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
        background-image: url(assets/img/ssdRectangle.svg);
        }


    .modal-header {
        background-color: #007bff; /* Blue color, you can change this */
        color: white;
    }

    /* Modal Buttons */
    .modal-footer .btn-secondary {
        background-color: #28a745; /* Green color for "No" button */
        border-color: #28a745;
    }

    .modal-footer .btn-danger {
        background-color: #dc3545; /* Red color for "Yes" button */
        border-color: #dc3545;
    }

    /* Modal Button Hover Effects */
    .modal-footer .btn-secondary:hover {
        background-color: #218838; /* Darker green for hover */
        border-color: #1e7e34;
    }

    .modal-footer .btn-danger:hover {
        background-color: #c82333; /* Darker red for hover */
        border-color: #bd2130;
    }
     .modal-footer{
        margin-bottom: 10px;
        margin-left: 15px;
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
        @foreach($media as $item)
            @if(canViewProfile(auth()->user(), $item->user))
        <div class="profile-card" id="audio-card-{{ $item->id }}" style="position: relative;">
            <div style="position: absolute; top: 2px; right: 14px;">
                <a href="{{ url('user/profile/' . $item->user->id) }}">
                    <img src="{{ asset($item->user->profile_picture) }}" alt="{{ $item->user->name }}" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid white;">
                </a>
            </div>

            <div id="pin-badge-{{ $item->id }}" style="position: absolute; margin-left:143px; top:5px;  z-index: 2;">
                @if($item->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count())
                        <img src="{{ asset('assets/img/pinned.svg') }}" alt="Pinned" style="width: 20px; height: 20px;" />
                @endif
            </div>

            <img src="{{ asset($item->image) }}" class="profile-image" data-audio="{{ asset($item->audio) }}" onclick="toggleAudio(this)">
            <!-- Icons below the image -->
            <div class="card-icons">
                <img id="likeIcon-{{ $item->id }}" src="{{ asset('assets/img/white.png') }}" alt="Heart" onclick="toggleAudioLike({{ $item->id }})" />
                <img id="commentIcon" src="{{ asset('assets/img/comment.svg') }}" alt="Chat" class="comment-icon" onclick="openCommentPanel({{ $item->id }})" />
                <img src="assets/img/Share.svg" alt="Share" onclick="shareContent({{ $item->id }})">

                @php
                    $isPinned = $item->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count() > 0;
                @endphp

                <img src="{{ asset($isPinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg') }}" alt="pin"
                    onclick="pinAudio({{ $item->id }}, this)"
                    style="width:20px; height: 20px; filter: brightness(0) invert(1); " />

                @if(auth()->id() == $item->user_id)  <!-- Check if logged-in user is the owner -->
                <div >
                    <img src="{{ asset('assets/img/delete.svg') }}" alt="Delete" style="width: 25px; height: 25px;" onclick="openDeleteModal({{ $item->id }})">
                </div>
                @endif

            </div>

            <div id="likeCount-{{ $item->id }}" style="font-size: 14px; margin-top: 4px; color:white; margin-left:-109px;">0</div>
            <div id="commentCount-{{ $item->id }}" style="font-size: 14px; margin-top:-15px; color:white; margin-left:-37px;" >0</div>

        </div>
        @endif
        @endforeach
    </div>


    <audio id="audioPlayer" style="display: none;">
        <source id="audioSource" type="audio/mp3">
    </audio>
</div>



<!-- Trigger Button -->
<a href="#" id="myBtn" data-bs-toggle="modal" data-bs-target="#uploadModal">
    <img src="assets/img/Record.svg" alt="">
</a>


@include('frontend.layout.navbar')



<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Audio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this audio?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for file upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Image & Audio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="imageUpload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="imageUpload" name="image" accept="image/*" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="audioUpload" class="form-label">Upload Audio</label>
                            <input class="form-control" type="file" id="audioUpload" name="audio" accept="audio/*" required>
                        </div>
                    </div>
                    <div class="text-end" style="margin-top: 5px;">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>

                <!-- Success message -->
                <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                    <strong>Success!</strong> Your files have been uploaded successfully.
                    <button type="button" class="btn btn-success" id="reloadPageBtn">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

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


<script>
// Open modal
document.querySelectorAll('[data-modal-target="#uploadModal"]').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('uploadModal').classList.add('show');
    });
});

// Close modal
document.querySelectorAll('[data-bs-dismiss="modal"], .btn-close').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('uploadModal').classList.remove('show');
    });
});

// Reload on success
document.getElementById('reloadPageBtn')?.addEventListener('click', () => {
    location.reload();
});

</script>



<!--Upload audio & Fetch Audio-->
<script>
    document.querySelector('#uploadModal form').addEventListener('submit', function(e) {
        e.preventDefault(); 

        const form = e.target;
        const formData = new FormData(form); 

        fetch("{{ route('upload-audio') }}", { 
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                }
                , body: formData // Send the FormData as the body of the request
            })
            .then(res => res.json()) 
            .then(data => {
                if (data.success) {
                    alert('Files Uploaded Successfully!');
                    form.reset();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
                    modal.hide();

                    setTimeout(() => {
                        location.reload(); 
                    }, 500);
                } else {
                    alert('Upload failed!');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('An error occurred. Please try again later.');
            });
        fetchComments(audioId);
    });


    function toggleAudio(imageElement) {
        var audioSrc = imageElement.getAttribute('data-audio'); 
        var audioPlayer = document.getElementById('audioPlayer'); 
        var audioSource = document.getElementById('audioSource'); 
        var audioId = imageElement.getAttribute('data-id');  


        if (audioSource.src !== audioSrc) {
            audioSource.src = audioSrc; 
            audioPlayer.load(); 
        }

        
        if (audioPlayer.paused) {
            audioPlayer.play(); 
        } else {
            audioPlayer.pause(); 
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
        window.onload = function () {
        const allAudioIds = @json($media->pluck('id'));
        allAudioIds.forEach(id => {
            loadAudioLikes(id);              // Load likes
            loadAudioCommentsCount(id);     // Load comment count for each
        });
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
                loadAudioCommentsCount(audioId);        

            })
            .catch(err => console.error(err));
    }


    function loadAudioCommentsCount(audioId) {
        fetch(`/get-audio-comments-count?audio_id=${audioId}`)
        .then(res => res.json())
        .then(data => {
            const commentCountEl = document.getElementById(`commentCount-${audioId}`);
            if (commentCountEl) {
                commentCountEl.innerText = `${data.comment_count} ${data.comment_count !== 1 ? '' : ''}`;
            }
        })
        .catch(err => console.error(err));
    }

    
    function fetchComments(audioId) {
    fetch(`/get-audio-comments?audio_id=${audioId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Fetched comments:', data); // Debugging: Check the data received
            const commentsList = document.getElementById('commentsList');
            commentsList.innerHTML = '';

            if (data.comments && data.comments.length > 0) {
                data.comments.forEach(comment => {
                    const commentElement = document.createElement('div');
                    commentElement.classList.add('comment-card');

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
                        </div>`;
                    commentsList.appendChild(commentElement);
                });
            } else {
                commentsList.innerHTML = '<p>No comments available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching comments:', error);
        });
}

</script>

<script>
    let audioToDeleteId = null; 

function openDeleteModal(audioId) {
    audioToDeleteId = audioId;
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show(); // Open the modal
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (audioToDeleteId) {
        deleteAudio(audioToDeleteId);
    }
});

// Function to delete the audio via AJAX
function deleteAudio(audioId) {
    fetch(`/delete-audio/${audioId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the audio card from the UI
            document.getElementById(`audio-card-${audioId}`).remove();
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            modal.hide();
        } else {
            alert('Failed to delete audio');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while deleting the audio');
    });
}

</script>


<script src="{{ asset('assets/js/audio.js') }}"></script>
@include('frontend.layout.footer')

