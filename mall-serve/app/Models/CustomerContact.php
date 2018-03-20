<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerContact extends Model
{
    use SoftDeletes;

    /**
     * 软删除需要设置这个
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'customer_contact';
    
    protected $fillable=[
        'cus_id',
        'phone',
        'qq',
        'qq_nickname',
        'weixin',
        'weixin_nickname'
    ];
    
    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];
}
