<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

class EmployeeRepository extends Repository
{
	
    public function  __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);

//         $this->model->orderBy('id','desc');
        
    }
	
	
    public function  model() 
    {
        return 'App\Models\User';
    }
}