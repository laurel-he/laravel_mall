<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DistributionCenter extends Model
{
    use SoftDeletes;
    protected $table = 'entrepot_basic';
    protected $dates = [
        'deleted_at'
    ];
    protected $fillable=['name','eng_name','contact','contact_phone','address','comment'];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

}
