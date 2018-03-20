<?php

namespace App\Listeners;

use App\Events\ProduceEntried;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;

class ProduceEntriedListener
{
    
    private $inventorySys = null;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Inventory $inventory)
    {
        $this->inventorySys = $inventory;
    }

    /**
     * Handle the event.
     *
     * @param  ProduceEntred  $event
     * @return void
     */
    public function handle(ProduceEntried $event)
    {
        $this->inventorySys->produceEntry($event->getEntrepot(), $event->getProducts());
    }
}
