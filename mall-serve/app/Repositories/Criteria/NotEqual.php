<?php
namespace App\Repositories\Criteria;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class NotEqual extends Criteria
{
	
	private $field = "";
	private $value = "";
	
	public function __construct($field, $value)
	{
		$this->field = $field;
		$this->value = $value;
	}
	
	public function apply($model, RepositoryInterface $repository)
	{
		return $model->where($this->field,'<>',$this->value);
	}
	
}