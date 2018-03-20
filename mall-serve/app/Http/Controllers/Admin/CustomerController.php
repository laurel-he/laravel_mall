<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Customer\CustomerService;
use App\Models\CustomerUser;
use App\Models\User;
use App\Events\SetCustomerUser;

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
    public function index()
    {

        return   $this->service->get();

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
    public function store()
    {
        $this->service->storeData();
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
    		return $this->error();
    	}
    	$user_id = $request->input('user_id');
    	if (!$user_id) {
    		return $this->error();
    	}
    	
    	if ($from_id == $user_id) {
    		return $this->error();
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
    	
    	return $this->success();
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
    					$id,
    					CustomerUser::QUIT,
    					$userModel->id,
    					$userModel->group_id,
    					$userModel->department_id,
    					$userModel->realname,
    					$userModel->group->name,
    					$userModel->department->name));
    			
    		}
    	}
    	
    	return $this->success(1);	
    }
}
