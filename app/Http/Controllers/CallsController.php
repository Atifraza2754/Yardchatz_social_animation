<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Call;
use App\Models\User;
use App\Models\CallLog;
use App\Events\CallUser;
use App\Events\SendOffer;
use App\Events\AnswerCall;
use App\Events\HangupCall;
use App\Events\SendAnswer;
use Illuminate\Http\Request;
use App\Models\CallRecording;
use App\Events\SendAudioOffer;
use App\Events\HangupAudioCall;
use App\Events\SendAudioAnswer;
use App\Events\SendIceCandidate;
use Illuminate\Support\Facades\Auth;
use App\Events\SendAudioIceCandidate;


class CallsController extends Controller
{

    public function video_cal($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.video_cal',compact('user'));
    
    }

    /* For video calls */
    public function sendOffer(Request $request)
    {
        $offer = $request->all();
        broadcast(new SendOffer($offer));
        

        CallLog::create([
            'caller_id' => auth()->id(),
            'receiver_id' => $offer['receiver_id'],
            'call_type' => $request->input('call_type', 'video'),
            'status' => 'initiated',
            'started_at' => now(),
        ]);

        $receiver = User::find($offer['receiver_id']);

        return response()->json([
            'success' => true,
            'receiver_ringtone' => $receiver->ringtone ?? null,
        ]);

    }



    public function sendAnswer(Request $request)
    {
        $answer = $request->all(); 
        broadcast(new SendAnswer($answer));
        CallLog::where('receiver_id', auth()->id())
            ->whereNull('ended_at')
            ->latest()
            ->first()
            ?->update(['status' => 'answered']);

        return response()->json(['success' => true]);
    }

    public function sendIceCandidate(Request $request)
    {
        $candidate = $request->input('candidate');
        broadcast(new SendIceCandidate($candidate));
        return response()->json(['success' => true]);
    }

    public function handleHangup(Request $request)
{
    $callType = $request->input('call_type', 'video');
    $receiverId = $request->input('receiver_id') ?? $request->input('to_user_id');

    // 🔁 Broadcast to the correct channel
    if ($callType === 'video') {
        broadcast(new HangupCall($receiverId));

    } else {
        broadcast(new HangupAudioCall());
    }

    $userId = auth()->id();
    $duration = $request->input('duration');


    $log = CallLog::where(function ($q) use ($userId, $receiverId) {
        $q->where('caller_id', $userId)->where('receiver_id', $receiverId)
          ->orWhere(function ($q2) use ($userId, $receiverId) {
              $q2->where('caller_id', $receiverId)->where('receiver_id', $userId);
          });
    })
    ->whereNull('ended_at')
    ->latest()
    ->first();

    if ((!$duration || $duration <= 0) && $log && $log->started_at) {
        $duration = now()->diffInSeconds($log->started_at);
    }

    if ($log) {
        $log->update([
            'status' => $log->status === 'answered' ? 'completed' : 'missed',
            'ended_at' => now(),
            'duration' => $duration,
        ]);
    }
    return response()->json(['status' => 'ok']);
}

    //end Video Call 

    
    //Start Audio Call
    public function audio_cal($id)
{
    $user = User::findOrFail($id);
    return view('frontend.audio_cal', compact('user'));
}


public function sendAudioOffer(Request $request)
{
    $offer = $request->all();
    broadcast(new SendAudioOffer($offer));

    CallLog::create([
        'caller_id' => auth()->id(),
        'receiver_id' => $offer['receiver_id'],
        'call_type' => 'audio',
        'status' => 'initiated',
        'started_at' => now(),
    ]);

    $receiver = User::find($offer['receiver_id']);

    return response()->json([
        'success' => true,
        'receiver_ringtone' => $receiver->ringtone ?? null,
    ]);
}


public function sendAudioAnswer(Request $request)
{
    $answer = $request->all();
    broadcast(new SendAudioAnswer($answer));

    CallLog::where('receiver_id', auth()->id())
        ->whereNull('ended_at')
        ->latest()
        ->first()
        ?->update(['status' => 'answered']);

    return response()->json(['success' => true]);
}

public function sendAudioIceCandidate(Request $request)
{
    $candidate = $request->input('candidate');
    broadcast(new SendAudioIceCandidate($candidate));

    return response()->json(['success' => true]);
}




public function handleAudioHangup(Request $request)
{
    $callType = $request->input('call_type', 'audio');
    $receiverId = $request->input('receiver_id') ?? $request->input('to_user_id');

    // 🔁 Broadcast to the correct channel
    if ($callType === 'audio') {
        broadcast(new HangupAudioCall($receiverId));

    } else {
        broadcast(new HangupCall());
    }

    $userId = auth()->id();
    $duration = $request->input('duration');

    $log = CallLog::where(function ($q) use ($userId, $receiverId) {
        $q->where('caller_id', $userId)->where('receiver_id', $receiverId)
          ->orWhere(function ($q2) use ($userId, $receiverId) {
              $q2->where('caller_id', $receiverId)->where('receiver_id', $userId);
          });
    })
    ->whereNull('ended_at')
    ->latest()
    ->first();

    if ((!$duration || $duration <= 0) && $log && $log->started_at) {
        $duration = now()->diffInSeconds($log->started_at);
    }

    if ($log) {
        $log->update([
            'status' => $log->status === 'answered' ? 'completed' : 'missed',
            'ended_at' => now(),
            'duration' => $duration,
        ]);
    }

    return response()->json(['status' => 'ok']);
}

/* end audio call */


// start Ringtone
 public function uploadRingtone(Request $request)
{
    $request->validate([
        'upload_ringtone' => 'required|mimes:mp3,wav,ogg|max:2048',
    ]);

    $user = Auth::user();

    // Remove previously uploaded custom ringtone if it's not one of the static ones
    $staticRingtones = [
        'ayla.mp3', 'arash-broken-angel.mp3', 'soft_piano.mp3',
        'someone-is-calling-you.mp3', 'ringtone_titanic.mp3',
        'morning_alarm.mp3', 'nature_sounds.mp3', 'synth_wave.mp3',
        'pop_melody.mp3', 'hiphop_vibe.mp3'
    ];

    if ($user->ringtone && !in_array($user->ringtone, $staticRingtones)) {
        $path = public_path('ringtones/' . $user->ringtone);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // Upload new file
    $file = $request->file('upload_ringtone');
    $filename = 'user_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('ringtones'), $filename);

    // Save to DB
    $user->ringtone = $filename;
    $user->save();

    return redirect()->back()->with('success', 'Custom ringtone uploaded and set successfully!');
}

public function setRingtone(Request $request)
{
    $request->validate([
        'ringtone' => 'required|string'
    ]);

    $user = Auth::user();
    $user->ringtone = $request->ringtone;
    $user->save();

    return response()->json(['success' => true]);
}
// end ringtone
}
