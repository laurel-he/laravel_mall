<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkinCateInfo extends Model
{
    use SoftDeletes;
    protected $table = 'skin_cate_info';
    protected $dates = [
        'deleted_at'
    ];
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [
        'problem_one',
        'problem_two',
        'problem_three',
        'problem_four',
        'problem_five',
        'contact_phone',

    ];
}
