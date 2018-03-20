<?php
namespace App\Repositories\Criteria\Ordergoods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Ordergoods extends Criteria
{
    /**
     *  @var string
     */
    private $whereIn = null;
    private $where = null;

    public function  __construct($where,$whereIn)
    {
        $this->whereIn = $whereIn;
        $this->where = $where;
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
        if($this->whereIn)
        {
            $query = $model->whereIn('goods_id',$this->whereIn[0]);
        }
        if($this->where)
        {
            $query = $model->where($this->where);
        }
        return $query;
    }
}