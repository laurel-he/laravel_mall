<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartonManagement extends Model
{
    use SoftDeletes;
    protected $table = 'carton_management';

    protected $fillable = [
        'carton_name',
        'carton_model',
        'carton_long',
        'carton_wide',
        'carton_high',
        'carton_weight',
        'carton_number',
        'remark',
    ];
    /**
     * 在数组中想要隐藏的属性。
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

}
