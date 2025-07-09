<?php echo $__env->make('frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/stills.css')); ?>">


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
        overflow-x: hidden;
        /* Stop horizontal scroll globally */

        /* Full viewport height */
    }

    .flip-book {
    margin: 0 auto;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
}

.page-content {
    padding: 20px;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    height: 100%;
}

.page-header {
    font-size: 20px;
    text-align: center;
    margin-bottom: 10px;
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


</style>

<div class="gallery">
    <a href="<?php echo e(route('signal_audio')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Audio</h2>
        </div>
    </a>


    <a href="<?php echo e(route('stills')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Stills</h2>
        </div>
    </a>

    <a href="<?php echo e(route('text_upload')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Text</h2>
        </div>
    </a>

    <a href="<?php echo e(route('live_page')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Video</h2>
        </div>
    </a>


    <a href="<?php echo e(route('live_screen')); ?>" style="text-decoration: none;">
        <div class="section">
            <h2 class="title">Live</h2>
        </div>
    </a>
</div>


<div class="container-fluid" style="height: 80vh; overflow-y: auto;">
    <div class="container py-5">
        <div class="flip-book profiles-container" id="demoBookExample"> 
            <?php $__currentLoopData = $stills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(canViewProfile(auth()->user(), $images->user)): ?>
              <div id="still-wrapper-<?php echo e($images->id); ?>">
                <div class="page">
                    <div class="page-content">
                        <!-- Image -->
                        <img id="still-img-<?php echo e($images->id); ?>" src="<?php echo e(asset($images->image_path)); ?>" alt="Still Image" class="img-fluid" style="width:600px; height:300px;">
                        <!-- Description -->
                        <div class="page-text mt-3">
                            <?php echo $images->description; ?>

                        </div>

                        <div class="page-footer"><?php echo e($loop->iteration); ?></div>
                        <div id="pin-badge-<?php echo e($images->id); ?>" style="position: absolute; top: 19px; left: -385px; z-index: 2;">
                            <?php if($images->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count()): ?>
                                <img src="<?php echo e(asset('assets/img/pinned.svg')); ?>" alt="Pinned" style="width: 25px; height: 25px; margin-left:403px; top:17px;" />
                            <?php endif; ?>
                        </div>
                        <div style="position: absolute; top: 8px; right:18px;">
                            <a href="<?php echo e(url('user/profile/' . $images->user->id)); ?>">
                                <img src="<?php echo e(asset($images->user->profile_picture)); ?>" alt="<?php echo e($images->user->name); ?>" style="width: 50px; height: 40px; border-radius: 50%; border: 2px solid white;">
                            </a>
                        </div>
                    </div>

                     <!-- Social Icons Grouped Below Image -->
                        <div class="card-icons d-flex align-items-center gap-4 mt-3">
                            <!-- Like Icon -->
                            <img id="likeIcon-<?php echo e($images->id); ?>" src="<?php echo e($images->likes->isEmpty() ? asset('assets/img/white.png') : asset('assets/img/likee.svg')); ?>" alt="Heart" onclick="likeStill(<?php echo e($images->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img id="commentIcon" src="<?php echo e(asset('assets/img/comment.svg')); ?>" alt="Chat" class="comment-icon" onclick="openCommentPanel(<?php echo e($images->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img src="<?php echo e(asset('assets/img/Share.svg')); ?>" alt="Share" onclick="shareContent(<?php echo e($images->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                            <?php
                                $isPinned = $images->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count() > 0;
                            ?>
                            <img src="<?php echo e(asset($isPinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg')); ?>" alt="pin" onclick="pinStill(<?php echo e($images->id); ?>, this)" style="filter: brightness(0) invert(1);  width: 24px; height: 24px; cursor: pointer;" />
                            

                            <!-- Delete Icon (Only if owner) -->
                           

                            <span id="likeCount-<?php echo e($images->id); ?>" style="font-size: 16px; color:white; margin-top:50px; margin-left:-185px;">
                                <?php echo e($images->getLikeCount()); ?>

                            </span>
                            <span id="commentCount-<?php echo e($images->id); ?>" style="font-size: 16px; color:white; margin-top:50px; margin-left:16px;">
                                <?php echo e($images->comments->count()); ?>

                            </span>
                    </div>
                </div>
              </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>



<!-- Trigger Button -->
<a href="#" id="myBtn" data-bs-toggle="modal" data-bs-target="#uploadModal">
    <img src="assets/img/sccmeras.svg" alt="">
</a>

<?php echo $__env->make('frontend.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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


<!-- still image upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Changed from modal-lg to modal-xl -->
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Customize Your Stills</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadForm" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="StillImage" class="form-label">Upload Your Image</label>
                    <input type="file" class="form-control" id="StillImage" name="StillImage">
                </div>
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

<!--delete  still Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Still</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this still?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('editorContent', {
            versionCheck: false
        });

        document.getElementById('uploadButton').addEventListener('click', function () {
            let formData = new FormData();
            let fileInput = document.getElementById('StillImage');
            let description = CKEDITOR.instances.editorContent.getData();

            formData.append('_token', '<?php echo e(csrf_token()); ?>');
            formData.append('StillImage', fileInput.files[0]);
            formData.append('editorContent', description);

            fetch("<?php echo e(route('image.upload')); ?>", {
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
    // Get the button
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
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


<script>
  let deleteStillId = null;

function openDeleteModal(stillId) {
    deleteStillId = stillId;
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteStillId !== null) {
        fetch(`/delete-still/${deleteStillId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the still from the DOM
                document.getElementById(`still-wrapper-${deleteStillId}`).remove();
                
                // Close the modal after deletion
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                deleteModal.hide();

                
                // Reload the page after a short delay to reflect the changes
                setTimeout(() => {
                    location.reload(); // Reload the page to show updated content
                }, 500);
            } else {
                alert('Failed to delete still.');
            }
        })
        .catch(error => {
            console.error('Error deleting still:', error);
            alert('An error occurred while deleting.');
        });
    }
});

</script>
<script src="<?php echo e(asset('assets/js/stills.js')); ?>"></script>

<?php echo $__env->make('frontend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH E:\laragon\www\animation_social\animation_social_project\resources\views/frontend/stills.blade.php ENDPATH**/ ?>