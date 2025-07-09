<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\StillsController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UploadText_Controller;
use App\Events\HangupCall;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // Agar user login hai to dashboard par redirect kar do
    if (Auth::check()) {
        return redirect()->route('yardcharz');
    }
    // Agar user login nahi hai to welcome page dikhao
    return view('welcome');
});

Auth::routes();
// frontent Routes




Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/map', [App\Http\Controllers\FrontendController::class, 'map'])->name('map');
    Route::get('/long_video', [App\Http\Controllers\FrontendController::class, 'long_video'])->name('long_video');
    Route::get('/music', [App\Http\Controllers\FrontendController::class, 'music'])->name('music');
    Route::get('/feed', [App\Http\Controllers\FrontendController::class, 'feed'])->name('feed');
    Route::get('/nav_camera', [App\Http\Controllers\FrontendController::class, 'nav_camera'])->name('nav_camera');
    Route::get('/apple', [App\Http\Controllers\FrontendController::class, 'apple'])->name('apple');
    Route::get('/friends', [App\Http\Controllers\FrontendController::class, 'friends'])->name('friends');
    Route::get('/fam', [App\Http\Controllers\FrontendController::class, 'fam'])->name('fam');
    Route::get('/video', [App\Http\Controllers\FrontendController::class, 'video'])->name('video');
    Route::get('/text', [App\Http\Controllers\FrontendController::class, 'text'])->name('text');
    Route::get('/video_page', [App\Http\Controllers\FrontendController::class, 'video_page'])->name('video_page');
    Route::get('/second_cam', [App\Http\Controllers\FrontendController::class, 'second_cam'])->name('second_cam');
    Route::get('/main_cam', [App\Http\Controllers\FrontendController::class, 'main_cam'])->name('main_cam');
    Route::get('/third_cam', [App\Http\Controllers\FrontendController::class, 'third_cam'])->name('third_cam');
    Route::get('/forth_cam', [App\Http\Controllers\FrontendController::class, 'forth_cam'])->name('forth_cam');
    Route::get('/camera', [App\Http\Controllers\FrontendController::class, 'camera'])->name('camera');
    Route::get('/home_town', [App\Http\Controllers\FrontendController::class, 'home_town'])->name('home_town');
    Route::get('/id_card', [App\Http\Controllers\FrontendController::class, 'id_card'])->name('id_card');
    Route::get('/invite', [App\Http\Controllers\FrontendController::class, 'invite'])->name('invite');
    Route::get('/month', [App\Http\Controllers\FrontendController::class, 'month'])->name('month');
    Route::get('/payment', [App\Http\Controllers\FrontendController::class, 'payment'])->name('payment');
    Route::get('/terms_condition', [App\Http\Controllers\FrontendController::class, 'terms_condition'])->name('terms_condition');
    Route::get('/permission', [App\Http\Controllers\FrontendController::class, 'permission'])->name('permission');
    Route::get('/term_condition_sec', [App\Http\Controllers\FrontendController::class, 'term_condition_sec'])->name('term_condition_sec');
    Route::get('/text_two', [App\Http\Controllers\FrontendController::class, 'text_two'])->name('text_two');
    Route::get('/take_a_pic', [App\Http\Controllers\FrontendController::class, 'take_a_pic'])->name('take_a_pic');
    Route::get('/permis', [App\Http\Controllers\FrontendController::class, 'permis'])->name('permis');
    Route::get('/termCondition', [App\Http\Controllers\FrontendController::class, 'termCondition'])->name('termCondition');
    Route::get('/Creditcard', [App\Http\Controllers\FrontendController::class, 'Creditcard'])->name('Creditcard');
    Route::get('/venmo', [App\Http\Controllers\FrontendController::class, 'venmo'])->name('venmo');
    Route::get('/apply_pay', [App\Http\Controllers\FrontendController::class, 'apply_pay'])->name('apply_pay');
    Route::get('/yardcharz', [App\Http\Controllers\FrontendController::class, 'yardcharz'])->name('yardcharz');
    Route::get('/invitedfriends', [App\Http\Controllers\FrontendController::class, 'invitedfriends'])->name('invitedfriends');
    Route::get('/socialmedia', [App\Http\Controllers\FrontendController::class, 'socialmedia'])->name('socialmedia');
    Route::get('/eastjackson', [App\Http\Controllers\FrontendController::class, 'eastjackson'])->name('eastjackson');
    Route::get('/uploadpic', [App\Http\Controllers\FrontendController::class, 'uploadpic'])->name('uploadpic');
    Route::get('/main_profile', [App\Http\Controllers\FrontendController::class, 'main_profile'])->name('main_profile');
    Route::get('/richpeople', [App\Http\Controllers\FrontendController::class, 'richpeople'])->name('richpeople');
    Route::get('/live_screen', [App\Http\Controllers\FrontendController::class, 'live_screen'])->name('live_screen');
    Route::get('/household', [App\Http\Controllers\FrontendController::class, 'household'])->name('household');
    Route::get('/free_version', [App\Http\Controllers\FrontendController::class, 'free_version'])->name('free_version');
    Route::get('/new_feed', [App\Http\Controllers\FrontendController::class, 'new_feed'])->name('new_feed');
    Route::get('/record', [App\Http\Controllers\FrontendController::class, 'record'])->name('record');
    Route::get('/userpannel', [App\Http\Controllers\FrontendController::class, 'userpannel'])->name('userpannel');
    Route::get('/audio_new', [App\Http\Controllers\FrontendController::class, 'audio_new'])->name('audio_new');
    Route::get('/frame', [App\Http\Controllers\FrontendController::class, 'frame'])->name('frame');
});


Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/upload-cover-image', 'uploadCover')->name('upload.cover.image');
        Route::get('/user/profile/{id}',  'view_profile')->name('user.profile');
        Route::get('/setting',  'setting')->name('setting');
        Route::post('/settings',  'updateSettings')->name('settings.update');
        Route::get('/users',  'users')->name('users');
        Route::post('/change-password', 'updatePassword')->name('password.change');
        Route::post('/upload-id-card',  'uploadIdCard')->name('upload.id.card');
        Route::get('/person',  'person')->name('person');
        Route::post('/update-person', 'updatePerson')->name('update-person');

    });
});


Route::middleware(['auth'])->group(function () {
    Route::controller(AudioController::class)->group(function () {
        Route::get('/signal_audio','audio_songs')->name('signal_audio');
        Route::post('/upload-audio','store')->name('upload-audio');
        Route::post('/toggle-audio-like', 'toggleAudioLike');
        Route::get('/get-audio-likes', 'getAudioLikes');
        Route::post('/submit-audio-comment','submitComment');
        Route::get('/get-audio-comments','getAudioComments');
        Route::get('/share-audio/{id}',  'shared_audio');
        Route::get('/get-audio-comments-count', 'getAudioCommentsCount');
        Route::post('/toggle-audio-pin','togglePin');
        Route::delete('/delete-audio/{audioId}', 'deleteAudio');


    });
});


Route::middleware(['auth'])->group(function () {
    Route::controller(VideoController::class)->group(function () {
        Route::get('/preview_video','preview_video')->name('preview_video');
        Route::get('/preview_video','preview_video')->name('preview_video');
        Route::post('/upload', 'store')->name('upload.file');
        Route::get('/live_page', 'live_page_videos')->name('live_page');
        Route::post('/add-comment',  'store_comment')->name('comments.store');
        Route::get('/comments',  'getComments')->name('comments.get');
        Route::post('/toggle-like', 'toggleLike')->name('toggle-like');
        Route::get('/get-likes', 'getLikes')->name('get-likes');
        Route::post('/add-reply','addReply');
        Route::get('/replies/{commentId}', 'getReplies');
        Route::post('/toggle-comment-like', 'toggleCommentLike');
        Route::get('/get-comment-likes',  'getCommentLikes');
        Route::post('/toggle-favorite', 'toggleFavorite')->name('toggle-favorite');
        Route::get('/get-favorites', 'getFavorites')->name('get-favorites');
        Route::get('/fetch-favorites', 'fetchFavoriteVideos')->name('fetch-favorites');
        Route::get('/video/{id}', 'show');
        Route::delete('/delete-video/{videoId}', 'deleteVideo');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(StillsController::class)->group(function () {
        Route::get('/stills', 'stills' )->name('stills');
        Route::post('/image/upload','store')->name('image.upload');
        Route::post('/like-still/{stillId}',  'likeStills');
        Route::post('/submit-still-comment','submitComment');
        Route::get('/get-still-comments','getStillComments');
        Route::get('/share-still/{id}',  'shared_still');
        Route::post('/toggle-still-pin','togglePin');
        Route::delete('/delete-still/{stillId}',  'deleteStill');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::controller(UploadText_Controller::class)->group(function () {
        Route::get('/text_upload', 'text_upload')->name('text_upload');
        Route::post('text/upload', 'store')->name('text.upload');
        Route::post('/like-text/{stillId}',  'likeText');
        Route::post('/submit-text-comment','submitComment');
        Route::get('/get-comments','getComments');
        Route::get('/share-text/{id}',  'shared_text');
        Route::get('/get-text-comments-count', 'getTextCommentsCount');
        Route::post('/toggle-text-pin','togglePin');
        Route::delete('/delete-text/{textId}',  'deleteText');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::controller(FriendController::class)->group(function () {
    Route::post('/friend/send/{id}',  'sendRequest')->name('friend.send');
    Route::post('/friend/confirm/{id}', 'confirmRequest')->name('friend.confirm');
    Route::post('/friend/reject/{id}', 'rejectRequest')->name('friend.reject');
    Route::get('/friend/requests', 'getFriendRequests')->name('friend.requests');
    Route::get('/friend/status/{id}',  'getFriendshipStatus')->name('friend.status');
    Route::post('/friend/cancel/{id}', 'cancelRequest')->name('friend.cancel');
    
    });
});

    Route::middleware(['auth'])->group(function () {
        Route::controller(PrivacyController::class)->group(function () {
        Route::post('/privacy/ajax-update','updatePrivacy')->name('privacy.ajax.update');
    });
});


    Route::middleware('auth')->group(function () {
            Route::controller(ChatController::class)->group(function () {
            Route::get('/allchats', 'ChatList');  
            Route::get('/messages/{userId}', 'getMessages');  
            Route::get('/text_messg/{id}', 'MessageView')->name('text_messg');
            Route::post('/send-message', [ChatController::class, 'sendMessage']);
    });
});

    Route::middleware(['auth'])->group(function () {
        Route::controller(CallsController::class)->group(function () {
        // VIDEO call routes
        Route::get('/video_cal/{id}',  'video_cal')->name('video_cal')->name('video.call');;
        Route::post('/signal/offer', [CallsController::class, 'sendOffer']);
        Route::post('/signal/candidate', [CallsController::class, 'sendIceCandidate']);
        Route::post('/signal/answer', [CallsController::class, 'sendAnswer']);
        Route::post('/signal/hangup', [CallsController::class, 'handleHangup']);

        // AUDIO call routes
        Route::get('/audio_cal/{id}',  'audio_cal')->name('audio_cal');
        Route::post('/audio-signal/offer', [CallsController::class, 'sendAudioOffer']);
        Route::post('/audio-signal/answer', [CallsController::class, 'sendAudioAnswer']);
        Route::post('/audio-signal/candidate', [CallsController::class, 'sendAudioIceCandidate']);
        Route::post('/audio-signal/hangup', [CallsController::class, 'handleAudioHangup']);

        // ringtone routes
        Route::post('/upload-ringtone', 'uploadRingtone')->name('upload.ringtone');
        Route::post('/set-ringtone',  'setRingtone')->name('set.ringtone');

    });
});


Route::get('/live_screen', function () {
    $user = Auth::user();
    $channel = 'user_' . $user->id; // or $user->username
    return view('frontend.live_screen', compact('channel'));
})->middleware('auth')->name('live_screen');

Route::get('/profile/{channel}', function($channel) {
    return view('frontend.profile', compact('channel'));
});




Route::get('/logout',function(){
    Auth::logout();
    
    return view('welcome');
});