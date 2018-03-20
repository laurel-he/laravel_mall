<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChangeDepartmentManager
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	
    private $department_id = 0;
    private $user_id = 0;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($departId, $userId)
    {
    	$this->department_id = $departId;
    	$this->user_id = $userId;
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

    public function getDepartmentId()
    {
    	return $this->department_id;
    }
    
    public function getUserId()
    {
    	return $this->user_id;
    }
}
