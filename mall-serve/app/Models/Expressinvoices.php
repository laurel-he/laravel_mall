<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * 快递单号
 * @author hyf
 *
 */
class Expressinvoices extends Model
{
    use SoftDeletes;
    
    protected $dates =['deleted_at'];
    protected $table='express_invoices';
   
    protected $fillable = [
        'sn',
        'express_sn',
        'express_name',
        'user_name',
        'express_at',
        'deliver_name',
        'deliver_phone',
        'deliver_address',
        'goods',
        'create_by'
    ];
    
    
    public static function getCount()
    {
        return self::withTrashed()->count();
    }
    public function setSn($en)
    {
        $c = self::getCount();
        $this->attributes['sn'] = $en. sprintf("%08d", ++$c) ;
    }
}
