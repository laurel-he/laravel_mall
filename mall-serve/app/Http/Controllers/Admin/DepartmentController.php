<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Services\Department\DepartmentService;
use App\Repositories\DepartmentRepository;
use App\Repositories\Criteria\Department\Type;
use App\Events\AddDepartment;
use Illuminate\Support\Facades\DB;
use App\Events\ChangeDepartmentManager;
use App\Models\User;

class DepartmentController extends Controller
{

    private $repository = null;
    public function  __construct(DepartmentRepository $departmentReporitory) 
    {
        $this->repository = $departmentReporitory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return ['id'=>1,'name'=>'asdf'];die;
        $business = $request->query('business', 'default');
        
        $result = [];
        switch ($business) {
            case 'DepartmentType':
                $result = Department::getType();
                break;
            case 'select':
                if ($request->has('type')) {
                    $type = new Type($request->input('type')); // $request->type;
                    $this->repository->pushCriteria($type);
                }
                $result = $this->repository->all($request->input('fields')); 
//                 $result->makeHidden([
//                     'type_text',
//                     'user',
//                     'phone'
//                 ]);
                break;
            default:
//                 $service = new DepartmentService($this->repository);
                $service = app('App\Services\Department\DepartmentService');
                $result = $service->get();
                break;
        }
        
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function getDepartmentByType($type)
    {
        $data=Department::where('type','=',$type)->get();
        return ['items'=>$data];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //throw new \Exception('test');
        //dd($request->input());
        $re =  DB::transaction(function() use($request){
        	$re = $this->repository->create($request->input());
        	event(new AddDepartment($re->id, $re->manager_id));
        	return $re;
        });

        if ($re) {
            return $this->success($re);
        } else {
            return $this->error($re);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update 返回 bool
        //var_dump(Department::find($id));die();
        $model = $this->repository->find($id);
        $data = $request->all();
        
        $repository = $this->repository;
        
        $re = DB::transaction(function()use($model, $data, $repository){
        	if ( $data['manager_id'] != 0 && $model->manager_id != $data['manager_id']) {
        		event(new ChangeDepartmentManager($model->id, $data['manager_id']));
        	} elseif($data['manager_id'] == 0) {
        		User::where('id', $model->manager_id )->update(['department_id'=>0]);
        	}
        	return $repository->update($data, $model->id);
        });
        
        if ($re) {
            return $this->success(Department::find($id));
            //return 1;
        } else {
            return $this->error();
            //return 2;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //返回 int
        $re = $this->repository->delete($id);
        if ($re) {
            return $this->success(1);
//             return 1;
        } else {
            return $this->error();
//             return 2;
        }
    }
}
