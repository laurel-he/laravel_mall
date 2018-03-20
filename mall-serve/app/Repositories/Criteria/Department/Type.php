<?php
namespace App\Repositories\Criteria\Department;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Type extends Criteria
{
    /**
     * @var string
     */
    private $type = null;
    
    public function  __construct($type) 
    {
        $this->type = $type;
    }
    
    
    public function  apply($model, RepositoryInterface $repository) 
    {
        if (is_array($this->type)) {
            return $model->whereIn('type', $this->type);
        }
        return $model->where('type', $this->type);
    }
}