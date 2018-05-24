<?php

namespace App\Listeners;

use App\Events\OrderPass;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\DepositRecord;

class DepositDecrementListener
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
     * 扣保证金 
     * 
     *
     * @param  OrderPass  $event
     * @return void
     */
    public function handle(OrderPass $event)
    {
        $order = $event->getOrder();
        $operator = $event->getUser();
        //部门
        $department   =  $order->department ;
        
//         if ($order->order_pay_money > $department->deposit) {
//             return false; //停止事件传播
//         }
        
        //扣钱 保证金可以为负
//         $department->deposit_money = round($department->deposit- $order->order_pay_money, 2);
        $department->subDeposit($order->order_pay_money);
        $department->save();
        
        //这里如果出现负数也是会 报错的 不晓得 try catch能不能处理
//         if( !$department->save() ) {
//             //更新订单为待充值
//             $order->updateStatusToWaitCharge();
//             throw new \Exception('扣钱失败');
//         }
        
        //扣钱成功 记录一下
        DepositRecord::create([
            'user_id' => $operator->id, //操作员工
            'target_id' => $order->user->id,
            'event_type' => DepositRecord::APP_EVENT_ORDER_PASS,
            'money' => -$order->order_pay_money,
            'brief' => '订单号：'.$order->order_sn
        ]);
    }
}
