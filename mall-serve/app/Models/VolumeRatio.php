<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VolumeRatio extends Model
{
    use SoftDeletes;

    protected $table = 'volume_ratios';


    protected $dates = [
        'deleted_at'
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];
    protected $fillable = [
        'frame_ratio',
        'volume_ratio',
        'id'
    ];

}
