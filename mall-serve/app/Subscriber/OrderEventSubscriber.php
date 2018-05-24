<?php
namespace App\Subscriber;

use App\Models\OrderOperate;

class OrderEventSubscriber 
{
    
    private $user = null;
    public function __construct()
    {
        $this->user = auth()->user();
    }
    /**
     * 处理添加订单事件
     * @param unknown $event
     */
    public function onOrderAdd($event)
    {
        $order = $event->getOrder();
        $model = OrderOperate::create([
            'action_name' => OrderOperate::ACTION_CREATE,
            'user_name'   => $this->user->realname,
            'user_id'     => $this->uesr->id,
            'order_id'    => $order->id
//             'remark'      => 
        ]);
    }
    
    /**
     * 订单编辑
     * @param unknown $event
     */
    public function onOrderEdit($event)
    {
        
    }
    
    /**
     * 订单审核 通过审核
     * @param unknown $event
     */
    public function onOrderChecked($event)
    {
        $order = $event->getOrder();
        $model = OrderOperate::create([
            'action_name' => OrderOperate::ACTION_PASSED,
            'user_name'   => $this->user->realname,
            'user_id'     => $this->uesr->id,
            'order_id'    => $order->id
//             'remark'     => 
        ]);
    }
    
    /**
     * 订单审核 不通过审核
     * @param unknown $event
     */
    public function onOrderUnChecked($event)
    {
        $order = $event->getOrder();
        $model = OrderOperate::create([
            'action_name' => OrderOperate::ACTION_UNPASSED,
            'user_name'   => $this->user->realname,
            'user_id'     => $this->uesr->id,
            'order_id'    => $order->id
            //             'remark'     =>
        ]);
    }
    
    /**
     * 订单取消
     * @param unknown $event
     */
    public function onOrderCancel($event)
    {
        $order = $event->getOrder();
        $model = OrderOperate::create([
            'action_name' => OrderOperate::ACTION_CANCEL,
            'user_name'   => $this->user->realname,
            'user_id'     => $this->uesr->id,
            'order_id'    => $order->id
            //             'remark'     =>
        ]);
    }
    
    /**
     * 订单完成
     * @param unknown $event
     */
    public function onOrderFinish($event)
    {
        $order = $event->getOrder();
        $model = OrderOperate::create([
            'action_name' => OrderOperate::ACTION_FINISH,
            'user_name'   => $this->user->realname,
            'user_id'     => $this->uesr->id,
            'order_id'    => $order->id
            //             'remark'     =>
        ]);
    }
    
    /**
     * 为订阅者注册监听器。
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\AddOrder',
            'App\Subscriber\OrderEventSubscriber@onOrderAdd'
            );
        
        $events->listen(
            'App\Events\OrderPass',
            'App\Subscriber\OrderEventSubscriber@onOrderChecked'
            );
        
        $events->listen(
            'App\Events\OrderPass',
            'App\Subscriber\OrderEventSubscriber@onOrderEdit'
            );
        $events->listen(
            'App\Events\OrderUnPass',
            'App\Subscriber\OrderEventSubscriber@onOrderUnChecked'
            );
       
        $events->listen(
            'App\Events\OrderCancel',
            'App\Subscriber\OrderEventSubscriber@onOrderCancel'
            );
        
        
    }
    
    
    
}