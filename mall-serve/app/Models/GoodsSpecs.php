<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsSpecs extends Model
{
    use SoftDeletes;
    
    protected $table = 'goods_specs';

    protected $dates = [
    		'delete_at'
    ];
    
    
	protected $casts = [
			'add_value' => 'array'
	];
	
	protected $fillable = [
			'name',
			'type',
			'add_value'
	];
}
