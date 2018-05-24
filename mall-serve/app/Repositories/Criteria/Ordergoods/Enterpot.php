<?php
namespace App\Repositories\Criteria\Ordergoods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Enterpot extends Criteria
{
    /**
     *  @var string
     */
    private $entrepot_id = null;
    private $range = null;
    
    public function  __construct($entrepot_id)
    {
        $this->entrepot_id= $entrepot_id;
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
        $entrepot_id = $this->entrepot_id;
        $range = $this->range;
        $query = $model->whereHas('order', function($query) use($entrepot_id, $range){
           $query->where('entrepot_id', $entrepot_id);
        });
        return $query;
    }
}