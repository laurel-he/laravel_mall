<?php
namespace App\traits;


trait EntrepotProductCategoryTrait
{
    public function category()
    {
        return $this->belongsTo('App\Modles\EntrepotProductCategory', 'sku_sn');
    }
}