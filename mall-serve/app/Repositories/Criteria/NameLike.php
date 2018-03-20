<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class NameLike extends Criteria
{
	private $name = null;
	
	public function __construct($name)
	{
		$this->name = $name;
	}
	
	public function apply($model, RepositoryInterface $repository)
	{
		if ($this->name) {
			return $model->where('name', 'like', $this->name."%");
		} else {
			return $model;
		}
	}
}