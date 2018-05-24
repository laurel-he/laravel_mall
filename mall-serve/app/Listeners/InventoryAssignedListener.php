<?php

namespace App\Listeners;

use App\Events\DeliverGoods;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;

class InventoryAssignedListener
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
     * @param  DeliverGoods  $event
     * @return void
     */
    public function handle(DeliverGoods $event)
    {
        $assign = $event->getAssign();
        
        $this->inventorySys->orderAssigned($assign->entrepot_id, $assign);
    }
}
