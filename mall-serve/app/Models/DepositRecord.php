<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositRecord extends Model
{
    use SoftDeletes;
    
    const APP_EVENT_ORDER_PASS = '订单审核通过';
    
    protected $table = 'deposit_record';
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'user_id' ,
        'target_id' ,
        'event_type' ,
        'money',
        'brief'
    ];
    
}
