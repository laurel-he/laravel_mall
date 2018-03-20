<?php
namespace App\Services\Department;

use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;
use App\Repositories\Criteria\Department\Name as SearchDepartName;
use App\Repositories\Criteria\Department\Type;
use App\Alg\ModelCollection;
class DepartmentService
{
    /**
     * department 资源库
     * @var unknown
     */
    private $repository = null;
    
    private $request = null;
    
    public function  __construct(DepartmentRepository $departRepository, Request $request) 
    {
        $this->repository = $departRepository;
        $this->request = $request;
    }
    
    
    public function  get() 
    {
        if ($this->request->has('name')) {
            $name = app()->makeWith('App\Repositories\Criteria\Department\Name', ['name'=>$this->request->name]);
            $this->repository->pushCriteria($name);
        }
        
        if ($this->request->has('type')) {
            $this->repository->pushCriteria(new Type($this->request->input('type')));
        }
        
        $result = $this->repository->with(['manager'])->paginate();
        
        $collection = $result->getCollection();
        $collection = ModelCollection::setAppends($collection, ['type_text']);
        
        return [
        	'items'=> $collection,
            'total'=> $result->total()
        ];
    }
}
