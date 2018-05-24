<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerComplain extends Model
{
    use SoftDeletes;

    protected $table = 'customer_complain';

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable=[
        'cus_id',
        'user_id',
        'type',
        'content',
        'user_name',
        'cus_name',
    ];
}
