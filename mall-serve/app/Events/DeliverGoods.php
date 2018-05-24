<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Assign;

class DeliverGoods
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * 发货单
     * @var unknown
     */
    private $assign = null; 

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Assign $assign)
    {
        $this->assign = $assign;
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

    public function getAssign()
    {
        return $this->assign;
    }
}
