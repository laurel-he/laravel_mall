<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProduceEntried
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $entrepot_id = null;
    private $products = [];
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entrepot_id, $products)
    {
        $this->entrepot_id = $entrepot_id;
        $this->products = $products;
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

    
    public function getEntrepot()
    {
        return $this->entrepot_id;
    }
    
    public function getProducts()
    {
        return $this->products;
    }
}
