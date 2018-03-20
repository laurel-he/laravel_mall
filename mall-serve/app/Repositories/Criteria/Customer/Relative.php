<?php
namespace App\Repositories\Criteria\Customer;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;

class Relative extends Criteria
{
	private $id = 0 ;
	private $field = null;
	
	public function __construct($id, $field)
	{
		$this->id = $id;
		$this->field = $field;
	}
	
	public function apply($model, RepositoryInterface $repository)
	{
		//laravel文档上whereHas是对hasMany这种关系用的， 没想到这里对hasOne也是可以的。哈哈哈！！！
		$id = $this->id;
		$field = $this->field;
		return $model->whereHas('midRelative', function($query) use($id, $field) {
			$query->where($field, $id);
		});
	}
}