<?php

use Illuminate\Database\Seeder;
use App\Events\AddEmployee;
use App\Models\Role;

class UserTableSeeder2 extends Seeder
{
	static $roleNames = ['sale-staff', 'sale-captain', 'sale-manager'];
    /**
     * 生成部门 小组 员工数据
     * 
     * @return void
     */
    public function run()
    {
    	$role_name = self::$roleNames;
        factory(App\Models\User::class, 10)->create()
        ->each(function($u)use($role_name){
        	$index = array_rand($role_name);
        	$role = Role::where('name',  $role_name[$index])->firstOrFail();
            event( new AddEmployee($u, [$role->id]));
        });
    }
}
