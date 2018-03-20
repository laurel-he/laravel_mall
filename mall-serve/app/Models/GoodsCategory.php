<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodsCategory extends Model
{
    
    
    protected $table="goods_categories";

	  protected $fillable = [
					'goods_id',
					'cate_id',
	  ];




}
