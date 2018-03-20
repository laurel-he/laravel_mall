<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerSpreadperson extends Model
{
    use SoftDeletes;

    protected $table = 'customer_spreadpeople';
    /**
     * 软删除需要设置这个
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
    
    /**
     * 批量赋值属性
     * @var array
     */
    protected $fillable = ['type', 'user_id', 'cus_id', 'from_id'];

    private static $type = [
        "自锁",
        "分配",
        "转让", // 这个估计不会用到 但是占个位子 让索引值保持与 sale 的一致
        "索取",
        "接盘"
    ];

    public static function getType($index = null)
    {
        if ($index === null) {
            return self::$type;
        } else 
            if (is_numeric($index) && in_array(intval($index), array_keys(self::$type))) {
                return self::$type[$index];
            }
        return self::$type[0];
    }
}
