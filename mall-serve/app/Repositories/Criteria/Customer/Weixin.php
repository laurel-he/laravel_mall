<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Weixin extends Criteria
{

	private $weixin = null;
	
	public function __construct($weixin)
	{

		$this->weixin = $weixin;
	}


    public function  apply($model, RepositoryInterface $repository)
    {
        return $model->join('customer_contact','customer_basic.id','=','customer_contact.cus_id')->where('customer_contact.weixin', $this->weixin);
    }

}