<?php
namespace App\Services\Group;

use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use App\Repositories\Criteria\Department;
use App\Repositories\Criteria\NameLike;

class GroupService
{
    private $repository = null;
    
    private $request = null;
    
    public function  __construct(GroupRepository$repository, Request $request) 
    {
        $this->repository = $repository;
        $this->request = $request;
    }
    
    public function  get() 
    {
        if ($this->request->has('department_id')) {
            $this->repository->pushCriteria(new Department($this->request->input('department_id')));
        }
        
        if ($this->request->has('name')) {
        	$this->repository->pushCriteria(new NameLike($this->request->input('name',null)));
        }
        
        if ($this->request->has('with')) {
        	$this->repository->with($this->request->input('with'));
        } else {
        	$this->repository->with(['manager', 'department']);
        }
        
        $fields = $this->request->input('fields', ['*']);
        $result = $this->repository->paginate($this->request->input('pageSize', 20), $fields);
        $collection  = $result->getCollection();
//         foreach ($collection as &$value) {
//             $value->department;
//         }
        return [
            'items'=> $collection,
            'total'=> $result->total()
        ];
        
    }
}