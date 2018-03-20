<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsDetails extends Model
{
	use SoftDeletes;

	protected $table = 'goods_basic';

  protected $fillable = [
				'goods_name',
				'goods_price',
				'goods_number',
				'unit_type',
				'description',
				'cover_url',
				'status',
  ];

	private static $unitTypes = array(
        '1'=>'瓶',
        '2'=>'套',
        '3'=>'盒',
        '4'=>'支',
        '5'=>'枚',
	);
	 
	public static function getUnitTypes($index = null)
	{
	    if ($index === null) {
	        return self::$unitTypes;
	    } else if (is_numeric($index) && in_array(intval($index), array_keys(self::$unitTypes))) {
	        return self::$unitTypes[$index];
	    }
	    return self::$unitTypes[1];
	}












}
