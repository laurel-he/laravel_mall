<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\traits\EntrepotProductCategoryTrait;

class InventorySystem extends Model
{
    use SoftDeletes;
    
    protected $table = 'inventory_system';
    
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
        'sku_sn',
        'goods_name',
        'entrepot_count',
        'saleable_count',
        'return_in',
        'produce_in',
        'exchange_in',
        'transfer_in',
        'sale_lock',
        'assign_lock',
        'exchange_lock',
        'send_ing',
        'destroy_count',
        'inventory_max',
        'inventory_min',
        'entry_at'
    ];
    
    public function goods()
    {
        return $this->belongsTo('App\Models\EntrepotProductCategory', 'sku_sn', 'sku_sn');
    }
    
    public function entrepot()
    {
        return $this->belongsTo('App\Models\DistributionCenter', 'entrepot_id')->select('id','name');
    }
    
    public function category()
    {
        return $this->belongsTo('App\Modles\EntrepotProductCategory', 'sku_sn');
    }
    
    
 
    
    /**
     * 仓库是否有对应的商品
     * 
     * @param int entrepot_id
     * @param string sku_sn
     * 
     * @return 
     */
    public function hasOneBySkuSn($entrepot_id, $sku_sn) 
    {
        return $this->where([
            ['entrepot_id', $entrepot_id],
            ['sku_sn', $sku_sn]
        ])->exists();
    }
    
    /**
     * 批量检查是否存在
     * @param array $sku_sns
     * 
     * @return array
     */
    public function hasSkuSns($entrepot_id,$sku_sns)
    {
        return $this->where('entrepot_id', $entrepot_id)
        ->whereIn('sku_sn', $sku_sns)
        ->pluck('sku_sn')->all();
    }
    
    /**
     * 更新指定 的商品数量
     * 
     * @param unknown $entrepot_id
     * @param unknown $sku_sn
     * @param unknown $num
     * 
     * @return int
     */
    public function entryUpdate($entrepot_id, $sku_sn, $num,$entry_at)
    {
        
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            //返回影响的行数
           $affectedRows =  DB::update('update '. $this->table.
                ' set entrepot_count = entrepot_count + ? , saleable_count = saleable_count + ?'.
                ' , entry_at=? where entrepot_id=? and sku_sn = ?', [$num, $num,$entry_at,$entrepot_id, $sku_sn]);
        } catch (Exception $e) {
            DB::rollBack();
        }
        
        DB::commit();
        return $affectedRows;
        
    }
    
    
    /**
     * 更新多个
     * 
     * @param int $entrepot_id
     * @param array $products
     * 
     * @return 
     */
    public function entrysUpdate($entrepot_id, $products)
    {
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            //返回影响的行数
            foreach ($products as $product) {
                $affectedRows +=  DB::update('update '. $this->table.
                    ' set entrepot_count = entrepot_count + ? , saleable_count = saleable_count + ?'.
                    ' where entrepot_id=? and sku_sn = ?', [$product['num'], $product['num'], $entrepot_id, $product['sku_sn']]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        
        return $affectedRows;
    }
    
    /**
     * 取消订单
     * 
     * @param unknown $entrepot_id
     * @param unknown $goodsList
     * @throws Exception
     * @return number
     */
    public function orderCancel($entrepot_id, $goodsList)
    {
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            foreach ($goodsList as $goods) {
                $affectedRows += DB::update('update '.
                    $this->table.
                    ' set saleable_count = saleable_count + ?, sale_lock = sale_lock - ? where entrepot_id = ? and sku_sn= ? ',
                    [$goods->goods_number, $goods->goods_number, $entrepot_id, $goods->sku_sn]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error: order cancel');
        }  
        
        return $affectedRows;
    }
    
    /**
     * 添加订单 
     * 更新销售锁定数量、可销售数量
     * @param unknown $entrepot_id
     * @param unknown $goods
     * @throws Exception
     */
    public function  addOrder($entrepot_id, $goods)
    {
        DB::beginTransaction();
        try {
            foreach ($goods as $item) {
                DB::update('update '.
                    $this->table.
                    ' set saleable_count = saleable_count - ?, sale_lock = sale_lock + ? where entrepot_id = ? and sku_sn= ? ',
                    [$item->goods_number, $item->goods_number, $entrepot_id, $item->sku_sn]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error');
        }
    }
    
    /**
     * 审核通中 配货中 
     * 更新销售锁定、发货锁定
     * @param unknown $entrepot_id
     * @param unknown $goodsList
     * @throws Exception
     * @return number
     */
    public function assignOrder($entrepot_id, $goodsList)
    {
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            foreach ($goodsList as $goods) {
                $affectedRows += DB::update('update '.
                    $this->table.
                    ' set sale_lock = sale_lock - ? , assign_lock = assign_lock + ? where entrepot_id = ? and sku_sn= ? ',
                    [$goods->goods_number, $goods->goods_number, $entrepot_id, $goods->sku_sn]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error: assign order ');
        }
        
        return $affectedRows;
    }
    
    /**
     * 发货完成 接下来是 物流揽件（状态里没有这个）
     * 
     * @param integer $entrepot_id
     * @param array|Assign $goods
     */
    public function assignedOrder($entrepot_id, $goods)
    {
        if (!is_array($goods)) {
            $goods = $goods->toArray();
        }
        
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            $affectedRows = DB::update('update '.
                $this->table.
                ' set entrepot_count = entrepot_count-? ,  assign_lock = assign_lock - ?, send_ing = send_ing + ? where entrepot_id = ? and sku_sn= ? ',
                [$goods['goods_num'],$goods['goods_num'], $goods['goods_num'], $entrepot_id, $goods['sku_sn']]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error: assignedOrder ');
        }
        return $affectedRows;
    }
    
    /**
     * 签收
     *
     * @param integer $entrepot_id
     * @param array|Assign $goods
     */
    public function orderSignatured($entrepot_id, $goods)
    {
        if (!is_array($goods)) {
            $goods = $goods->toArray();
        }
        
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            $affectedRows = DB::update('update '.
                $this->table.
                ' set  send_ing = send_ing － ? where entrepot_id = ? and sku_sn= ? ',
                [$goods['goods_num'], $entrepot_id, $goods['sku_sn']]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error: orderSignatured ');
        }
        return $affectedRows;
    }
    
    
    public function exchangeLock($entrepot_id, $goods)
    {
        if (!is_array($goods)) {
            $goods = $goods->toArray();
        }
        
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            $affectedRows = DB::update('update '.
                $this->table.
                ' set  saleable_count = saleable_count － ?, exchange_lock = exchange_lock+? where entrepot_id = ? and sku_sn= ? ',
                [$goods['goods_num'], $goods['goods_num'], $entrepot_id, $goods['sku_sn']]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error: exchange Lock ');
        }
        return $affectedRows;
    }
    
    public function exchangeUnLock($entrepot_id, $goods)
    {
        if (!is_array($goods)) {
            $goods = $goods->toArray();
        }
        
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            $affectedRows = DB::update('update '.
                $this->table.
                ' set    exchange_lock = exchange_lock-? where entrepot_id = ? and sku_sn= ? ',
                [$goods['goods_num'], $entrepot_id, $goods['sku_sn']]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('inventory_system update error: exchange unLock ');
        }
        return $affectedRows;
    }
    
    
}
