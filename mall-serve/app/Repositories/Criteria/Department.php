<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Department extends Criteria
{
    /**
     *  @var string
     */
    private $department_id = null;
    
    public function  __construct($department_id)
    {
        $this->department_id= $department_id;
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
        return $model->where('department_id', $this->department_id);
    }
}