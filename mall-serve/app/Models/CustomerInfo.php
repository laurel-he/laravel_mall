<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    /**
     * 这是个视图 
     * @var string
     */
    protected $table = 'customer_info';
    
    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];
    
    
    /**
     * 生成类型对应的汉字文本
     */
    public function getTypeTextAttribute()
    {
        return CustomerApp::getType($this->attributes['type']);
    }
    
    /**
     * 生成性别对应的汉字
     */
    public function  getSexTextAttribute() 
    {
        if ($this->attributes['sex'] == 0) {
            return '未定义';
        }
        return $this->attributes['sex'] == '1' ? '男' : '女';
    }
    
    /**
     * 生成推荐对应的汉字
     */
    public function  getRecommendTextAttribute()
    {
        
        return $this->attributes['recommend'] == '1' ? '是' : '否';
    }
    
    
    /**
     * 联系方式
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function  contacts()
    {
        return $this->hasMany('App\Models\CustomerContact', 'cus_id')
                    ->orderBy('id','asc');
    }
    
    
    
}
