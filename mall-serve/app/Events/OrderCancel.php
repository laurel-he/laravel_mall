<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\models\OrderBasic;

class OrderCancel
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $entrepot_id = null;
    private $goodsList = [];
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderBasic $order)
    {
        $this->entrepot_id = $order->entrepot_id;
        $this->goodsList = $order->goods;
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

    
    public function getEntrepotId()
    {
        return $this->entrepot_id;
    }
    
    public function getGoodsList()
    {
        return $this->goodsList;
    }
}
