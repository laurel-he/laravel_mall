<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class MakeRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make roles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('truncate table roles');
    
        //生成角色
        $administrator = new Role();
        $administrator->name = 'administrator';
        $administrator->display_name = '超级管理员';
        $administrator->description = '最牛B的人了';
        $administrator->save();
        
        $superViewer = new Role();
        $superViewer->name = 'super-manager';
        $superViewer->display_name = '总经办管理员';
        $superViewer->save();
        
        $saleManager = new Role();
        $saleManager->name = "sale-manager";
        $saleManager->display_name = "销售经理";
//         $saleManager->description = ""
        $saleManager->save();
        
        $saleCaptain =  new Role();
        $saleCaptain->name =  "sale-captain";
        $saleCaptain->display_name = '销售主管';
        $saleCaptain->save();
        
        $saleStaff = new Role();
        $saleStaff->name = 'sale-staff';
        $saleStaff->display_name = '销售员工';
        $saleStaff->save();
        
        
        
        //隐藏角色
        $groupMember = new Role();
        $groupMember->name = 'group-member';
        $groupMember->display_name = "小组成员";
        $groupMember->description = '隐藏角色 所有的小组成员都会有';
        $groupMember->hidden = 1;
        $groupMember->save();
        
        $departmentManger = new Role();
        $departmentManger->name = 'department-manager';
        $departmentManger->display_name = '部门经理';
        $departmentManger->description = '隐藏角色 所有的经理都会有的';
        $departmentManger->hidden = 1;
        $departmentManger->save();
        
        $groupCaptain = new Role();
        $groupCaptain->name = 'group-captain';
        $groupCaptain->display_name = '小组主管';
        $groupCaptain->description = '隐藏角色 所有的主管都会有';
        $groupCaptain->hidden = 1;
        $groupCaptain->save();
        
        $saleDepartmentMember = new Role();
        $saleDepartmentMember->name = 'sale-department-member';
        $saleDepartmentMember->display_name = '销售部参与销售员工';
        $saleDepartmentMember->description = "隐藏角色 所有有自己的客户的员工都会有";
        $saleDepartmentMember->hidden = 1;
        $saleDepartmentMember->save();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        
    }
}
