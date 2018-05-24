<?php
namespace App\Repositories\Criteria\Ordergoods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class DateRange extends Criteria
{
    /**
     *  @var string
     */
    private $range = null;
    
    public function  __construct($range)
    {
        $this->range= $entrepot_id;
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
        
        $range = $this->range;
        $model->where([
            ['created_at', '>=', $range[0]],
            ['created_at', '<=', $range[1]],
        ]);
        return $model;
    }
}