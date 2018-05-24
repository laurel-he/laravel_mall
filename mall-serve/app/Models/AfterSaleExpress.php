<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AfterSaleExpress extends Model
{
    use SoftDeletes;
    
    protected $table = 'order_after_sale_express';
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'express_sn',
        'after_sale_id'
    ];
    
    public function afterSale()
    {
        return $this->belongsTo('App\Models\AfterSale', 'after_sale_id');
    }
}
