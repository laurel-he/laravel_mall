<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Name extends Criteria
{

	private $name = null;
	
	public function __construct($name)
	{

		$this->name = $name;
	}


    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->where('name', $this->name);
    }

}