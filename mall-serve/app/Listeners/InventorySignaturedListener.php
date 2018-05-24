<?php

namespace App\Listeners;

use App\Events\Signatured;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;

class InventorySignaturedListener
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
     * @param  Signatured  $event
     * @return void
     */
    public function handle(Signatured $event)
    {
        $assign = $event->getAssign();
        
        $this->inventorySys->orderSignatured($assign->entrepot_id, $assign);
    
    }
}
