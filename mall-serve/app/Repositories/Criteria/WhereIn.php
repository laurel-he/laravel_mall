<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class WhereIn extends Criteria
{
    private $field = null;
    private $value= null;
    
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }
    
    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->whereIn($this->field, $this->value);
    }
}