<?php
namespace App\Repositories\Criteria\Employee;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use App\Models\Group;

class GroupCandidate extends Criteria
{
	
	public function __construct()
	{
		
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Bosnadev\Repositories\Criteria\Criteria::apply()
	 */
	public function apply($model, RepositoryInterface $repository)
	{
		$manager_ids = Group::where('manager_id','<>',0)->whereNotNull('manager_id')->pluck('manager_id');
		if ($manager_ids) {
			$model->whereNotIn('id', $manager_ids);
		}	
		return $model;
	}
}