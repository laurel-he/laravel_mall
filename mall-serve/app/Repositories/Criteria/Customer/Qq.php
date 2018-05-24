<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Qq extends Criteria
{

	private $qq = null;
	
	public function __construct($qq)
	{

		$this->qq = $qq;
	}


    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->join('customer_contact','customer_basic.id','=','customer_contact.cus_id')->where('customer_contact.qq', $this->qq);
    }

}