<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateGroupCaptain
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $user_id = 0;
    private $group_id = 0;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($group_id, $user_id)
    {
        $this->group_id = $group_id;
        $this->user_id = $user_id;
    }
    
    public function getUserId()
    {
    	return $this->user_id;
    }
    
    public function getGroupId()
    {
    	return $this->group_id;
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
}
