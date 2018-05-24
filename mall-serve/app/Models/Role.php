<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\Builder;

/**
 * @var string name 角色的唯一名称，如"admin","owner"
 * @var string display_name 人类可读的角色名
 * @var string description 角色详细描述 
 * @author hyf
 *
 */
class Role extends EntrustRole
{
    public static $roles = [
        //隐藏角色
        [
            'name'=> 'group-member',
            'display_name' => '小组成员',
            'description' => '隐藏角色 所有的小组成员都会有',
            'hidden' => 1
        ],
        [
            'name' => 'department-manager',
            'display_name' => '部门经理',
            'description' => '隐藏角色 所有的经理都会有的',
            'hidden' => 1
        ],
        [
            'name' => 'group-captain',
            'display_name' => '小组主管',
            'description' => '隐藏角色 所有的主管都会有',
            'hidden' => 1,
        ],
        [
            'name' => 'sale-department-member',
            'display_name' => '销售部参与销售员工',
            'description' => "隐藏角色 所有有自己的客户的员工都会有",
            'hidden' => 1,
        ],
        
        
        //显示角色
        [
            'name' => 'administrator',
            'display_name' => '超级管理员',
            'description' => '最牛B的人了'
        ],
        [
            'name' => 'super-manager',
            'display_name' => '总经办管理员',
        ],
        [
            'name' => "sale-manager",
            'display_name' => "销售经理",
        ],
        [
            'name' =>  "sale-captain",
            'display_name' => '销售主管'
        ],
        [
            'name' => 'sale-staff',
            'display_name' => '销售员工'
        ]
    ];
    
    /**
     * 角色的关联
     * 显示角色包含隐藏角色
     * @var array
     */
    public static $roleRelative = [
        'sale-manager'=>[
            'group-member',
            'department-manager',
            'sale-department-member'
        ],
        'sale-captain'=>[
            'group-captain',
            'sale-department-member'
        ],
        'sale-staff' => [
            'group-member',
            'sale-department-member'
        ],
        'assign-manager' => [
            'group-member',
            'department-manager',
            'assign-department-member'
        ],
        'assign-captain' => [
            'group-captain',
            'assign-department-member'
        ],
        'assign-staff' => [
            'group-member',
            'assign-department-member'
        ]
    ];
    
    public static function getRelative($name) 
    {
        if (isset(self::$roleRelative[$name])) {
            return self::$roleRelative[$name];
        }
        return null;
    }
    
    public static function boot()
    {
        parent::boot();
        
        //User::withoutGlobalScope('hide');
        static::addGlobalScope('hide', function(Builder $builder){
            $builder->where('hidden', 0);
        });
    }
}
