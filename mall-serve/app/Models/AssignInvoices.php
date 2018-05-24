<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignInvoices extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    protected $table = 'assign_invoices';
    
    protected $fillable = [
        'sn',
        'entrepot_name',
        'user_name',
        'assign_sn',
        'assign_at',
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
