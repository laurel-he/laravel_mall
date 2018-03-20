<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use SoftDeletes;
    
    
    protected $table = 'deposit_basic';
    
    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = [
    		'deleted_at'
    ];
    
    
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [
    		'department_id',
    		'group_id',
    		'user_id',
    		'department_name',
    		'group_name',
    		'realname',
    		'money',
    		'creator_id',
    		'creator',
    		'charge_department',
    		'charge_type',
    		'charge_time',
    		'remark',
    ];
}
