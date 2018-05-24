<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

class AssignRepository extends Repository
{
    public function  model()
    {
        return 'App\Models\Assign';
    }
}