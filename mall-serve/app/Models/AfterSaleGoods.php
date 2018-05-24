<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AfterSaleGoods extends Model
{
    protected $table = 'order_after_sale_goods';
    
    protected $appends = ['goods_status_text'];
    
    protected $fillable = [
        'after_sale_id',
        'goods_id',
        'sku_sn',
        'goods_name',
        'goods_num',
        'unit_type',
        'type',
        'remark'
    ];
    
    
    public function afterSale()
    {
        return $this->belongsTo('App\Models\AfterSale', 'after_sale_id');
    }

    public function getGoodsStatusTextAttribute()
    {
        $map = ['完好','坏损'];
        return $map[$this->attributes['goods_status']];
    }
    
    public function isSetExchangeLock()
    {
        return $this->type == 2 ;
    }
    
    public function getTypeTextAttribute()
    {
        $map = ["退货", "换货退回",  "换货发货"];
        return $map[$this->attributes['type']];
    }
}
