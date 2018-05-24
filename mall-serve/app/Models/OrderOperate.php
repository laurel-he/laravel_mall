<?php
/**
 * 订单操作记录类
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderOperate extends Model
{
    
    const ACTION_CREATE = '创建订单';
    const ACTION_EDIT = '编辑订单';
    const ACTION_CANCEL = '取消订单';
    const ACTION_PASSED = '订单审核通过';
    const ACTION_UNPASSED = '订单审核不通过';
    
    const ACTION_FINISH = '订单完成';
    
    
    use SoftDeletes;
    
    protected $table = 'operate_order_record';
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'action_name',
        'user_name',
        'user_id',
        'remark',
        'order_id'
    ];
    
    
    
    
}
