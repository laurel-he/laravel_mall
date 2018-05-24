<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Models\Expressinvoices;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//         'App\Events\Event' => [
//             'App\Listeners\EventListener',
//         ],
        
        'App\Events\AddEmployee' => [
            'App\Listeners\SyncEmployeeRoleListener',
        ],
    		
    	'App\Events\AddDepartment' => [
    		'App\Listeners\SetManagerDepartmentIdListener'	
    	],
    		
    	'App\Events\ChangeDepartmentManager' => [
    		'App\Listeners\SetManagerDepartmentIdListener'
    	],
    		
    	'App\Events\UpdateGroupCaptain' => [
    		'App\Listeners\UpdateUserGroupIdListener'
    	],
    		
    	'App\Events\SetCustomerUser' => [
    		'App\Listeners\SetCustomerUserListener'
    	],
        
        'App\Events\AddOrder' => [
            'App\Listeners\AddOrderListener',
            'App\Listeners\ChangeCustomerToVListener'
        ],
        
        'App\Events\OrderCreating' => [
            'App\Listeners\OrderCreatingListener'
        ],
        
        'App\Events\OrderCancel' => [
            //库存
            'App\Listeners\OrderCancelListener',
            //退保证金
            'App\Listeners\DepositRefundListener'
        ],
        
        'App\Events\ProduceEntryCreating' => [
            'App\Listeners\ProduceEntryCreatingListener'
        ],
        
        'App\Events\ProduceEntried' => [
            'App\Listeners\ProduceEntriedListener'
        ],
        //订单通过审核  
        //所以在处理这个事件时需要另外的 事务处理 
        'App\Events\OrderPass' => [
            'App\Listeners\OrderPassCheckedListener',
            'App\Listeners\DepositDecrementListener', //扣保证金
            'App\Listeners\InventorySetAssignListener', //通知库存 进行对应的更新
            //'App\Listeners\CreateAssignListener',//生成配货单 生成发货锁定
        ],
        
        'App\Events\OrderUnPass' => [],
        
        'App\Events\AssignCreating' => [
            //生成assign_sn
            'App\Listeners\AssignCreatingListener'
        ],
        
        //生成发货记录 不用了 配货单自动就有了
        //库存表 更新对应的字段
        // @todo 修改订单状态 为 已发货
//         'App\Events\DeliverGoods' => [
//             'App\Listeners\InventoryAssignedListener'
//         ],
           
        //签名
//         'App\Events\Signatured' => [
//             'App\Listeners\InventorySignaturedListener'
//         ],
        
        //售后　@todo 没有生成对应的配货单
//         'App\Events\AddAfterSale' => [
//             'App\Listeners\ChangeOrderAfterSaleListener', //改售后状态
//             'App\Listeners\ChangeExchangeAfterSaleListener' //如果是换货则需要 换货锁定 
                
//         ],
        
        'App\Events\ContactConflict' => [
            'App\Listeners\ContactconflictListener'
        ],
        
        //仓库换货一个商品
//         'App\Events\ProductExchange' => [
//             'App\Listeners\ChangeExchangeAfterSaleUnLockListener' //解锁
//         ]
        
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        
    }
}
