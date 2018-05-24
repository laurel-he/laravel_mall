<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShelvesPick extends Model
{
    use SoftDeletes;
    protected $table ='shelves_picks';
    protected $fillable=[
        'shelves_id',
        'cate_type_id',
        'cate_type',
        'cate_kind_id',
        'cate_kind',
        'goods_name',
        'goods_num',
        'sku_sn',
        'remarks',
        'shelvesData',
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = [
        'deleted_at'
    ];
}
