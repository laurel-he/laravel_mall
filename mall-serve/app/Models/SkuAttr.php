<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkuAttr extends Model
{
    protected $table = 'sku_attrs';
    
    
    
    public function spec()
    {
        return $this->belongsTo('App\Models\GoodsSpecs');
    }
}
