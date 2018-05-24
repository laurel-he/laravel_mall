<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class AssignRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //经理、主管、员工、客服 采购员　采购经理
        $administrator = new Role();
        $administrator->name = 'assign-manager';
        $administrator->display_name = '配送经理';
        $administrator->description = '配送部';
        $administrator->save();
        
        $administrator1 = new Role();
        $administrator1->name = 'assign-captain';
        $administrator1->display_name = '配送主管';
        $administrator1->description = '配送部主管';
        $administrator1->save();
        
        $administrator2 = new Role();
        $administrator2->name = 'assign-staff';
        $administrator2->display_name = '配送员工';
        $administrator2->description = '配送部员工';
        $administrator2->save();
        
        $administrator3 = new Role();
        $administrator3->name = 'assign-service';
        $administrator3->display_name = '配送客服';
        $administrator3->description = '配送部客服';
        $administrator3->save();
        
        $administrator4 = new Role();
        $administrator4->name = 'assign-buyer';
        $administrator4->display_name = '采购员';
        $administrator4->description = '配送部采购员';
        $administrator4->save();
        
        $administrator5 = new Role();
        $administrator5->name = 'assign-buyer-manager';
        $administrator5->display_name = '采购经理';
        $administrator5->description = '配送部采购经理';
        $administrator5->save();
        
        //隐藏角色
        $administrator6 = new Role();
        $administrator6->name = 'assign-department-member';
        $administrator6->display_name = '配送部成员';
        $administrator6->description = '配送部成员';
        $administrator6->hidden = 1;
        $administrator6->save();
    }
}
