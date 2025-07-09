<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class ViewerJoinedNotification extends Notification implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $viewerName;
    public $channel;

    public function __construct($viewerName, $channel)
    {
        $this->viewerName = $viewerName;
        $this->channel = $channel;
    }

    // Define the channels via which the notification will be sent (database and broadcast)
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    // Notification data stored in the database
    public function toDatabase($notifiable)
    {
        return [
            'message' => "{$this->viewerName} has joined your stream.",
        ];
    }

    // Broadcasting notification via Pusher or WebSocket
   public function broadcastOn()
{
    return new Channel('live-stream.' . $this->channel); // Broadcasting on live-stream.{channel}
}

    // Optional: Define a custom event name
    public function broadcastAs()
    {
        return 'ViewerJoinedNotification';
    }

    // Convert notification data to array (for broadcasting)
    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->viewerName} has joined your stream.",
        ];
    }

    // Optional: Add any custom data you want to broadcast
    public function broadcastWith()
    {
        return [
            'message' => "{$this->viewerName} has joined your stream.",
        ];
    }
}
