<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderGoods extends Model
{
    use SoftDeletes;
    protected $table = 'order_goods';
    protected $dates = [
        'deleted_at'
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $fillable = [
        'order_id',
        'goods_id',
        'goods_name',
        'price',
        'goods_number',
        'remark',
        'exchange_status',
        'sku_id',
        'sku_name',
        'sku_sn',
        'unit_type',
    ];
}
