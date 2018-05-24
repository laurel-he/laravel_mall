<?php
namespace App\Services\Customer;

use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use App\Alg\ModelCollection;
use App\Models\CustomerBasic;
use App\Models\CustomerContact;
use App\Events\SetCustomerUser;
use App\Models\CustomerUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Repositories\Criteria\Customer\UserCriteria;
use App\Repositories\Criteria\Customer\Relative;
use App\Repositories\Criteria\Customer\Phone;
use App\Repositories\Criteria\Customer\Name;
use App\Repositories\Criteria\Customer\Qq;
use App\Repositories\Criteria\Customer\Weixin;
use App\Repositories\Criteria\FieldEqual;
use App\Repositories\Criteria\Customer\Contact;
use App\Repositories\Criteria\OrderByIdDesc;
use Illuminate\Support\Facades\DB;
use App\Repositories\Criteria\FieldLike;

class CustomerService
{
    private $repository = null;
    private $request = null;
    private $customer_basic = null;
    private $customer_contact = null;
    
    public function  __construct(CustomerRepository $repository,CustomerBasic $customerBasic,CustomerContact $customerContact ,Request $request) 
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->customer_basic = $customerBasic;
        $this->customer_contact = $customerContact;
    }
    
    public function  get()
    {

//        $selectFields = ['id','name','type','sex','recommend'];

        
        if (!$this->request->has('orderField')) {
            $this->repository->pushCriteria(new OrderByIdDesc());
        }

    	if ($this->request->has('with')) {
    		$with = $this->request->input('with');
    		$nWith = [];
    		foreach ($with as $key => $item) {
    			if ($item == 'midRelative') {
    				$nWith[$item] = function($query){
    					$query->with(['group','department']);
    				};
    			} else {
    				$nWith[] = $item;
    			}
    		}
    		$this->repository->with($nWith);
    	}
    	
    	//relative 
    	//FIXME 这里逻辑好像有问题 relatives 不应该出现
//     	$relatives = ['department_id','group_id','user_id'];
//     	foreach ($relatives as $value) {
//     		if ($this->request->has($value)) {
//     			$this->repository->pushCriteria(new Relative($this->request->input($value), $value));
//     		}
//     	}
        
    	$this->repository->pushCriteria(new Relative($this->request));
    	
        
//         if ($this->request->has('phone')) {
//             $this->repository->pushCriteria(new Phone($this->request->input('phone')));
//         }
//         if ($this->request->has('qq')) {
//             $this->repository->pushCriteria(new Qq($this->request->input('qq')));
//         }
//         if ($this->request->has('weixin')) {
//             $this->repository->pushCriteria(new Weixin($this->request->input('weixin')));
//         }

    	if ($this->request->has('phone') || $this->request->has('qq') || $this->request->has('weixin')) {
    	    $this->repository->pushCriteria(new Contact($this->request));
        }
        
        if ($this->request->has('name')) {
            $this->repository->pushCriteria(new Name($this->request->input('name')));
        }
        if ($this->request->has('id')) {
            $this->repository->pushCriteria(new FieldEqual('id', $this->request->input('id')));
        }
        
        if ($this->request->has('id_card')) {
            $this->repository->pushCriteria(new FieldLike('id_card', $this->request->input('id_card')));//FieldEqual
        }
        
        if ($this->request->has('cus_address')) {
            $this->repository->pushCriteria(new FieldLike('cus_address', $this->request->input('cus_address')));
        }
        
        if ($this->request->has('type')) {
            $this->repository->pushCriteria(new FieldEqual('type', $this->request->input('type')));
        }

    	$selectFields = $this->request->has('fields') ? $this->request->input('fields'): ['*'];
        $result = $this->repository
                       ->paginate($this->request->input('pageSize', 20),$selectFields);
        
        $appends = [];
        if ($this->request->has('appends')) {
            $appends = $this->request->input('appends');
        }
        if (in_array('type', $selectFields) or in_array('*', $selectFields)) {
        	$appends[] = 'sex_text';
        }
        if (!empty($appends)) {
        	$collection = ModelCollection::setAppends($result->getCollection(), $appends);
        } else {
        	$collection = $result->getCollection();
        }
        return  [
            'items'=> $collection,
            'total'=> $result->total()
        ];

    }
    public  function  getData(){

        $where=[];
        if($this->request->has('name')){
            $where['customer_basic.name']=$this->request->name;
        }
        if($this->request->has('id')){
            $where['customer_basic.id']=$this->request->id;
        }
        if($this->request->has('phone')){
            $where['customer_contact.phone']=$this->request->phone;
        }
        $result= $this->customer_basic
            ->join('customer_contact','customer_basic.id','=','customer_contact.cus_id')
            ->where($where)
            ->whereNull('customer_basic.deleted_at')
            ->whereNull('customer_contact.deleted_at')
            ->get();
        $count= $this->customer_basic
            ->join('customer_contact','customer_basic.id','=','customer_contact.cus_id')
            ->where($where)
            ->whereNull('customer_basic.deleted_at')
            ->whereNull('customer_contact.deleted_at')
            ->count();
        return [
            'items'=>$result,
            'total'=>$count
        ];
    }
	/**
	 */
    public function storeData()
    {
        $model = $this->customer_basic->create($this->request->all());

        $data = $this->request->all();
        $data['cus_id'] = $model->id;
        $modelc = $this->customer_contact->create($data);

        //0 代表添加
        $user = Auth::user();
        event(new SetCustomerUser( $user, $model->id, CustomerUser::ADD));
        
        
        return $model;
    }

    public function upDate($id)
    {
        $this->customer_basic->where('id','=',$id)->update($this->request->all());
    }

    public function destroyData($id)
    {
        $this->customer_basic->destroy($id);
        $this->customer_contact->where('cus_id','=',$id)->delete();
    }
}
