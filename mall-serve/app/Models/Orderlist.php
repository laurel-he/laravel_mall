<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class Orderlist extends Model
{
    //
    use SoftDeletes;
    protected $table = 'order_basic';
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
        'cus_id',
        'cus_name',
        'deal_id'
    ];
    protected $appends = [
        'cus_name',
        'user_name',
    ];
    /**
     * 根据用户id获取用户姓名
     *
     */
    public function get_cusinfo(){
        $customer = DB::table('customer_basic')->select('name', 'id')->get();
        $newarray = array();
        $customer = collect($customer);
        $customer = $customer->toArray();
        $new_cus = array();
        foreach ($customer as $v)
        {
            $v = collect($v);
            $new_cus[] = $v->toArray();
        }
        foreach ($new_cus as $v)
        {
            $id = $v['id'];
            $name = $v['name'];
            $newarray[$id] = $name;
        }
        return $newarray;
    }
    /**
     * 根据员工id获取员工姓名
     *
     */
    public function get_employeeinfo(){
        $employee = DB::table('user_basic')->select('realname', 'id')->get();
        $newarray = array();
        $employee = collect($employee);
        $employee = $employee->toArray();
        $new_em = array();
        foreach ($employee as $v)
        {
            $v = collect($v);
            $new_em[] = $v->toArray();
        }
        foreach ($new_em as $v)
        {
            $id = $v['id'];
            $name = $v['realname'];
            $newarray[$id] = $name;
        }
        return $newarray;
    }
    public static function getType($index = null,$types)
    {
        if ($index === null) {
            return $types;
        } else
            if ($index && in_array($index, array_keys($types))) {
                return $types[$index];
            }
        return $types;
    }
    /*
     * 获取客户的姓名
     */
    public function getCusNameAttribute()
    {
        return self::getType($this->attributes['cus_id'],$this->get_cusinfo());
    }
    /*
     * 获取员工的姓名
     */
    public function getUserNameAttribute()
    {
        return self::getType($this->attributes['deal_id'],$this->get_employeeinfo());
    }
    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['updated_at','deleted_at'];

}
