<?php

namespace App\Listeners;

use App\Events\OrderPass;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Assign;
use App\Models\OrderGoods;
use App\Models\OrderAddress;

class CreateAssignListener
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
     * 要改成一个商品一个快递号
     *
     * @param  OrderPass  $event
     * 
     * @throws 
     * 
     * @return void
     */
    public function handle(OrderPass $event)
    {
        $order = $event->getOrder();
        
        $addressModel = OrderAddress::find($order->id);
        
        foreach ($order->goods  as $product) {
            $re = Assign::create([
                'entrepot_id'=>$order->entrepot_id,
                'order_id'=>$order->id,
                'order_goods_id'=>$product->id,
                'order_address_id'=>$addressModel->id
            ]);
        }
        
        $re = Assign::create([
            'entrepot_id'=>$order->entrepot_id,
            'order_id'=>$order->id
        ]);
        
        if (!$re) {
            throw new \Exception('配货单创建失败');
        }
        
        //更新 order_goods 表 assign_lock_at 字段为当前时间
        $affectRows = OrderGoods::where('order_id', $order->id)->update(['assign_lock_at'=> Date('Y-m-d H:i:s')]);
        if ($affectRows == 0 ) {
            throw new \Exception('更新 assign_lock_at 失败');
        }
    }
}
