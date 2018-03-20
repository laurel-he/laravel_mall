<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'group_basic';
    
    /**
     * 需要被转换成日期的属性。 softdelete 需要
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
    
    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    
    
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'manager_id',
        'department_id',
        'status',
        'remarks'
    ];
    
    protected $appends = [
//         'user',
//         'phone',
//         'departmentname',
    ];
    
    /**
     * 获得联系人姓名
     */
    public function getUserAttribute()
    {
        // return $this->manager->realname;
        return '未实现';
    }
    
    /**
     * 获得联系人电话
     */
    public function getPhoneAttribute()
    {
        // return $this->manager->phone;
        return '8080850';
    }
    
    /**
     * 获得联系人电话
     */
    public function getDepartmentnameAttribute()
    {
        // return $this->manager->phone;
        // return 'xx部';
        return $this->department->name;
    }
    
    public function  department() 
    {
        return $this->belongsTo('App\Models\Department', 'department_id')->select(['id','name']);
    }
    
    public function manager()
    {
    	return $this->belongsTo('App\Models\User', 'manager_id')->select(['id','realname', 'mobilephone']);
    }
    
    public function users()
    {
    	return $this->hasMany('App\Models\User', 'group_id')->select(['id','realname','group_id']);
    }
}
