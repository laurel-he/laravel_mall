<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Services\Department\DepartmentService;
use App\Repositories\DepartmentRepository;
use App\Repositories\Criteria\Department\Type;

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
                $result->makeHidden([
                    'type_text',
                    'user',
                    'phone'
                ]);
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
        $re = $this->repository->create($request->input());
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
        $re = $this->repository->update($request->input(), $id);
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
            //return $this->success(1);
            return 1;
        } else {
            //return $this->error();
            return 2;
        }
    }
}
