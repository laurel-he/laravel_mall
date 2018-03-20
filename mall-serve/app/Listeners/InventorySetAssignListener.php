<?php

namespace App\Listeners;

use App\Events\OrderPass;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;

class InventorySetAssignListener
{
    
    private $inventorySys = null;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inventorySys = new Inventory();
    }

    /**
     * Handle the event.
     *
     * @param  OrderPass  $event
     * @return void
     */
    public function handle(OrderPass $event)
    {
        $order = $event->getOrder();
        $this->inventorySys->setOrderAssign($order->entrepot_id, $order->goods);
    }
}
