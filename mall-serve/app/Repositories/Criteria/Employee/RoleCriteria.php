<?php
namespace App\Repositories\Criteria\Employee;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use App\Models\Role;

class RoleCriteria extends Criteria
{
	private $roleName = '';
	
	public function __construct($name)
	{
		$this->roleName = $name;
	}
	public  function apply($model, RepositoryInterface $repository)
	{
		
		$roleId = Role::where('name', $this->roleName)->withoutGlobalScope('hide')->value('id');
		
		return $model->whereHas('midRole', function($query)use($roleId){
			$query->where('role_id', $roleId);
		});
	}
}