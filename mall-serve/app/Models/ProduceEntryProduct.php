<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProduceEntryProduct extends Model
{
    use SoftDeletes;
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $table = 'produce_in_product';
    
    protected $fillable = [
        'cate_type',
        'cate_kind',
        'cate_type_id',
        'cate_kind_id',
        'product_sale_type',
        'goods_name',
        'sku_sn',
        'num',
        'parent_id',
    ];
    
    public function produceEntry()
    {
        return $this->belongsTo('App\Models\ProduceEntry', 'parent_id')->select(['id', 'entry_sn','user_name','entry_at','comment']);
    }
}
