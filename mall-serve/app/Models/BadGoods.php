<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BadGoods extends Model
{
    use SoftDeletes;
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $table = 'entrepot_badgoods';
    
    protected $fillable = [
        'entrepot_id',
        'sku_sn',
        'cate_type',
        'cate_kind',
        'cate_type_id',
        'cate_kind_id',
        'product_sale_type',
        'num',
        'user_id',
        'user_name',
        'reg_at',
        'remark'
    ];
}
