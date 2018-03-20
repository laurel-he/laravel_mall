<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Order extends Criteria
{
    private $field = null;
    private $way = null;
    
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->way = $value;
    }
    
    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy($this->field, $this->way);
    }
}