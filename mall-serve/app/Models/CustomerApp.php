<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerApp extends Model
{
    use SoftDeletes;
    
    /**
     * 客户来源类型
     * 0 自锁 
     * 1 分配 
     * 2 转让 
     * 3 索取 
     * 4 接盘（离职客户转让）
     */
    const SOURCE_TYPE_SELF = 0;
    const SOURCE_TYPE_DISTRIBUTE = 1;
    const SOURCE_TYPE_TRANSFER = 2;
    const SOURCE_TYPE_PULL = 3;
    const SOURCE_TYPE_SECONDHAND = 4;

    /**
     * 软删除需要设置这个
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'customer_app';

    /**
     * 批量赋值白名单
     * 
     * @var array
     */
    protected $fillable = [
        'cus_id',
        'type',
        'creator_id'
    ];

    /**
     * 重定义主键
     * 
     * @var string
     */
    protected $primaryKey = 'cus_id';

    /**
     * 定义主键不自增
     * 
     * @var string
     */
    public $incrementing = false;

    //客户类型
    private static $type = [
        "A" => "A.准客户",
        "B" => "B.意向客户",
        "C" => "C.一般客户",
        "D" => "D.未有意向客户",
        "F" => "F.黑名单",
        "N" => "N.无效客户",
        "V" => "V.成交客户",
//         "PV"=> "PV.预成交客户",
        // "VX"=>"审核未通过", 这个考虑添加 审核 字段
        // "VT"=>"有意见并投诉" 这个考虑添加 投诉 字段
    ];
    //客户来源
    private static $source = [
        '1'=>"东方财富",
        '2'=>"今日头条",
        '3'=>"新浪财经",
        '4'=>"企鹅 QQ公众平台",
        '5'=>"一点资讯",
        '6'=>"搜狐",
        '7'=>"微博",
        '8'=>"百度",
        '9'=>"同花顺",
        '10'=>"和讯",
        '11'=>"其他",
    ];

    //投诉类型
    private static $complainType = [
        '1'=>"一般投诉",
        '2'=>"工单投诉",
        '3'=>"外诉倾向",
        '4'=>"其他投诉",

    ];

    //获取客户类型
    public static function getType($index = null)
    {
        if ($index === null) {
            return self::$type;
        } else if (in_array($index, array_keys(self::$type))) {
            return self::$type[$index];
        }
        return self::$type['C'];
    }

    //获取客户来源
    public static function getSource($index = null){
        if(is_numeric($index)){
            return isset(self::$source[$index]) ? self::$source[$index] : '未定义';
        }else{
            return self::$source;
        }
    }

    //获取投诉类型
    public static function getComplainType($index = null){
        if(is_numeric($index)){
            return isset(self::$complainType[$index]) ? self::$complainType[$index] : '未定义';
        }else{
            return self::$complainType;
        }
    }




}
