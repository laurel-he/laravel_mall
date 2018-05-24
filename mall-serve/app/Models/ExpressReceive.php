<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpressReceive extends Model
{
    use SoftDeletes;
    protected $table ='express_receives';
    protected $fillable=[
        'express_id',
        'express_name',
        'assign_sn',
        'express_sn',
        'assign_check_time',
        'check_user_id',
        'check_user_name',
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = [
        'deleted_at'
    ];
}
