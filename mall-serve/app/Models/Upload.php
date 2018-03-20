<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    //
    
    use SoftDeletes;
    
    protected $table= 'upload_resource';
    
    protected $dates=[
        'deleted_at'
    ];
    
    /**
     * 可以被批量赋值的属性
     */
    protected $fillable = [
        'user_id',
        'type',
        'file_name',
        'path',
        'url',
        'size'
    ];
    
    protected  $hidden = ['updated_at', 'deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\Models\Upload');    
    }
    
}
