<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerTrackLog extends Model
{
    use SoftDeletes;

    protected $table = 'customer_log';

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable=[
        'cus_id',
        'user_id',
        'content',
        'user_name',
        'cus_name',
    ];
    
    
    
    
}
