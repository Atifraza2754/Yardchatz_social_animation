<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CallLog;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

public function ChatList()
{
    $userId = Auth::id();

    // Fetch all conversation partners
    $messages = Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->latest()
        ->get();

    // Group by other user
    $conversations = [];

    foreach ($messages as $message) {
        $otherUserId = $message->sender_id == $userId ? $message->receiver_id : $message->sender_id;
        if (!isset($conversations[$otherUserId])) {
            $conversations[$otherUserId] = [
                'user' => $message->sender_id == $userId ? $message->receiver : $message->sender,
                'latest_message' => $message->message,
                'time' => $message->created_at->diffForHumans()
            ];
        }
    }
    
    return view('frontend.chat_list', compact('conversations'));
}

//get msg 
/* public function getMessages($userId)
{
    $authId = auth()->id();

    $messages = Message::where(function($query) use ($authId, $userId) {
        $query->where('sender_id', $authId)
              ->where('receiver_id', $userId);
    })->orWhere(function($query) use ($authId, $userId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', $authId);
    })->orderBy('created_at')->get();

    return response()->json($messages);
} */


public function getMessages($id)
{
    $authId = auth()->id();

    // Get messages
    $messages = Message::where(function ($query) use ($authId, $id) {
        $query->where('sender_id', $authId)->where('receiver_id', $id);
    })->orWhere(function ($query) use ($authId, $id) {
        $query->where('sender_id', $id)->where('receiver_id', $authId);
    })
    ->get()
    ->map(function ($msg) {
        $msg->type = 'message';
        return $msg;
    });

    // Get call logs
    $calls = CallLog::where(function ($query) use ($authId, $id) {
        $query->where(function ($q) use ($authId, $id) {
            $q->where('caller_id', $authId)->where('receiver_id', $id);
        })->orWhere(function ($q) use ($authId, $id) {
            $q->where('caller_id', $id)->where('receiver_id', $authId);
        });
    })
    ->get()
    ->map(function ($call) {
        $call->type = 'call';
        $call->sender_id = $call->caller_id;
        return $call;
    });

    // Merge and sort
    $merged = $messages->merge($calls)->sortBy(function ($item) {
        return $item->created_at ?? $item->started_at;
    })->values();

    return response()->json($merged);
}



 //Single Chat screen  Message View 
 public function MessageView($id)
{
    $user = User::findOrFail($id);
    $authId = auth()->id();

    // Messages
    $messages = Message::with('sender')
        ->where(function ($query) use ($id, $authId) {
            $query->where('sender_id', $authId)->where('receiver_id', $id);
        })
        ->orWhere(function ($query) use ($id, $authId) {
            $query->where('sender_id', $id)->where('receiver_id', $authId);
        })
        ->get()
        ->map(function ($msg) {
            $msg->type = 'message';
            return $msg;
        });

    // Call Logs
    $calls = CallLog::where(function ($query) use ($authId, $id) {
        $query->where(function ($q) use ($authId, $id) {
            $q->where('caller_id', $authId)->where('receiver_id', $id);
        })->orWhere(function ($q) use ($authId, $id) {
            $q->where('caller_id', $id)->where('receiver_id', $authId);
        });
    })
    ->get()
    ->map(function ($call) {
        $call->type = 'call';
        $call->sender_id = $call->caller_id; 
        return $call;
    });

    // Merge and sort
    $merged = $messages->merge($calls)->sortBy(function ($item) {
        return $item->created_at ?? $item->started_at;
    })->values();

    return view('frontend.text_messg', compact('user', 'merged'));
}


 
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($message));
        

        return ['status' => 'Message Sent!'];
    }
}
 ?>