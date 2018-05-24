<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerBasic extends Model
{
    use SoftDeletes;

    /**
     * 软删除需要设置这个
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'customer_basic';

    /**
     * 批量赋值白名单
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'sex',
        'age',
        
        'type',
        'source',
        'area_province',
        'area_city',
        'id_card',
        'cus_address',
        'hobby',
        'commonly_production',
        'remark',
//        'source',
//        'property',
//        'province',
//        'city',
//        'creator',
//        'quality',
//        'proceeds',
//        'manner',
//        'vigour',
//        'question',
//        'profit',
//        'attritude',
//        'occupation',
//        'desire'
        
    ];
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    
    public function  contacts() 
    {
        return $this->hasMany('App\Models\CustomerContact', 'cus_id');
    }
    
    public function  users(){
    	return $this->belongsToMany('App\Models\User', 'customer_user', 'cus_id', 'user_id');
    }
    
    public function midRelative(){
    	return $this->hasOne('App\Models\CustomerUser', 'cus_id');
    }
    
    
    
    public function getSexTextAttribute()
    {
    	return $this->attributes['sex'] == 0 ? '未定义' : $this->attributes['sex'] == 1 ? '男' : '女';
    }
    
    /**
     * 生成类型对应的汉字文本
     */
    public function getTypeTextAttribute()
    {
        return CustomerApp::getType($this->attributes['type']);
    }
    
    public function setV()
    {
        $this->type = 'V';
    }
}
