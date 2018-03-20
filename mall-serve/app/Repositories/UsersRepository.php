<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class UsersRepository extends Repository
{
    public function  model()
    {
        return 'App\Models\Users';
    }
    public static function  setVisible($collection, $attributes)
    {
        foreach ($collection as &$model) {
            $model->setAppends($attributes);
        }
        return $collection;
    }
}