<?php
/**
 * 通知库存 解锁对应的商品
 */
namespace App\Listeners;

use App\Events\OrderCancel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;

class OrderCancelListener
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
     * @param  OrderCancel  $event
     * @return void
     */
    public function handle(OrderCancel $event)
    {   
        $this->inventorySys->cancelOrder($event->getEntrepotId(), $event->getGoodsList());
    }
}
