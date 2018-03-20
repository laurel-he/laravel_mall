<?php
namespace App\Repositories\Criteria\Goods;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Criteria\Criteria;

class Name extends Criteria
{
	/**
	 *  @var string
	 */
	private $name= null;
	
	public function  __construct($name)
	{
		$this->name= $name;
	}
	
	/**
	 *
	 * @param unknown $model
	 * @param Repository $repository
	 *
	 * @return mixed
	 */
	public function  apply($model, Repository $repository)
	{
		return $model->where('goods_name','like', $this->name."%");
	}
}