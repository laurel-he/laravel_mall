<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * 
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
            'human-resources',
            'assign-manager',
            'assign-captain',
            'assign-staff',
            'assign-service',
            'assign-buyer',
            'assign-buyer-manager'
        ],
//         'sale-manager' => [
//             'sale-captain',
//             'sale-staff', 
//         ]
    ];
    
    public static $departAssignableMap = [
      //type = 0
        [
          'sale-captain',
          'sale-staff', 
          'human-resources'
        ],
        //type=1
        [
            'assign-manager',
            'assign-captain',
            'assign-staff',
            'assign-service',
            'assign-buyer',
            'assign-buyer-manager'
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
        /**
         * 是不是　管理员　？
         * 是　按管理员的
         * 不是　按部门的
        */
        $user = Auth::user();
        logger("[debug2]", [$user->isSuperAdmin() or $user->isAdministrator()]);
        if ($user->isSuperAdmin() or $user->isAdministrator()) {
            $roles = $user->getRoles(false);
            
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
        } else {
            $department = $user->department;
            if ($department) {
                return [
                    "items"=> Role::whereIn('name', self::$departAssignableMap[$department['type']])->get()
                ];
            } else {
                return [
                    'items' => []
                ];
            }
        }
    	
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
