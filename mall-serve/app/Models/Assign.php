<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\AddAssign;
use App\Events\AssignCreating;

class Assign extends Model
{
    use SoftDeletes;
    
    protected $table = 'assign_basic';
    
    /**
     * 需要被转换成日期的属性。 softdelete 需要
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
    
    
    protected $fillable = [
        'entrepot_id',
        'assign_sn',
        'order_id',
        'user_id',
        'user_name',
        'status',
        'express_id',
        'express_name',
        'assign_print_status',
        'express_print_status',
        'set_express',
        'express_print_at',
        'assign_print_at',
        'weight',
        'assign_fee',
        'express_fee',
        'out_entrepot-at',
        'sign_at'
    ];
    
    protected $events = [
      'creating'=> AssignCreating::class  
    ];
    
    public function entrepot()
    {
        return $this->belongsTo('App\Models\DistributionCenter');
    }
    
    /**
     * 获取配货单数量
     * 注意要在事务里面使用
     * @static
     *
     * @param int $entrepot_id
     *
     * @return integer
     */
    public static function getAssignCount($entrepot_id)
    {
        return self::withTrashed()->where('entrepot_id', $entrepot_id)
        ->lockForUpdate()->count();
    }
}
