<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class OrdergoodsRepository extends Repository
{
    public function  model()
    {
        return 'App\Models\OrderGoods';
    }
    public static function  setVisible($collection, $attributes)
    {
        foreach ($collection as &$model) {
            $model->setAppends($attributes);
        }
        return $collection;
    }
}