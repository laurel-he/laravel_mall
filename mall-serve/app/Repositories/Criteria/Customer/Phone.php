<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Phone extends Criteria
{

	private $phone = null;
	
	public function __construct($phone)
	{

		$this->phone = $phone;
	}


    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->join('customer_contact','customer_basic.id','=','customer_contact.cus_id')->where('customer_contact.phone', $this->phone);
    }

}