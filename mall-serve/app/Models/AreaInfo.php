<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaInfo extends Model
{
    use SoftDeletes;

    protected $table = 'area_info';

    protected $dates = [
				'delete_at'
		];
    
    protected $hidden = ['type'];
}
