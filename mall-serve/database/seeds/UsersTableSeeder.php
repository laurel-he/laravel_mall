<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Events\AddEmployee;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//         $id = DB::table('user_basic')->insertGetId([
//             'account'=>'admin',
//             'password'=>bcrypt('123456')
//         ]);
        $adminRole = Role::where('name', '=','administrator')->firstOrFail();
        if (!$adminRole) {
            echo 'not ';
        }
        
        $userRow = [
            'account'=>'admin', 
            'password'=> bcrypt('123456'),
        	'realname' => '系统管理员'
//             'role_ids'=>[$adminRole->id]
        ];
        $user = User::create($userRow);
        
        event(new AddEmployee($user, [$adminRole->id]));
        
//         $user->attachRole($adminRole);
//         $user->roles()->attach($adminRole->id); 
        
        
    }
}
