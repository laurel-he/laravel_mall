<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class GoodsTypeRepository extends Repository 
{
    public function  model() 
    {
        return 'App\Models\GoodsType';
    }
    

}