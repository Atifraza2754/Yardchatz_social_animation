

<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LiveStreamController;
use TaylanUnutmaz\AgoraTokenBuilder\RtcTokenBuilder;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/notify-host-joined', [LiveStreamController::class, 'notifyHostJoined']);

Route::get('/agora/token', function (Request $req) {
    try {
        $appID = 'e5388ed01e1d4689bf2880469b3c4703';
        $appCertificate = '768236a244074f68a8b426840aed6baf';

        if (!$appID || !$appCertificate) throw new Exception('Missing Agora credentials');

        $channel = $req->query('channel') ?: throw new Exception('Missing channel name');
        $uid = rand(1, 100000);
        $role = $req->query('role') === 'host'
            ? RtcTokenBuilder::RolePublisher
            : RtcTokenBuilder::RoleSubscriber;

        $expireTs = now()->addHours(2)->timestamp;

        $token = RtcTokenBuilder::buildTokenWithUid(
            $appID,
            $appCertificate,
            $channel,
            $uid,
            $role,
            $expireTs
        );

        return response()->json(['token' => $token, 'uid' => $uid]);
    } catch (\Throwable $e) {
        Log::error('Agora Token Error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

