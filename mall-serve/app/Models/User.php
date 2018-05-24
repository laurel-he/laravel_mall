<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use App\Events\AddEmployee;
/**
 * @author hyf
 *
 */
class User extends Authenticatable
{
    /**
     * 这将会建立User与Role之间的关联关系：
     * 在User模型中添加roles()、hasRole($name)、can($permission)
     * 以及ability($roles,$permissions,$options)方法
     */
    use Notifiable, SoftDeletes, EntrustUserTrait {
        EntrustUserTrait::restore insteadof SoftDeletes;
        
//         EntrustUserTrait::can as may;
//         Authorizable::can insteadof EntrustUserTrait;
    }
    
    use Notifiable;
    
    
    /**
     * 模型的事件映射
     * @var string
     */
    protected $event = [
//         'created' => AddEmployee::class
    ];
    
    
    
    protected $table="user_basic";


    protected $dates = [
        'deleted_at'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'head',
        'account',
        'password',
//         'role_ids',
        'group_id',
        'department_id',
        'sex',
        'telephone',
        'mobilephone',
        'realname',
        'address',
        'qq',
        'qq_nickname',
        'weixin',
        'weixin_nickname',
        'role_name',
        'id_card',
        'ip',
        'creator',
    	'creator_name',
        'location',
        'deposit_money',
        'card_img',
        'card_front',
        'card_back',

    ];
    protected $appends = [
//         'lg_time',
//         'out_time',
//         'roles'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'updated_at',
        'deleted_at'
    ];
    public function getLgTimeAttribute()
    {
        return '2018-01-11';
    }
    public function getOutTimeAttribute()
    {
        return '2018-01-11';
    }
    public function getRoleAttribute()
    {
        return '普通';
    }

    
    public function getRoles($withHidden = true)
    {
        $roles = $this->roles;
//         dd($roles);
        return $roles->filter( function($role) use($withHidden){
            if ($withHidden) {
                return true;
            } else {
                if ($role['hidden'] == 1) {
                    return false;
                } 
                return true;
            }
        });
    }
    
    public function isSuperAdmin()
    {
        $roles  = $this->roles;
        return $roles->contains('name','super-manager');
    }
    
    public function isAdministrator()
    {
        $roles  = $this->roles;
        return $roles->contains('name','administrator');
    }
    
    
    
    
    public function department(){
    	return $this->belongsTo('App\Models\Department','department_id');
    }
    
    public function group(){
    	return $this->belongsTo('App\Models\Group', 'group_id')->select(['id','name']);
    }
    
    public function roles(){
    	return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
//     				->withoutGlobalScope('hide');
    }
    
    public function midRole(){
    	return $this->hasMany('App\Models\RoleUser', 'user_id');
    }
    
    public function getEntrepotId()
    {
        
        return  $this->department_id == 0 ? 
        0 : 
        (empty($this->department->entrepot_id) ? 0 : $this->department->entrepot_id) ;
    }

    /**
     * 获取封面图片。
     *
     * @param  string  $value
     * @return string
     */
    public function getCardImgAttribute($value)
    {
        if($value){
            $value = asset($this->attributes['card_img']);
        }
        return $value;
    }

    public function getCardFrontAttribute($value)
    {
        if($value){
            $value = asset($this->attributes['card_front']);
        }
        return $value;
    }

    public function getCardBackAttribute($value)
    {
        if($value){
            $value = asset($this->attributes['card_back']);
        }
        return $value;
    }
    
}
