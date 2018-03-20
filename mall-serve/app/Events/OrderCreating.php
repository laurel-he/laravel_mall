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

class OrderCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    private $order = null;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderBasic $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order ;
    }
}
