<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class OnlyTrashed extends Criteria
{
    public function  apply($model, RepositoryInterface $repository) 
    {
        return $model->onlyTrashed();
    }
}