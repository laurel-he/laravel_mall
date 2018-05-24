<?php

namespace App\Listeners;

use App\Events\OrderCancel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
/**
 * 取消订单退保证金
 * 
 * @author hyf
 *
 */
class DepositRefundListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCancel  $event
     * @return void
     */
    public function handle(OrderCancel $event)
    {
        $order = $event->getOrder();
        $department = $order->department;
        
        $department->addDeposit($order->order_pay_money);
        if ($department->save()) {
            throw new \Exception('退还保证金失败');
        }
        
    }
}
