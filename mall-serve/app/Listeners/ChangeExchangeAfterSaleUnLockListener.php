<?php

namespace App\Listeners;

use App\Events\ProductExchange;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeExchangeAfterSaleUnLockListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->inventory = new Inventory();
    }

    /**
     * Handle the event.
     *
     * @param  ProductExchange  $event
     * @return void
     */
    public function handle(ProductExchange $event)
    {   
        $this->inventory->exchangeUnLock($event->entrepot_id, $event->goodsList);
    }
}
