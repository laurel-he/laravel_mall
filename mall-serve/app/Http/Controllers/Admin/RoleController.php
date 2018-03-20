<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * 在添加员工的时候 允许设置的角色
     * 
     * @todo 做成一个管理界面
     * 
     * @var array
     */
    public static $assignableMap = [
        'administrator' => ['*'],
        'super-manager' => [
            'sale-manager', 
            'sale-captain', 
            'sale-staff', 
        ],
        'sale-manager' => [
            'sale-captain',
            'sale-staff', 
        ]
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Role::all();
        return [
            'items'=> $result,
            'total'=> count($result)
        ];
    }
    
    public function assignable()
    {
    	$roles = Auth::user()->getRoles(false);
//         $roles = User::find(1)->getRoles(false);
        
    	$names = array_column($roles->toArray(), 'name');
    	$assignable = [];
    	foreach ($names as $value) {
    	    if (isset(self::$assignableMap[$value])) {
    	        $assignable = array_merge($assignable, self::$assignableMap[$value]);
    	    }
    	}
    	
    	if (!in_array('*', $assignable)) {
    	    $query = Role::whereIn('name', $assignable);
    	} else {
    	    $query = Role::query(); // Role::on();
    	}
    	
    	
    	return [
    	    'items'=> $query->get()
    	];
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
