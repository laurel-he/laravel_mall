<?php

namespace App\Listeners;

use App\Events\AddAfterSale;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;

class ChangeExchangeAfterSaleListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->inventory = new Inventory();
    }

    /**
     * Handle the event.
     *
     * @param  AddAfterSale  $event
     * @return void
     */
    public function handle(AddAfterSale $event)
    {
        $afterSale = $event->getAfterSale();
        $goods = $afterSale->goods;
        $filtered = $goods->filter(function($value, $index){
            return $value->isSetExchangeLock(); 
        });
        $this->inventory->exchangeLock($afterSale->entrepot_id, $filtered);
        
    }
}
