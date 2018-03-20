<?php
namespace App\Repositories\Criteria\Employee;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Id extends Criteria
{
	/**
	 * @var string
	 */
	private $type = null;
	
	public function  __construct($id)
	{
		$this->id = $id;
	}
	
	
	public function  apply($model, RepositoryInterface $repository)
	{
		return $model->orWhere('id', $this->id);
	}
}