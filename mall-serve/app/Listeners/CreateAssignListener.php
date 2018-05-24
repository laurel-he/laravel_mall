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
        
        //$addressModel = OrderAddress::find($order->id);
        $order->goods->load('productCategory');
        
        $inserts = [];
        foreach ($order->goods  as $product) {
//             var_dump($product);
            $inserts[] =Assign::create([
                'entrepot_id'=> $order->entrepot_id,
                'order_id'   => $order->id,
                'address_id' => $order->address->id,
//                 'order_goods_id'   => $product->id,
//                 'cus_name'   => $order->customer->name,
//                 'goods_name' => $product->goods_name,
//                 'goods_num'  => $product->goods_number,
//                 'unit_type'  => $product->unit_type,
//                 'cate_type'  => $product->productCategory->cate_type,
//                 'cate_type_id' => $product->productCategory->cate_type_id,
//                 'cate_kind'  => $product->productCategory->cate_kind,
//                 'cate_kind_id' => $product->productCategory->cate_kind_id,
//                 'deliver_name' => $order->address->name,
//                 'deliver_phone' => $order->address->phone,
//                 'deliver_zip_code' => $order->address->zip_code,
//                 'deliver_address' => $order->address->address,
//                 'sale_name' => $order->deal_name,
//                 'pass_check' => $order->auditor_time
            ]);
        }
        
        
        if (count($inserts) == 0) {
            throw new \Exception('配货单创建失败');
        }
        
        //更新 order_goods 表 assign_lock_at 字段为当前时间
        $affectRows = OrderGoods::where('order_id', $order->id)->update(['assign_lock_at'=> Date('Y-m-d H:i:s')]);
        if ($affectRows == 0 ) {
            throw new \Exception('更新 assign_lock_at 失败');
        }
    }
}
