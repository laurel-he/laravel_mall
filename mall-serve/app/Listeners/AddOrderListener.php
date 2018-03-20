<?php
/**
 *  库存系统 处理库存
 */
namespace App\Listeners;

use App\Events\AddOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Inventory;


class AddOrderListener
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
     * @param  AddOrder  $event
     * @return void
     */
    public function handle(AddOrder $event)
    {
        $order = $event->getOrder();
        $this->inventorySys->AddOrder($order->entrepot_id, $order->goods);
        
    }
}
