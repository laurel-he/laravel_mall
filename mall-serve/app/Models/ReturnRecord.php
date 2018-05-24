<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnRecord extends Model
{
    use SoftDeletes;
    
    protected $table = 'return_record';
    
    protected $dates = [
        'deleted_at'
    ];
    
    
    protected $fillable = [
        'entrepot_id',
        'goods_name',
        'goods_status',
        'sku_sn',
        'goods_num',
        'express_sn',
        'cus_name',
        'cus_qq',
        'cus_phone',
        'cus_weixin',
        'reason',
        'sale_name',
        'user_id',
        'user_name',
        'return_at',
        'remark'
    ];
}
