<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class GoodsSpecsRepository extends Repository 
{
    public function  model() 
    {
        return 'App\Models\GoodsSpecs';
    }
    

}