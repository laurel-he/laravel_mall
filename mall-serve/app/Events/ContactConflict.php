<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ContactConflict
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $message = null;
    private $request = null;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $contact)
    {
        $this->message = $message;
        $this->request = $contact;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
//     public function broadcastOn()
//     {
//         return new PrivateChannel('channel-name');
//     }

    
    public function getMessage()
    {
        return $this->message->getMessages();
    }
    
    public function getContact()
    {
        return $this->request;
    }
}
