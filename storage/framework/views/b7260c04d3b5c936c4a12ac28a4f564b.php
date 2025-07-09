<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Clone</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-w76A24a7KoHvjG3ROz5oGzeyPpC1qjErqa2i1p5H5vD0Dlj1k5FMOe3iqwosSI3K" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/single_profile.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.css">

    <style>

    body {
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        color: #fff;
        font-family: "Irish Grover", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url('<?php echo e(asset('assets/img/ssdRectangle.png')); ?>');
    }

        .video-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        #normalVideos {
            display: none;
            /* Initially hidden */
            transition: all 0.3s ease-in-out;
            /* Smooth transition */
        }

       
        .flip-book {
            width: 100%;
            max-width: 1200px;
            height: 800px;
            margin: 0 auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
            position: relative;
        }

        .page {
            width: 100%;
            height: 100%;
            background: white;
        }

        .page-content {
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .page-text {
            flex-grow: 1;
            text-align: justify;
            color: #0f0f0f;
            overflow-y: auto;
        }

        .page-footer {
            font-size: 12px;
            text-align: right;
            color: black;
        }
    #remote { width: 80%; height: 400px; background: #000; margin: 20px auto; }
    </style>
</head>

<body>
    <div class="container">
        <!-- Banner Section -->
        <div class="banner">
            <img id="coverPreview" class="img-banner" src="<?php echo e($user->cover_image ? asset( $user->cover_image) : asset('assets/img/Profilsdsd.svg')); ?>" alt="">
            <input type="file" id="fileInput" style="display: none;" accept="image/*">

            <div class="banner-text">
                <div class="info-card">
                    

                    <h2>Rick Appleyard</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Name:</strong> <?php echo e($user->name ?? 'N/A'); ?>

                        </div>

                        <div class="col-md-6">
                            <strong>Workplace:</strong> <?php echo e($user->workplace ?? 'N/A'); ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>School:</strong> <?php echo e($user->school ?? 'N/A'); ?>

                        </div>
                        <div class="col-md-6">
                            <strong>Pensacola:</strong> <?php echo e($user->Pensacola ?? 'N/A'); ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Date of Birth:</strong>
                            <?php echo e($user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M, Y') : 'N/A'); ?>

                        </div>
                        <div class="col-md-6">
                            <strong>Loves:</strong> <?php echo e($user->loves ?? 'N/A'); ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Hometown:</strong> <?php echo e($user->home_town ?? 'N/A'); ?>

                        </div>
                        <div class="col-md-6">
                            <strong>Current City:</strong> <?php echo e($user->current_city ?? 'N/A'); ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Favorite Song:</strong> <?php echo e($user->favorite_song ?? 'N/A'); ?>

                        </div>
                        <div class="col-md-6">
                            <strong>Employer:</strong> <?php echo e($user->employer ?? 'N/A'); ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Job Title:</strong> <?php echo e($user->job_title ?? 'N/A'); ?>

                        </div>
                        <div class="col-md-6">
                            <strong>Currently In:</strong> <?php echo e($user->current_city ?? 'N/A'); ?>

                        </div>
                    </div>
                </div>

            </div>

            <?php if(Auth::id() !== $user->id): ?>
            <?php
            $friendship = \App\Models\Friendship::where(function($q) use ($user) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
            })->orWhere(function($q) use ($user) {
            $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
            })->first();
            ?>

            <div class="mybtn" id="friend-btn">
                <?php if(!$friendship): ?>
                <button onclick="toggleFriendRequest(<?php echo e($user->id); ?>, 'send')" class="addfrnd">Add Friend</button>
                <?php elseif($friendship->status === 'pending' && $friendship->sender_id === Auth::id()): ?>
                <button onclick="toggleFriendRequest(<?php echo e($user->id); ?>, 'cancel')" class="requestbtn">Friend Request Sent</button>
                <?php elseif($friendship->status === 'accepted'): ?>
                <button class="friendsbtn">Friends</button>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <!-- ✅ fixes the error -->


            <!-- Modal -->
            <div class="modal fade " id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="border-radius: 20px;">
                        <!--<div class="modal-header" style="background-color: #0000ff; color: #fff; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Video</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>-->
                        <form action="/upload" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="file" class="form-label">Choose File</label>
                                    <input class="form-control" type="file" id="file" name="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn" style="background: #0000ff; color: #fff;">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--  Gallery -->
        <div class="gallery">
            <a href="javascript:void(0)" class="audio-section" style="text-decoration: none;">
                <div class="section">
                    <h2 class="title">Audio</h2>
                </div>
            </a>
            <a href="javascript:void(0)" class="stills-section" style="text-decoration: none;">
                <div class="section">
                    <h2 class="title">Stills</h2>
                </div>
            </a>
            <a href="javascript:void(0)" class="text-section" style="text-decoration: none;">
                <div class="section">
                    <h2 class="title">Text</h2>
                </div>
            </a>
            <a href="javascript:void(0)" class="video-section" style="text-decoration: none;">
                <div class="section">
                    <h2 class="title">Video</h2>
                </div>
            </a>
            <a href="javascript:void(0)" class="live-section" style="text-decoration: none;" onclick="showLiveStream()">
                <div class="section">
                    <h2 class="title">Live</h2>
                </div>
            </a>
        </div>

          <!-- Audio Section -->
        <div id="normalAudio" class="audio-grid" >
            <?php if($audio->isEmpty()): ?>
            <div id="noAudioMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                No audio uploaded yet.
            </div>
            <?php else: ?>
            <?php $__currentLoopData = $audio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="audio-card">
                <div class="audio-thumbnail" style="position: relative;">
                    <img src="<?php echo e(asset($item->image)); ?>" class="audio-thumbnail-image" onclick="toggleAudio(this)" data-audio="<?php echo e(asset($item->audio)); ?>" style="cursor: pointer; width: 100%; border-radius: 6px;">
                </div>
                <div class="audio-info">
                    <h3 class="audio-title"><?php echo e($item->title); ?></h3>
                </div>
                <!-- Icons below the image -->
                <div class="card-icons">
                    <img id="likeIcon-<?php echo e($item->id); ?>" src="<?php echo e(asset('assets/img/white.png')); ?>" alt="Heart" onclick="toggleAudioLike(<?php echo e($item->id); ?>)" />
                    <img id="commentIcon" src="<?php echo e(asset('assets/img/comment.svg')); ?>" alt="Chat" class="comment-icon" onclick="openCommentPanel(<?php echo e($item->id); ?>)" />
                    <img src="<?php echo e(asset('assets/img/Share.svg')); ?>" alt="Share" onclick="shareAudioContent(<?php echo e($item->id); ?>)">

                    
 
                </div>
                <div id="likeCount-<?php echo e($item->id); ?>" style="font-size: 14px; margin-top: 4px; color:white; margin-left:-70px;">0</div>
                <div id="commentCount-<?php echo e($item->id); ?>" style="font-size: 14px; margin-top:-22px; color:white; margin-left:0px;">0</div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <audio id="audioPlayer" style="display: none;">
                <source id="audioSource" type="audio/mp3">
            </audio>
        </div>

        <!-- Videos Grid -->
        <div id="normalVideos" class="videos-grid" style="display: none;">
            <?php if($videos->isEmpty()): ?>
            <div id="noVideoMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                No video uploaded yet.       
            </div>
            <?php else: ?>
            <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="video-card">
                <div class="thumbnail-container" style="position: relative;">
                    <video width="100%" height="200" class="video-thumbnail" data-video-path="<?php echo e(asset($video->video_path)); ?>" controls preload="metadata" style="border-radius: 6px;">
                        <source src="<?php echo e(asset($video->video_path)); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <span class="duration">0:00</span>
                </div>
                <div class="video-info">
                    <h3 class="video-title"><?php echo e($video->title); ?></h3>
                    <div class="video-meta">
                        <span class="time"><?php echo e(\Carbon\Carbon::parse($video->created_at)->diffForHumans()); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <!-- Video display section (Initially hidden) -->
        <div id="selectedVideoContainer" style="display: none;">
            <video id="selectedVideo" width="100%" height="400" controls style="border-radius: 6px;">
                <source id="selectedVideoSource" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

       <!-- Stills Block -->
    <div id="normalStills" class="container-fluid" style="display:none; height: 80vh; overflow-y: auto;">
            <?php if($stills->isEmpty()): ?>
            <div id="noTextMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                You haven't uploaded Still Frame yet.
            </div>
            <?php else: ?>
            <div class="container py-5">
                <div class="flip-book" id="stillsBookExample">
                    <?php $__currentLoopData = $stills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="page">
                        <div class="page-content">
                            <!-- Image -->
                            <img id="still-img-<?php echo e($images->id); ?>" src="<?php echo e(asset($images->image_path)); ?>" alt="Still Image" class="img-fluid">
                            <!-- Description -->
                            <div class="page-text mt-3">
                                <?php echo $images->description; ?>

                            </div>

                            <div class="page-footer"><?php echo e($loop->iteration); ?></div>
                            <div id="pin-badge-<?php echo e($images->id); ?>" style="position: absolute; top: 3px; left: -465px; z-index: 2;">
                                <?php if($images->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count()): ?>
                                <img src="<?php echo e(asset('assets/img/pinned.svg')); ?>" alt="Pinned" style="width: 25px; height: 25px; margin-left:475px; top:10px;" />
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Social Icons Grouped Below Image -->
                        <div class="card-icons d-flex align-items-center gap-4">
                            <!-- Like Icon -->
                            <img id="likeIcon-<?php echo e($images->id); ?>" src="<?php echo e($images->likes->isEmpty() ? asset('assets/img/white.png') : asset('assets/img/likee.svg')); ?>" alt="Heart" onclick="likeStill(<?php echo e($images->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img id="commentIcon" src="<?php echo e(asset('assets/img/comment.svg')); ?>" alt="Chat" class="comment-icon" onclick="openStillCommentPanel(<?php echo e($images->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img src="<?php echo e(asset('assets/img/Share.svg')); ?>" alt="Share" onclick="shareStillContent(<?php echo e($images->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                            

                            <span id="likeCount-<?php echo e($images->id); ?>" style="font-size: 16px; color:white; margin-top:50px; margin-left:-135px;">
                                <?php echo e($images->getLikeCount()); ?>

                            </span>
                            <span id="commentCount-<?php echo e($images->id); ?>" style="font-size: 16px; color:white; margin-top:50px; margin-left:16px;">
                                <?php echo e($images->comments->count()); ?>

                            </span>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
    </div>

        <!-- Text Block -->
    <div id="normalText" class="container-fluid" style="display:none; height: 80vh; overflow-y: auto;">
            <?php if($text->isEmpty()): ?>
            <div id="noTextMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                You haven't uploaded Text Frame yet.
            </div>
            <?php else: ?>
            <div class="container py-5">
                <div class="flip-book" id="textBookExample">
                    <?php $__currentLoopData = $text; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $frame): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="page" id="text-wrapper-<?php echo e($frame->id); ?>">
                        <div class="page-content">
                            <!-- Description -->
                            <div class="page-text">
                                <?php echo $frame->text_in_image; ?>

                            </div>

                        <div class="page-footer"><?php echo e($loop->iteration); ?></div>
                        <div id="pin-badge-<?php echo e($frame->id); ?>" style="position: absolute; top: -125px; left: -407px; z-index: 2;">
                            <?php if($frame->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count()): ?>
                            <img src="<?php echo e(asset('assets/img/pinned.svg')); ?>" alt="Pinned" style="width: 25px; height: 25px; margin-left:475px; top:10px;" />
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Social Icons Grouped Below Image -->
                    <div class="card-icons d-flex align-items-center gap-4">
                        <!-- Like Icon -->
                        <img id="likeIcon-<?php echo e($frame->id); ?>" src="<?php echo e($frame->likes->isEmpty() ? asset('assets/img/white.png') : asset('assets/img/likee.svg')); ?>" alt="Heart" onclick="likeText(<?php echo e($frame->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                        <img id="commentIcon" src="<?php echo e(asset('assets/img/comment.svg')); ?>" alt="Chat" class="comment-icon" onclick="openTextCommentPanel(<?php echo e($frame->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                        <img src="<?php echo e(asset('assets/img/Share.svg')); ?>" alt="Share" onclick="shareContent(<?php echo e($frame->id); ?>)" style="width: 24px; height: 24px; cursor: pointer;" />
                        

                        <span id="likeCount-<?php echo e($frame->id); ?>" style="font-size: 16px; color:white; margin-top:50px; margin-left:-135px;">
                            <?php echo e($frame->getLikeCount()); ?>

                        </span>
                        <span id="commentCount-<?php echo e($frame->id); ?>" style="font-size: 16px; color:white; margin-top:50px; margin-left:16px;">
                            <?php echo e($frame->comments->count()); ?>

                        </span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

 <!-- Live Stream Block -->
<div id="liveStreamSection" style="display: none;">
        <div class="container mt-4 text-center">
        <h3 style="color:white;">🔴 <?php echo e($user->name); ?> is Live</h3>
        <div id="remote"></div>
        <button id="joinStreamBtn" class="start-button">Join Live Stream</button>
    </div>
</div>


       <!-- Audio Comment Panel Modal -->
        <div class="comment-panel" id="commentPanel">
            <header>
                <h3>Comments</h3>
                <button onclick="closeCommentPanel()">Close</button>
            </header>
            <div class="comment-section">
                <textarea id="commentInput" class="comment-input" placeholder="Write a comment..." rows="4"></textarea>
                <button class="send-button" onclick="submitAudioComment()">Send</button>
            </div>
            <hr>
            <div id="commentsList" class="comments-list"></div>
        </div>

        <!--Audio Share Modal -->
        <div class="Audioshare-modal" id="AudioshareModal">
            <div class="Audioshare-modal-content">
                <div class="Audioshare-modal-header">
                    <span class="close" onclick="closeAudioShareModal()">&times;</span>
                </div>
                <input type="text" id="shareAudioLink" class="input-field" value="" readonly>
                <button class="copy-btn" onclick="copyAudioLink()">Copy Link</button>

                <div class="Audioshare-options">
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

        <!-- stills Comment Panel -->
        <div class="still-comment-panel" id="stillcommentPanel">
            <header>
                <h3>Comments</h3>
                <button onclick="closeStillCommentPanel()">Close</button>
            </header>
            <div class="comment-section">
                <textarea id="stillcommentInput" class="stillcomment-input" placeholder="Write a comment..." rows="4"></textarea>
                <button class="send-button" onclick="submitStillComment()">Send</button>
            </div>
            <hr>
            <div id="stillcommentsList" class="stillcomments-list"></div>
        </div>

        <!-- Still Share Modal -->
        <div class="Stillshare-modal" id="StillshareModal">
            <div class="Stillshare-modal-content">
                <div class="Stillshare-modal-header">
                    <span class="close" onclick="closeStillShareModal()">&times;</span>
                </div>
                <input type="text" id="StillshareLink" class="input-field" value="" readonly>
                <button class="copy-btn" onclick="copyStillLink()">Copy Link</button>

                <div class="Stillshare-options">
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
        

        <!--TExt Comment Panel -->
        <div class="text-comment-panel" id="textcommentPanel">
            <header>
                <h3>Comments</h3>
                <button onclick="closeTextCommentPanel()">Close</button>
            </header>
            <div class="comment-section">
                <textarea id="textcommentInput" class="text-comment-input" placeholder="Write a comment..." rows="4"></textarea>
                <button class="send-button" onclick="submitComment()">Send</button>
            </div>
            <hr>
            <div id="textcommentsList" class="textcomments-list"></div>
        </div>

        <!-- Text Share Modal -->
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
        

    <script src="<?php echo e(asset('assets/js/preview_video.js')); ?>"></script>

    
    <script>
        function toggleFriendRequest(userId, action) {
            const url = action === 'send' ? `/friend/send/${userId}` : `/friend/cancel/${userId}`;
            const method = 'POST';

            fetch(url, {
                    method
                    , headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        , 'Content-Type': 'application/json'
                    , }
                })
                .then(res => res.json())
                .then(data => {
                    const btnDiv = document.getElementById('friend-btn');

                    if (action === 'send' && data.message === 'Friend request sent') {
                        btnDiv.innerHTML = `<button onclick="toggleFriendRequest(${userId}, 'cancel')" class="requestbtn">Friend Request Sent</button>`;
                    } else if (action === 'cancel' && data.message === 'Friend request canceled') {
                        btnDiv.innerHTML = `<button onclick="toggleFriendRequest(${userId}, 'send')" class="addfrnd">Add Friend</button>`;
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Something went wrong');
                });
        }

    </script>

    
    <script>
        document.querySelector('#uploadModal form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch("<?php echo e(route('upload.file')); ?>", {
                    method: 'POST'
                    , headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                    , body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Video Uploaded Successfully!');
                        form.reset();

                        const modal = bootstrap.Modal.getInstance(document.getElementById('uploadModal'));
                        modal.hide();

                        // Reload page to show newly uploaded video
                        setTimeout(() => {
                            location.reload();
                        }, 500);
                    } else {
                        alert('Upload failed!');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                });
        });

    </script>

    
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            const formData = new FormData();
            formData.append('cover_image', file);

            fetch("<?php echo e(route('upload.cover.image')); ?>", {
                    method: "POST"
                    , headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                    }
                    , body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('coverPreview').src = data.image_url;
                    } else {
                        alert("Failed to upload image.");
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                });
        });

    </script>


    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const savedColor = localStorage.getItem('savedTextColor');
            const savedFont = localStorage.getItem('savedTextFont');
            const savedSize = localStorage.getItem('savedTextSize');

            if (savedColor) {
                document.documentElement.style.setProperty('--text-color', savedColor);
            }

            if (savedFont) {
                document.documentElement.style.setProperty('--font-family', savedFont);
            }

            if (savedSize) {
                document.documentElement.style.setProperty('--font-size', savedSize);
            }
        });

    </script>

    <!--audio like & Fetch Audio like -->
    <script>
        const likeIcon = {
            liked: "<?php echo e(asset('assets/img/likee.svg')); ?>"
            , unliked: "<?php echo e(asset('assets/img/white.png')); ?>"
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
                    loadAudioLikes(audioId);
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
            const allAudioIds = <?php echo json_encode($audio -> pluck('id'), 15, 512) ?>;
            allAudioIds.forEach(id => {
                loadAudioLikes(id);
                loadAudioCommentsCount(id);
            });
        };

    </script>
    <!--end audio like & Fetch Audio like -->

    <!--still like & Fetch still like -->
    <script>
        function likeStill(stillId) {
            fetch(`/like-still/${stillId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.message === "Like added") {
                        // Change to filled red heart using correct asset URL
                        document.getElementById(`likeIcon-${stillId}`).src = "<?php echo e(asset('assets/img/likee.svg')); ?>";
                    } else {
                        // Change back to default white heart using correct asset URL
                        document.getElementById(`likeIcon-${stillId}`).src = "<?php echo e(asset('assets/img/white.png')); ?>";
                    }

                    // Update the like count in real-time
                    document.getElementById(`likeCount-${stillId}`).innerText = data.like_count;
                });
        }
    </script>
    <!--end still like & Fetch still like -->

    <!--like text  -->
    <script>
        function likeText(textId)
        {
            fetch(`/like-text/${textId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
            .then((response) => response.json())
            .then((data) => {
            if (data.message === "Like added") {
                // Change to filled red heart using asset helper for correct URL
                document.getElementById(`likeIcon-${textId}`).src =
                    "<?php echo e(asset('assets/img/likee.svg')); ?>";
            } else {
                // Change back to default white heart using asset helper for correct URL
                document.getElementById(`likeIcon-${textId}`).src =
                    "<?php echo e(asset('assets/img/white.png')); ?>";
            }

            // Update the like count in real-time
            document.getElementById(`likeCount-${textId}`).innerText =
                data.like_count;
            });
        }

    </script>

<script src="https://cdn.agora.io/sdk/release/AgoraRTC_N.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
const appId = "e5388ed01e1d4689bf2880469b3c4703";
const channel = "<?php echo e($channel); ?>";  // Using the passed channel from controller

let client = AgoraRTC.createClient({ mode: "live", codec: "vp8" });

(async () => {
  const res = await $.get('/api/agora/token', { channel, role: 'audience' });

  await client.join(appId, channel, res.token, res.uid);
  await client.setClientRole("audience");

  // Subscribe to remote users
  client.on("user-published", async (user, mediaType) => {
    await client.subscribe(user, mediaType);

    if (mediaType === "video") {
      const remoteDiv = document.createElement("div");
      remoteDiv.id = "remote-" + user.uid;
      remoteDiv.style.width = "100%";
      remoteDiv.style.height = "400px";
      document.getElementById("remote").appendChild(remoteDiv);
      user.videoTrack.play(remoteDiv);
    }

    if (mediaType === "audio") {
      user.audioTrack.play();
    }
  });

  client.on("user-unpublished", (user) => {
    const remoteEl = document.getElementById("remote-" + user.uid);
    if (remoteEl) remoteEl.remove();
  });
})();

document.getElementById("joinStreamBtn").addEventListener("click", async () => {
  // Notify the host that the viewer joined
  const viewerName = "<?php echo e($user->name); ?>";  // Pass viewer's name to JS
  await $.post('/api/notify-host-joined', { viewerName, channel });

  // Optionally, show a message to the viewer
  alert("You have joined the live stream!");

  // Disable the button after click
  document.getElementById("joinStreamBtn").disabled = true;
});
</script>


<script>
    function showLiveStream() {
        document.getElementById("normalAudio")?.style.setProperty("display", "none");
        document.getElementById("normalVideos")?.style.setProperty("display", "none");
        document.getElementById("normalStills")?.style.setProperty("display", "none");
        document.getElementById("normalText")?.style.setProperty("display", "none");
        document.getElementById("liveStreamSection").style.display = "block";
    }
</script>
     <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php /**PATH E:\laragon\www\animation_social\animation_social_project\resources\views/frontend/user_profile.blade.php ENDPATH**/ ?>