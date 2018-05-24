<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShelvesManagement extends Model
{
    //
    use SoftDeletes;
    protected $table='shelves_managements';
    protected $fillable=[
        'shelves_name',
        'shelves_status',
        'shelves_num',
        'distributor_id',
        'distributor_name',
        'shelves_manager_id',
        'shelves_manager_name',
        'remark',
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $dates = [
        'deleted_at'
    ];


}
