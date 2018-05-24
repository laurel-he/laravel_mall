<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

class CustomerRepository extends Repository
{
//     public function  __construct(App $app, Collection $collection) 
//     {
//         parent::__construct($app, $collection);
        
//         $this->model = $this->model->newQuery();
//         $this->joinApp();
//         $this->model->with('app');
//     }
    
    
    public function model()
    {
        return 'App\Models\CustomerBasic';
    }




    public function  join($table, $field, $foreField) 
    {
        
         $this->model->join($table, "customer_basic.$field", '=', $table.".".$foreField);
        return $this;
    }
}