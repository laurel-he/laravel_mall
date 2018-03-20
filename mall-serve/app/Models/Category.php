<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table="category_base";
    protected $fillable = [
        'label',
        'pid',
        'level',
        'type_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    /**
     * 
     */
    public function goods()
    {
    	return $this->belongsToMany('App\Models\Goods', 'goods_categories',  'cate_id', 'goods_id');
    }
}
