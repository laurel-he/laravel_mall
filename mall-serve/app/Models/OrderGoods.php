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
    //'created_at',
    protected $hidden = [ 'updated_at','deleted_at'];
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
    
    public function productCategory()
    {
        return $this->belongsTo('App\Models\EntrepotProductCategory', 'sku_sn', 'sku_sn');
    }
    
    public function order()
    {
        return $this->belongsTo('App\Models\OrderBasic', 'order_id');
    }
    
    public function assign()
    {
        return $this->hasOne('App\Models\Assign', 'order_goods_id')->select(['id','order_goods_id','out_entrepot_at','sign_at']);
    }
}
