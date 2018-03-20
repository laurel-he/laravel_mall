<?php
namespace App\Repositories\Criteria\Goods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class SkuSn extends Criteria
{
    /**
     *  @var string
     */
    private $sku_sn= null;
    
    public function  __construct($sku_sn)
    {
        $this->sku_sn= $sku_sn;
    }
    
    /**
     *
     * @param unknown $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function  apply($model, Repository $repository)
    {
        $sku_sn = $this->sku_sn;
        return $model->where(function($query) use($sku_sn){
            $query->where('sku_sn', 'like', $sku_sn."%")
                  ->orWhereHas('skus', function($q) use($sku_sn) {
                      $q->where('sku_sn', 'like', $sku_sn."%");
                  });
        });
        
    }
    
    
    
    
    
}