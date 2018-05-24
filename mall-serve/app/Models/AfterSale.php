<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AfterSale extends Model
{
    use SoftDeletes;
    
    
    const RETURN_BACK = 0;
    const EXCHANGE_GOODS  = 1;
    
    protected $table = 'order_after_sale';
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'cus_id',
        'order_id',
        'user_id',
        'user_name',
        'group_id',
        'department_id',
        'type',
        'check_status',
        'check_remark',
        'remark',
        'refund',
        'entrepot_id'
    ];
    
    
    
    public function goods()
    {
        return $this->hasMany('App\Models\AfterSaleGoods', 'after_sale_id');
    }

    public function express()
    {
        return $this->hasMany('App\Models\AfterSaleExpress', 'after_sale_id');
    }
    
    public function order()
    {
        return $this->belongsTo('App\Models\OrderBasic', 'order_id');
    }
    
    public function getCheckStatusTextAttribute()
    {
        $map = ['待审核', '通过', '不通过'];
        return $map[$this->attributes['check_status']];
    }
    
    public function getTypeTextAttribute()
    {
        $map = ['退货', '换货'];
        return $map[$this->attributes['type']];
    }
}
