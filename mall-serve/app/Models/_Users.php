<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Users extends Model
{
    //
    use SoftDeletes;
    protected $table = 'users';
    /**
     * 需要被转换成日期的属性。 softdelete 需要
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
        'order_sn',
        'order_status',
        'o_shop',
        'goods_name',
        'order_status',
        'shipping_status',
        'check_status'
    ];
    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    protected $appends = [

    ];
    private static $status = array(
        'pre_pay'       =>   '未付款',
        'pre_affirm'    =>   '待确认',
        'done'          =>   '已完成',
        'closed'        =>   '已关闭',
        'refund'        =>   '退款中'
    );
    private static $s_status = array(
        'pre_deliver'   =>   '待发货',
        'delivered'     =>   '发货中',
        'received'      =>   '已收货',
    );
    private static $c_status = array(
        '未通过',
        '已通过',
        '未审核'
    );
    public static function getStatus($index = null,$status = array())
    {
        if ($index === null) {
            return $status;
        } else
            if (isset($index) && in_array($index, array_keys($status))) {
                return $status[$index];
            }
        $key = array_keys($status);
        return $status[$key[0]];
    }
    /*
     * 生成订单类型对应的汉字文本
     */
    public function getOrderStatusAttribute()
    {
        return self::getStatus($this->attributes['order_status'],self::$status);
    }
    /*
     * 生成发货类型对应的汉字文本
     */
    public function getShippingStatusAttribute()
    {
        return self::getStatus($this->attributes['shipping_status'],self::$s_status);
    }
    /*
     * 生成审核状态对应的汉字文本
     */
    public function getCheckStatusAttribute()
    {
        return self::getStatus($this->attributes['check_status'],self::$c_status);
    }
    public function getOrderTypeAttribute()
    {
        return '1';
    }
    
    
}
