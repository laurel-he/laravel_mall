<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class OrderByIdDesc extends Criteria
{
    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy('id', 'desc');
    }
}