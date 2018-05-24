<?php

namespace App\Listeners;

use App\Events\AddAfterSale;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\models\OrderBasic;

class ChangeOrderAfterSaleListener
{
    
    
    /**
     * 
     * 
     *  l10"=>"申请退货",
        //"l11"=>"退货审核通过",
        "l11"=>"退货不通过",
        "l12"=>"退货中",
        "l13"=>"退货完成",
        
        
        "l20"=>"申请换货",
        //"l21"=>"换货审核通过",
        "l21"=>"换货不通过",
        "l22"=>"换货中",
        "l23"=>"换货完成"
     * 
     * 
     * 
     * 
     * 
     * 
     * check_status 0 1  2   0待审核 1通过 2不通过
     * type  0退货 1换货
     */
    
    private $statusMap = [
        [
             10,
             12,
             11
        ],
        [
            20,
            22,
            21
        ]
    ];
    
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
     * @param  AddAfterSale  $event
     * @return void
     */
    public function handle(AddAfterSale $event)
    {
        $afterSale = $event->getAfterSale();
        OrderBasic::where('id', $afterSale->order_id)
        ->update(['after_sale_status'=>$this->statusMap[$afterSale->type][$afterSale->check_status]]);
        if ($afterSale->type == 0) {
            return false;
        }
    }
}
