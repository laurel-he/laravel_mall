<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'department_basic';

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
        'name',
        'manager_id',
        'type',
        'status',
        'remarks',
        'entrepot_id'
    ];
    
    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    protected $appends = [
//         'type_text',
//         'user',
//         'phone'
    ];

    private static $types = array(
        '销售部',
        '推广部',
        '客服部',
//         '投顾部',
//         '风控部'
    );

    public static function getType($index = null)
    {
        if ($index === null) {
            return self::$types;
        } else 
            if (is_numeric($index) && in_array(intval($index), array_keys(self::$types))) {
                return self::$types[$index];
            }
        return self::$types[0];
    }

    /*
     * 生成类型对应的汉字文本
     */
    public function getTypeTextAttribute()
    {
        return self::getType($this->attributes['type']);
    }

    /**
     * 获得联系人姓名
     */
    public function getUserAttribute()
    {
        return '未实现';
    }

    /**
     * 获得联系人电话
     */
    public function getPhoneAttribute()
    {
        return '8080851';
    }
    
    public function manager()
    {
    	return $this->belongsTo('App\Models\User', 'manager_id')->select(['id','realname', 'mobilephone']);
    }
    
}
