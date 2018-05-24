<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Communicate extends Model
{
    use SoftDeletes;
    protected $table="communicates";
    protected $fillable = [
        'communicate_time',
        'contact_content',
        'cus_name',
        'user_id',
        'assign_id',
        'user_name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
