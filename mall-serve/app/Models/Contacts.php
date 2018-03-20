<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    //
    use SoftDeletes;

    protected $table= 'contacts';

    protected $fillable = [
        'name',
        'user_id',
        'relationship_id',
        'phone',
        'qq',
        'weixin',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
