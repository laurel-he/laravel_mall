<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Customer\CustomerService;
use App\Models\CustomerUser;
use App\Models\CustomerApp;
use App\Models\User;
use App\Events\SetCustomerUser;
use Illuminate\Validation\ValidationException;
use App\Events\ContactConflict;

class CustomerController extends Controller
{
    private $service = null;
    private $request = null;

    public function  __construct(CustomerService $CustomerService) //Request $request
    {
        $this->service = $CustomerService;
//         $this->request = $request;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business = $request->query('business', 'default');
        $result = [];
        switch ($business) {
            case 'customerType':
                $result = CustomerApp::getType();
                break;
            case 'customerSource':
                $result = CustomerApp::getSource();
                break;
            case 'complainType':
                $result = CustomerApp::getComplainType();
                break;
            default:
                $result = $this->service->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
//         if (!$request->has('department_id')) {
//             return $this->error([], '未分配部门，你还不能添加');
//         }
        
        try {
            $this->validate($request, [
                'phone' => ['nullable','unique:customer_contact'],
                'qq' => ['nullable','unique:customer_contact'],
                'weixin' => ['nullable','unique:customer_contact'],
//                 'department_id' =>'required'
            ]);
        } catch (ValidationException $e) {
            event( new ContactConflict($e->validator->errors(), $request->only(['phone','qq','weixin'])));
            throw $e;
        }
        
        
        try {
           
            $this->service->storeData();
        } catch (Exception $e) {
            return $this->error(null, $e->getMessage());
        }
        
        return $this->success([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->service->upDate($id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroyData($id);

    }
    
    /**
     * 转让
     * @todo 转移代码到 service 层
     */
    public function transfer(Request $request)
    {
    	//user_id
    	//cus_ids
    	$from_id = $request->input('from_id');
    	if (!$from_id) {
    		return $this->error(0);
    	}
    	$user_id = $request->input('user_id');
    	if (!$user_id) {
    		return $this->error(0);
    	}
    	
    	if ($from_id == $user_id) {
    		return $this->error(0);
    	}
    	
    	
    	$userModel = User::select(['id','realname','group_id','department_id'])
    					   ->with(['group','department'])
    					   ->where('id', $user_id)
    					   ->first();
    	$cus_ids = $request->input('cus_ids');
    	foreach ($cus_ids as $id) {
//     		$model  = CustomerUser::where('cus_id', $id)->first();
    		event(new SetCustomerUser( $userModel ,$id, CustomerUser::TRANSFER) );
    	  
    	}
    	
    	return $this->success(1);
    }
    
    /**
     * 离职接收
     * @todo 转移代码到 service 层 需要重构
     */
    public function quitTransfer(Request $request)
    {

    	$user_ids= $request->input('user_ids');
    	if (empty($user_ids)) {
    		return $this->error();
    	}
    	$user_id = $request->input('to_id');
    	if (!$user_id) {
    		return $this->error(0, '目标用户');
    	}
    	
    	if (in_array($user_id, $user_ids)) {
    		return $this->error();
    	}
    	
    	$userModel = User::select(['id','realname','group_id','department_id'])
			    	->with(['group','department'])
			    	->where('id', $user_id)
			    	->first();
    	
    	foreach ($user_ids as $from_id) {
    		
    		$cus_ids = CustomerUser::where('user_id', $from_id)->pluck('cus_id');
    		if (empty($cus_ids)) {
    			continue;
    		}
    		foreach ($cus_ids as $id) {
                
    			event(new SetCustomerUser(
    			        $userModel,
    			        $id,
    					CustomerUser::QUIT ));
    			
    		}
    	}
    	
    	return $this->success(1);	
    }
}
