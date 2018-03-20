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
    
    public function  joinSale() 
    {
        $this->join('customer_saleperson', 'id', 'cus_id');
        return $this;
    }
    
    public function  joinSpread() 
    { 
        $this->join('customer_spreadpeople', 'id', 'cus_id');
        return $this;
    }
    
    public function  joinApp() 
    {
        $this->join('customer_app', 'id', 'cus_id');
        return $this;
    }
}