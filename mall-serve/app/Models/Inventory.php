<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
	//
	use SoftDeletes;
	
	protected $table = 'inventory_basic';
	
	/**
	 * 需要被转换成日期的属性。 softdelete 需要
	 *
	 * @var array
	 */
	protected $dates = [
			'deleted_at'
	];
	
	
	protected $fillable = [
		'goods_type',	
		'goods_name',	
		'goods_sum',	
		'goods_version',	
		'goods_batch',	
		'type',	
		'create_time',	
		'user_id',	
		'user',	
		'order_sn'
	];
	
	private static $types = [
			'1'=>'入库',
			'2'=>'出库'
	]; 
	
	public function getTypeTextAttribute(){
		return self::getType($this->attributes['type']);
	}
	
	public static function getType($index){
		return self::$types[$index];
	}
}
