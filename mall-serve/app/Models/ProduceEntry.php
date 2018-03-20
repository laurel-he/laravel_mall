<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\Process\Process;
use App\Events\ProduceEntryCreating;

class ProduceEntry extends Model
{
    use SoftDeletes;
    
    /**
     * 表名
     * @var string
     */
    protected $table = 'produce_in_inventory';
    
    protected $dates = [
        'deleted_at'
    ];
    
    protected $fillable = [
        'entry_sn',
        'user_name',
        'user_id',
        'entrepot_id',
        'comment',
        'entry_at',
    ];
    
    /**
     * 模型的事件映射。
     *
     * @var array
     */
    protected $events = [
        'creating' => ProduceEntryCreating::class
    ];
    
    
    public function products()
    {
        return $this->hasMany('App\Models\ProduceEntryProduct', 'parent_id');
    }
    
    public function entrepot()
    {
        return $this->belongsTo('App\Models\DistributionCenter');
    }
    
    /**
     * 获取指定仓库的总数
     * @param int $entrepot_id
     * @return int
     */
    public static function getAllCount($entrepot_id)
    {
        return self::withTrashed()->where('entrepot_id', $entrepot_id)->count();
    }
}
