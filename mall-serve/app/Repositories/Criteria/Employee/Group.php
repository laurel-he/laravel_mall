<?php
namespace App\Repositories\Criteria\Employee;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Group extends Criteria
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
		return $model->where('group_id', $this->id);
	}
}