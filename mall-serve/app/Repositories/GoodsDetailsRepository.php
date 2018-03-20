<?php
namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

class GoodsDetailsRepository extends Repository
{
	
    public function  __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);

//         $this->model->with('imgs','category');
  
//         $this->model->load('imgs', 'category');
    }
    
		public function  model() 
		{
		    return 'App\Models\Goods';
		}


		

}