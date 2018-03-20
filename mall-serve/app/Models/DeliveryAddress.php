<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DeliveryAddress extends Model
{
    use SoftDeletes;
    protected $table = 'delivery_addresses';
    protected $dates = [
        'deleted_at'
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $fillable = [
        'name',
        'phone',
        'cus_id',
        'address',
        'zip_code',
        'default_address'
    ];
}
