<?php
namespace App\Repositories\Criteria\Orderlist;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class OrderStatus extends Criteria
{
    /**
     *  @var string
     */
    private $where = null;
    private $whereIn = null;

    public function  __construct($where,$whereIn)
    {
        $this->where = $where;
        $this->whereIn = $whereIn;
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
        $query = $model->where($this->where);
        if($this->whereIn)
        {
            $query = $model->where($this->where)->whereIn('goods_id',$this->whereIn);
        }
        return $query;
    }
}