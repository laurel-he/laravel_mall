<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpressInfo extends Model
{
    use SoftDeletes;

	protected $table = 'express_info';
	/**
	 * 需要被转换成日期的属性。
	 *
	 * @var array
	 */
	protected $dates = [
			'deleted_at',
			'express_time'
	];
	
	
	
	protected $fillable=[
			'cus_id',
			'order_sn',
			'express_sn',
			'express_name',
			'express_status',
			'express_time',
			'consignee',
			'express_phone',
			'address',
			'order_time',
			'express_remark',
			'creator',
			'creator_id',
	];

    private static $expressStatus = array(
        '未发货',
		'运输中',
		'待签收',
		'已签收'
    );
     
    public static function getExpressStatus($index = null)
    {
        if ($index === null) {
            return self::$expressStatus;
        } else if (is_numeric($index) && in_array(intval($index), array_keys(self::$expressStatus))) {
            return self::$expressStatus[$index];
        }
        return self::$expressStatus[0];
    }
    
    

    







}
