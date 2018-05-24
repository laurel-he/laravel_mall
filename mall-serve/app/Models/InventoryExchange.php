<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryExchange extends Model
{
    use SoftDeletes;
    
    protected $table = 'inventory_exchange';

    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'cus_name',
        'sku_sn',
        'entrepot_id',
        'before_goods_name',
        'before_goods_num',
        'after_goods_name',
        'after_goods_num',
        'before_cate_type',
        'before_cate_kind',
        'before_cate_type_id',
        'before_cate_kind_id',
        'after_cate_type',
        'after_cate_kind',
        'after_cate_type_id',
        'after_cate_kind_id',
        'exchange_reason',
        'in_inventory',
        'user_name',
        'user_id',
        'exchange_at',
    ];


}
