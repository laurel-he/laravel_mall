<?php
namespace  App\Services\Employee;

use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use APP\models\User;
use App\Alg\ModelCollection;
use App\Repositories\Criteria\OrderByIdDesc;
use App\Repositories\Criteria\OnlyTrashed;
use App\Repositories\Criteria\Employee\DepartCandidate;
use App\Repositories\Criteria\Employee\Group;
use App\Repositories\Criteria\Department;
use App\Repositories\Criteria\FieldLike;
use App\Repositories\Criteria\Employee\RoleCriteria;
use App\Repositories\Criteria\Order;

class EmployeeService
{
    private $repository = null;

    private $request = null;
    private $model = null;
    private $typeArray=[
                    ['id'=>'1',  'value'=> 'account'],
                    ['id'=> '2', 'value'=> 'realname'],
                    ['id'=> '3', 'value'=> 'mobilephone'],
                    ['id'=> '4', 'value'=> 'qq'],
                    ['id'=> '5', 'value'=> 'weixin']
                ];
    public function  __construct(EmployeeRepository $repositiry, Request $request,User $user)
    {
        $this->repository = $repositiry;
        $this->request = $request;
        $this->model = $user;
    }
    public function getData()
    {
        $fields=['user_basic.*','roles.display_name as role_name','department_basic.name as department_name','group_basic.name as group_name'];
        $where=[];
        if($this->request->has('type')){
            $where[]=['department_basic.type','=',$this->request->type];
        }
        if($this->request->has('department_id')){
            $where[]=['user_basic.department_id','=',$this->request->department_id];
        }
        if($this->request->has('group_id')){
            $where[]=['user_basic.group_id','=',$this->request->group_id];
        }
        if($this->request->has('typeNumber') && $this->request->has('typeValue')){
            foreach ($this->typeArray as $k => $v){
                if($v['id'] == $this->request->typeNumber){
                    $where[]=[$v['value'],'=',$this->request->typeValue];
                }
            }
        }
        $result =$this->model
            ->join('department_basic','department_basic.id','=','user_basic.department_id')
            ->join('group_basic','group_basic.id','=','user_basic.group_id')
            ->join('roles','roles.id','=','user_basic.role_id')
            ->whereNull('user_basic.deleted_at')
            ->whereNull('department_basic.deleted_at')
            ->whereNull('group_basic.deleted_at')
            ->where($where)
            ->select($fields)
            ->get();
        $count =$this->model
            ->join('department_basic','department_basic.id','=','user_basic.department_id')
            ->join('group_basic','group_basic.id','=','user_basic.group_id')
            ->join('roles','roles.id','=','user_basic.role_id')
            ->whereNull('user_basic.deleted_at')
            ->whereNull('department_basic.deleted_at')
            ->whereNull('group_basic.deleted_at')
            ->where($where)
            ->select($fields)
            ->count();
        $users=[];
        foreach ($result as $v){
            $users[$v->id]=$v;
        }
        return [
            'users'=>$users,
            'items'=>$result,
            'total'=>$count
        ];
    }
    
    /**
     * @todo depart-candidate 替换成常量
     * @return unknown[]|NULL[]
     */
    public function  get()
    {
        if (!$this->request->has('orderField')) {
            $this->repository->pushCriteria(new OrderByIdDesc());
        } else {
            $this->repository->pushCriteria(new Order($this->request->input("orderField"), $this->request->input("orderWay", "desc")));
        }
        
        
        if ($this->request->has('status') && $this->request->input('status') == -1) {
            $this->repository->pushCriteria(new OnlyTrashed());
        }
        
        if ($this->request->has('group_id')) {
        	$this->repository->pushCriteria(new Group($this->request->input('group_id')));
        }
        
        if ($this->request->has('department_id')) {
            $this->repository->pushCriteria(new Department($this->request->input('department_id')));
        }
        
        if ($this->request->has('typeNumber') && 
        	$this->request->has('typeValue') ){
        	$this->repository->pushCriteria(
        			new FieldLike($this->request->input('typeNumber'), $this->request->input('typeValue'))
        	);
        }
        
        if ($this->request->has('role')) {
        	$this->repository->pushCriteria(new RoleCriteria($this->request->input('role')));
        }
        
        if ($this->request->has('with')) {
        	$this->repository->with($this->request->input('with'));
        } else {
        	$this->repository->with(['department','group','roles']);
        }
        
        $selects = $this->request->has('fields') ? $this->request->input('fields') : ['*'];
        
        $re = $this->repository->paginate($this->request->input('pageSize',20), $selects);
        $collection  = $re->getCollection();
        
//         dd($collection);
        if (in_array('deleted_at', $selects)) {
        	ModelCollection::setVisible($collection, ['deleted_at']);
        }
        $users=[];
        foreach ($collection as $v){
            $users[$v->id]=$v;
        }
        return [
        	'items'=>$collection,
//             'users'=>$users,
            'total'=>$re->total()
        ];
        //下面的参考一下。字段没加全
//         return [
//             'items'=>[
//                 [
//                     'id'=> 1,
//                     'account'=> 'gfsdg',
//                     'realname'=> 'gsggs',
//                     'department_name'=>'hdfhd',
//                     'head'=>'gdfg',
//                     'qq'=> 'gdfh',
//                     'role'=> 'ndfhdf',
//                     'sex'=> '男' || '女',
//                     'phone'=> '132465465',
//                     'mphone'=> '23131',
//                     'remark'=>'hdghdf',
//                     'status'=>'hdfhd',
//                     'id_card'=>'dfjkhg',
//                     'qq_nickname'=>'fghdf',
//                     'weixin'=>'jfdj',
//                     'weixin_nikname'=>'kldfhgkdf',
//                     'address'=>'jfgjf',
//                     'ip'=>'192.168.0.10',
//                     'location'=>'ohigfdgjk',
//                     'lg_time'=>'2017-12-02',
//                     'out_time'=>'2017-12-02',
//                     'created_at'=>'2017-12-02',
//                     'creator'=>'fjkgjkf',
//                 ]
//             ],
//             'total'=>400
//         ];
    }
}
