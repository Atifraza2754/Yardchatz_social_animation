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
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat&family=Open+Sans&family=Poppins&family=Quicksand&family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/preview_video.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/page-flip/dist/css/page-flip.css">

    <style>
        body {
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            background-image: url('{{ asset('assets/img/ssdRectangle.png') }}');
            color: #fff;
            font-family: "Irish Grover", serif;
            font-weight: 400;
            font-style: normal;
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
        

    </style>
</head>

<body>
    <div class="container">
        <!-- Banner Section -->
        <div class="banner">
            <img id="coverPreview" class="img-banner" src="{{ auth()->user()->cover_image ? asset(auth()->user()->cover_image) : asset('assets/img/Profilsdsd.svg') }}" alt="">

            <!-- Camera Icon and Input -->
            <label for="fileInput" class="camera-icon">
                <i class="fas fa-camera"></i>
            </label>
            <input type="file" id="fileInput" style="display: none;" accept="image/*">
            @auth
            <div class="favorite-icon">
                <img id="favoriteIcon" src="assets/img/save2.svg" width="45px" height="55px" alt="Favorite" onclick="toggleFavorite()">
            </div>
            @endauth

            <div class="banner-text">
                <div class="info-card">
                    <a href="{{ route('live_page') }}" class="btn btn-primary mb-3" id="backtbn" style="margin-left:150px;">Back</a>

                    <h2>Rick Appleyard</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Name:</strong> {{ $user->name ?? 'N/A' }}
                        </div>

                        <div class="col-md-6">
                            <strong>Workplace:</strong> {{ $user->workplace ?? 'N/A' }}
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <strong>School:</strong> {{ $user->school ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Pensacola:</strong> {{ $user->Pensacola ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Date of Birth:</strong>
                            {{ $user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M, Y') : 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Loves:</strong> {{ $user->loves ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Hometown:</strong> {{ $user->home_town ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Current City:</strong> {{ $user->current_city ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Favorite Song:</strong> {{ $user->favorite_song ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Employer:</strong> {{ $user->employer ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Job Title:</strong> {{ $user->job_title ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Currently In:</strong> {{ $user->current_city ?? 'N/A' }}
                        </div>
                    </div>

                    <!-- Upload Video Button -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal" style="background: #0000ff; color: #fff; padding: 7px 15px; border-radius: 22px; text-decoration: none; margin-left:100px;">Upload Video</a>
                </div>

            </div>

            <div class="text-controls">
                <!-- Trigger Buttons -->
                <button onclick="toggleDropdown('color')">Fonts Color</button>
                <button onclick="toggleDropdown('font')">Fonts Style</button>
                <button onclick="toggleDropdown('size')">Font Size</button>

                <!-- Color Dropdown -->
                <select id="colorDropdown" style="display: none;" onchange="applyTextColor(this.value)">
                    <option value="">Select Color</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="black">Black</option>
                    <option value="yellow">Yellow</option>
                    <option value="orange">Orange</option>
                    <option value="purple">Purple</option>
                    <option value="pink">Pink</option>
                    <option value="brown">Brown</option>
                    <option value="gray">Gray</option>
                    <option value="skyblue">Sky Blue</option>
                    <option value="cyan">Cyan</option>
                    <option value="limegreen">Lime Green</option>
                    <option value="navy">Navy Blue</option>
                    <option value="teal">Teal</option>
                </select>

                <!-- Font Dropdown -->
                <select id="fontDropdown" style="display: none;" onchange="applyTextFont(this.value)">
                    <option value="">Select Font</option>
                    <option value="Arial">Arial</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Poppins">Poppins</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Trebuchet MS">Trebuchet MS</option>
                    <option value="Lucida Console">Lucida Console</option>
                    <option value="Segoe UI">Segoe UI</option>
                    <option value="Roboto">Roboto</option>
                    <option value="Lato">Lato</option>
                    <option value="Open Sans">Open Sans</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Quicksand">Quicksand</option>
                </select>

                <!-- Size Dropdown -->
                <select id="sizeDropdown" style="display: none;" onchange="applyTextSize(this.value)">
                    <option value="">Select Size</option>
                    <option value="12px">12px</option>
                    <option value="16px">16px</option>
                    <option value="20px">20px</option>
                    <option value="24px">24px</option>
                    <option value="28px">28px</option>
                    <option value="32px">32px</option>
                    <option value="36px">36px</option>
                    <option value="40px">40px</option>
                    <option value="44px">44px</option>
                    <option value="48px">48px</option>
                    <option value="52px">52px</option>
                    <option value="56px">56px</option>
                    <option value="60px">60px</option>
                    <option value="64px">64px</option>
                    <option value="68px">68px</option>
                    <option value="72px">72px</option>
                    <option value="76px">76px</option>
                    <option value="80px">80px</option>
                    <option value="84px">84px</option>
                    <option value="88px">88px</option>
                    <option value="92px">92px</option>
                    <option value="96px">96px</option>
                    <option value="100px">100px</option>
                </select>
            </div>


            @if (Auth::check())
            <div class="friend-request-wrapper">
                <button class="friend-request-btn" onclick="toggleFriendDropdown()">Friend Requests List</button>

                <div id="friendRequestDropdown" class="friend-request-dropdown">
                    @forelse ($friendRequests as $request)
                    <div class="request-item">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ asset($request->sender->profile_picture) ?? '' }}">
                            <span>{{ $request->sender->name ?? 'Unknown' }}</span>
                        </div>
                        <div class="request-actions">
                            <button class="confirm-btn" onclick="confirmRequest({{ $request->id }})">Confirm</button>
                            <button class="reject-btn" onclick="rejectRequest({{ $request->id }})">Reject</button>
                        </div>
                    </div>
                    @empty
                    <div class="request-item text-center">No Requests</div>
                    @endforelse
                </div>
            </div>
            @endif

            <!-- upload video Modal -->
            <div class="modal fade " id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" style="border-radius: 20px;">
                        <div class="modal-header" style="background-color: #0000ff; color: #fff; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Video</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
            <a href="" style="text-decoration: none;">
                <div class="section">
                    <h2 class="title">Live</h2>
                </div>
            </a>
        </div>

        <!-- Audio Section -->
        <div id="normalAudio" class="audio-grid" >
            @if($audio->isEmpty())
            <div id="noAudioMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                You haven't uploaded audio yet.
            </div>
            @else
            @foreach ($audio as $item)
            <div class="audio-card">
                <div class="audio-thumbnail" style="position: relative;">
                    <img src="{{ asset($item->image) }}" class="audio-thumbnail-image" onclick="toggleAudio(this)" data-audio="{{ asset($item->audio) }}" style="cursor: pointer; width: 100%; border-radius: 6px;">
                </div>
                <div class="audio-info">
                    <h3 class="audio-title">{{ $item->title }}</h3>
                </div>
                <!-- Icons below the image -->
                <div class="card-icons">
                    <img id="likeIcon-{{ $item->id }}" src="{{ asset('assets/img/white.png') }}" alt="Heart" onclick="toggleAudioLike({{ $item->id }})" />
                    <img id="commentIcon" src="{{ asset('assets/img/comment.svg') }}" alt="Chat" class="comment-icon" onclick="openCommentPanel({{ $item->id }})" />
                    <img src="{{ asset('assets/img/Share.svg') }}" alt="Share" onclick="shareAudioContent({{ $item->id }})">

                    {{-- @php
                    $isPinned = $item->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count() > 0;
                @endphp

                <img src="{{ asset($isPinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg') }}" alt="pin"
                    onclick="pinAudio({{ $item->id }}, this)"
                    style="width:20px; height: 20px; filter: brightness(0) invert(1); " />
                    --}}
                    @if(auth()->id() == $item->user_id)
                    <!-- Check if logged-in user is the owner -->
                    <div>
                        <img src="{{ asset('assets/img/delete.svg') }}" alt="Delete" style="width: 25px; height: 25px;" onclick="openAudioDeleteModal({{ $item->id }})">
                    </div>
                    @endif

                </div>
                <div id="likeCount-{{ $item->id }}" style="font-size: 14px; margin-top: 4px; color:white; margin-left:-109px;">0</div>
                <div id="commentCount-{{ $item->id }}" style="font-size: 14px; margin-top:-22px; color:white; margin-left:-37px;">0</div>
            </div>
            @endforeach
            @endif

            <audio id="audioPlayer" style="display: none;">
                <source id="audioSource" type="audio/mp3">
            </audio>
        </div>

        <!-- Videos Grid -->
        <div id="normalVideos" class="videos-grid" style="display: none;">
            @if($videos->isEmpty())
            <div id="noVideoMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                You haven't uploaded video yet.
            </div>
            @else
            @foreach ($videos as $video)
            <div class="video-card">
                <div class="thumbnail-container" style="position: relative;">
                    <video width="100%" height="200" class="video-thumbnail" data-video-path="{{ asset($video->video_path) }}" controls preload="metadata" style="border-radius: 6px;">
                        <source src="{{ asset($video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <span class="duration">0:00</span>
                </div>
                <div class="video-info">
                    <h3 class="video-title">{{ $video->title }}</h3>
                    <div class="video-meta">
                        <span class="views">0 views</span>
                        <span class="dot">•</span>
                        <span class="time">{{ \Carbon\Carbon::parse($video->created_at)->diffForHumans() }}</span>
                    </div>
                </div>
                <!-- Delete Icon at top-right -->
                @if(auth()->id() == $video->user_id)
                <div style="position: absolute; top: 10px; right: 10px;">
                    <img src="{{ asset('assets/img/delete.svg') }}" alt="Delete" style="width: 25px; height: 25px;" onclick="openDeleteModal({{ $video->id }})">
                </div>
                @endif
            </div>
            @endforeach
            @endif
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
            @if($stills->isEmpty())
            <div id="noTextMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                You haven't uploaded Still Frame yet.
            </div>
            @else
            <div class="container py-5">
                <div class="flip-book" id="stillsBookExample">
                    @foreach($stills as $images)
                    <div class="page">
                        <div class="page-content">
                            <!-- Image -->
                            <img id="still-img-{{ $images->id }}" src="{{ asset($images->image_path) }}" alt="Still Image" class="img-fluid" style="width:600px; height:300px;">
                            <!-- Description -->
                            <div class="page-text mt-3">
                                {!! $images->description !!}
                            </div>

                            <div class="page-footer">{{ $loop->iteration }}</div>
                            <div id="pin-badge-{{ $images->id }}" style="position: absolute; top: 3px; left: -465px; z-index: 2;">
                                @if($images->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count())
                                <img src="{{ asset('assets/img/pinned.svg') }}" alt="Pinned" style="width: 25px; height: 25px; margin-left:475px; top:10px;" />
                                @endif
                            </div>
                        </div>

                        <!-- Social Icons Grouped Below Image -->
                        <div class="card-icons d-flex align-items-center gap-4">
                            <!-- Like Icon -->
                            <img id="likeIcon-{{ $images->id }}" src="{{ $images->likes->isEmpty() ? asset('assets/img/white.png') : asset('assets/img/likee.svg') }}" alt="Heart" onclick="likeStill({{ $images->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img id="commentIcon" src="{{ asset('assets/img/comment.svg') }}" alt="Chat" class="comment-icon" onclick="openStillCommentPanel({{ $images->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                            <img src="{{ asset('assets/img/Share.svg') }}" alt="Share" onclick="shareStillContent({{ $images->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                            {{--
                            @php
                            $isPinned = $images->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count() > 0;
                            @endphp
                            <img src="{{ asset($isPinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg') }}" alt="pin" onclick="pinStill({{ $images->id }}, this)" style="filter: brightness(0) invert(1); width: 24px; height: 24px; cursor: pointer;" />
                            --}}

                            <!-- Delete Icon (Only if owner) -->
                            @if(auth()->id() == $images->user_id)
                            <img src="{{ asset('assets/img/delete.svg') }}" alt="Delete" style="width: 24px; height: 24px; cursor: pointer;" onclick="openStillDeleteModal({{ $images->id }})" />
                            @endif

                            <span id="likeCount-{{ $images->id }}" style="font-size: 16px; color:white; margin-top:50px; margin-left:-185px;">
                                {{ $images->getLikeCount() }}
                            </span>
                            <span id="commentCount-{{ $images->id }}" style="font-size: 16px; color:white; margin-top:50px; margin-left:16px;">
                                {{ $images->comments->count() }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Text Block -->
        <div id="normalText" class="container-fluid" style="display:none; height: 80vh; overflow-y: auto;">
            @if($text->isEmpty())
            <div id="noTextMessage" style="margin-left:600px; color: red; font-size: 24px; width:350px;">
                You haven't uploaded Text Frame yet.
            </div>
            @else
            <div class="container py-5">
                <div class="flip-book" id="textBookExample">
                    @foreach($text as $frame)
                    <div class="page page-dynamic-height" id="text-wrapper-{{ $frame->id }}">
                        <div class="page-content">
                            <!-- Description -->
                            <div class="page-text">
                                {!! $frame->text_in_image !!}
                            </div>

                            <!-- Profile picture of the user who uploaded the text/image -->
                            {{-- <div style="position: absolute; top: 10px; right: -136px;">
                            @if($frame->user && $frame->user->profile_picture)
                            <a href="{{ url('user/profile/' . $frame->user->id) }}">
                            <img src="{{ asset($frame->user->profile_picture) }}" alt="{{ $frame->user->name }}" style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid white;">
                            </a>
                            @else
                            <img src="{{ asset('assets/img/default-avatar.png') }}" alt="Default Avatar" style="width: 30px; height: 30px; border-radius: 50%; border: 2px solid white;">
                            @endif
                        </div> --}}

                        <div class="page-footer">{{ $loop->iteration }}</div>
                        <div id="pin-badge-{{ $frame->id }}" style="position: absolute; top: -125px; left: -407px; z-index: 2;">
                            @if($frame->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count())
                            <img src="{{ asset('assets/img/pinned.svg') }}" alt="Pinned" style="width: 25px; height: 25px; margin-left:475px; top:10px;" />
                            @endif
                        </div>
                    </div>

                    <!-- Social Icons Grouped Below Image -->
                    <div class="card-icons d-flex align-items-center gap-4">
                        <!-- Like Icon -->
                        <img id="likeIcon-{{ $frame->id }}" src="{{ $frame->likes->isEmpty() ? asset('assets/img/white.png') : asset('assets/img/likee.svg') }}" alt="Heart" onclick="likeText({{ $frame->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                        <img id="commentIcon" src="{{ asset('assets/img/comment.svg') }}" alt="Chat" class="comment-icon" onclick="openTextCommentPanel({{ $frame->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                        <img src="{{ asset('assets/img/Share.svg') }}" alt="Share" onclick="shareContent({{ $frame->id }})" style="width: 24px; height: 24px; cursor: pointer;" />
                        {{-- @php
                                    $isPinned = $frame->pins->where('user_id', auth()->id())->where('is_pinned', 1)->count() > 0;
                                @endphp
                                <img src="{{ asset($isPinned ? 'assets/img/pinned.svg' : 'assets/img/pin.svg') }}" alt="pin" onclick="pinText({{ $frame->id }}, this)" style="filter: brightness(0) invert(1); width: 24px; height: 24px; cursor: pointer;" />
                        --}}
                        <!-- Delete Icon (Only if owner) -->
                        @if(auth()->id() == $frame->user_id)
                        <img src="{{ asset('assets/img/delete.svg') }}" alt="Delete" style="width: 24px; height: 24px; cursor: pointer;" onclick="openTextDeleteModal({{ $frame->id }})" />
                        @endif

                        <span id="likeCount-{{ $frame->id }}" style="font-size: 16px; color:white; margin-top:50px; margin-left:-185px;">
                            {{ $frame->getLikeCount() }}
                        </span>
                        <span id="commentCount-{{ $frame->id }}" style="font-size: 16px; color:white; margin-top:50px; margin-left:16px;">
                            {{ $frame->comments->count() }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>

    <!-- Favorite Videos Heading -->
    <h2 id="favoriteHeader" style="display: none; text-align: center; color: white; margin-top: 20px; font-size: 30px;">
        Favourite Videos
    </h2>

    <!-- Favorite Videos Grid (Empty initially) -->
    <div id="favoriteVideosWrapper" style="display: none;">
        <div id="favoriteVideos" class="videos-grid">
            <!-- Favorite videos yahan dynamically render honge -->
        </div>

        <!-- No Favorite Message -->
        <div id="noFavoritesMessage" style="display: none; text-align: center; color: white; font-size: 24px; margin-top: 20px;">
            No Favourite Videos Available
        </div>
    </div>
    </div>

    <!-- Video Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel" style="color:#0f0f0f;">Delete Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color:#0f0f0f;">
                    Are you sure you want to delete this video?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Audio Comment Panel -->
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

    <!-- Audio Delete Confirmation Modal -->
    <div class="modal fade" id="AudiodeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel" style="color: black;">Delete Audio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color:black;">
                    Are you sure you want to delete this audio?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmAudioDeleteBtn">Yes</button>
                </div>
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

    <!-- Stills delete Modal -->
    <div class="modal fade" id="stilldeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel" style="color: black;">Delete Still</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;">
                    Are you sure you want to delete this still?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmStillDeleteBtn">Yes</button>
                </div>
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

    <!-- Text Delete Modal -->
    <div class="modal fade" id="textdeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel" style="color: black;">Delete Text</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;">
                    Are you sure you want to delete this text?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmtextDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/preview_video.js') }}"></script>

    {{--friend request --}}
    <script>
        function toggleFriendDropdown() {
            const dropdown = document.getElementById('friendRequestDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        function confirmRequest(id) {
            fetch(`/friend/confirm/${id}`, {
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    , 'Content-Type': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                alert(data.message);
                location.reload();
            });
        }

        function rejectRequest(id) {
            fetch(`/friend/reject/${id}`, {
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    , 'Content-Type': 'application/json'
                }
            }).then(res => res.json()).then(data => {
                alert(data.message);
                location.reload();
            });
        }

        // Optional: click outside to close
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('friendRequestDropdown');
            const wrapper = document.querySelector('.friend-request-wrapper');
            if (!wrapper.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

    </script>

    {{--upload video --}}
    <script>
        document.querySelector('#uploadModal form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const fileInput = form.querySelector('#file');
            const file = fileInput.files[0];

            if (!file) {
                alert('Please select a video file.');
                return;
            }

            const url = URL.createObjectURL(file);
            const video = document.createElement('video');

            video.preload = 'metadata';
            video.src = url;

            video.onloadedmetadata = function() {
                URL.revokeObjectURL(url);
                const duration = video.duration;
                const maxDuration = 60; // max seconds allowed, change to 10 or 30 as needed

                if (duration > maxDuration) {
                    alert('Please upload a video not longer than ' + maxDuration + ' seconds.');
                    return;
                }

                // Duration okay, now submit with fetch
                const formData = new FormData(form);
                fetch("{{ route('upload.file') }}", {
                        method: 'POST'
                        , headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
            };
        });

    </script>

    {{-- cover image script --}}
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            const file = this.files[0];
            const formData = new FormData();
            formData.append('cover_image', file);

            fetch("{{ route('upload.cover.image') }}", {
                    method: "POST"
                    , headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
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

    {{-- delete video script --}}
    <script>
        let videoIdToDelete = null;

        // Open the modal and store the video ID
        function openDeleteModal(videoId) {
            videoIdToDelete = videoId;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Handle video deletion
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (videoIdToDelete !== null) {
                // Send delete request to backend
                fetch(`/delete-video/${videoIdToDelete}`, {
                        method: 'DELETE'
                        , headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            , 'Content-Type': 'application/json'
                        , }
                    , })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Hide modal and reload the page
                            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                            modal.hide();
                            location.reload(); // Reload the page to reflect changes
                        } else {
                            alert('Failed to delete video!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the video.');
                    });
            }
        });

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
            const allAudioIds = @json($audio -> pluck('id'));
            allAudioIds.forEach(id => {
                loadAudioLikes(id);
                loadAudioCommentsCount(id);
            });
        };

    </script>
    <!--end audio like & Fetch Audio like -->

    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

