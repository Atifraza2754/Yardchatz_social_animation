@include('frontend.layout.header')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/upload_text.css')}}">


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
        background-image: url(assets/img/ssdRectangle.png);
        height: 100vh;
        /* Full viewport height */
    }

    .profiles-container {
        overflow-x: hidden;
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
            @foreach($text as $frame)
                @if(canViewProfile(auth()->user(), $frame->user))
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

                        <div class="page-footer">{{ $loop->iteration }}</div>
                        <div id="pin-badge-{{ $frame->id }}" style="position: absolute; top:10px; left: -467px; z-index: 2;">
                            @if($frame->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count())
                                <img src="{{ asset('assets/img/pinned.svg') }}" alt="Pinned" style="width: 25px; height: 25px; margin-left:475px; top:10px;" />
                            @endif
                        </div>
                    </div>

                     <!-- Social Icons Grouped Below Image -->
                        <div class="card-icons d-flex align-items-center gap-4">
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
                @endif
            @endforeach
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

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Text</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this text?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
            </div>
        </div>
    </div>
</div>

@include('frontend.layout.navbar')

<!-- Trigger Button -->
<a href="#" id="myBtn" data-bs-toggle="modal" data-bs-target="#uploadModal">
    <img src="assets/img/Write.svg" alt="">
</a>


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




<!-- Text upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Changed from modal-lg to modal-xl -->
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Customize Text in Editor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('text.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editorContent" class="form-label">Description</label>
                    <textarea class="form-control" id="editorContent" name="editorContent"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="uploadButton">Upload</button>
            </div>
        </form>

        </div>
    </div>
</div>




<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

{{-- upload text --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('editorContent', {
            versionCheck: false
        });

        document.getElementById('uploadButton').addEventListener('click', function () {
            let formData = new FormData();
            let description = CKEDITOR.instances.editorContent.getData();

            formData.append('_token', '{{ csrf_token() }}');
            formData.append('editorContent', description);

            fetch("{{ route('text.upload') }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                document.getElementById('uploadForm').reset();
                CKEDITOR.instances.editorContent.setData('');
                document.getElementById('uploadModal').classList.remove('show'); // hide modal
                document.querySelector('.modal-backdrop')?.remove(); // remove backdrop
                location.reload();
            })
            .catch(err => alert('Upload failed!'));
        });
    });
</script>


<script>
    let deleteTextId = null;

    function openDeleteModal(textId) {
        deleteTextId = textId;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (deleteTextId !== null) {
            fetch(`/delete-text/${deleteTextId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close the modal
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                    deleteModal.hide();
                    
                    // Remove the deleted text from the DOM
                    document.getElementById(`text-wrapper-${deleteTextId}`).remove();
                    
                    // Reload the page after a short delay to reflect the changes
                    setTimeout(() => {
                        location.reload(); // Reload the page
                    }, 500); // Adjust the timeout duration as needed
                } else {
                    alert('Failed to delete text.');
                }
            })
            .catch(error => {
                console.error('Error deleting text:', error);
                alert('An error occurred while deleting.');
            });
        }
    });

</script>

<!-- Include JavaScript file -->
<script src="{{ asset('assets/js/text.js') }}"></script>

{{-- end upload text --}}
@include('frontend.layout.footer')

