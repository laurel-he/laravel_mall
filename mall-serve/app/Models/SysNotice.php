<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SysNotice extends Model
{
    //
    use SoftDeletes;

    protected $table= 'sys_notices';

    protected $fillable = [
                'title',
                'user_id',
                'type_id',
                'start_time',
                'end_time',
                'content',
            ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
