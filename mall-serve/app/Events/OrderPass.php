<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\OrderBasic;
use App\Models\User;

class OrderPass
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $order = null;
    /**
     * 当前操作的用户
     * @var unknown
     */
    private $user = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderBasic $order, User $user)
    {
        $this->order = $order;
        $this->user  = $user; 
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

    public function getOrder()
    {
        return $this->order;
    }
    
    public function getUser()
    {
        return $this->user;
    }
}
