<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class CategoryRepository extends Repository
{
    public function  model() 
    {
        return 'App\Models\Category';
    }
}