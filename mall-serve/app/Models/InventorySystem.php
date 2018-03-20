<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\traits\EntrepotProductCategoryTrait;

class InventorySystem extends Model
{
    use SoftDeletes, EntrepotProductCategoryTrait;
    
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
        'destroy_count'
    ];
    
    
 
    
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
    public function entryUpdate($entrepot_id, $sku_sn, $num)
    {
        
        $affectedRows = 0;
        DB::beginTransaction();
        try {
            //返回影响的行数
           $affectedRows =  DB::update('update '. $this->table.
                ' set entrepot_count = entrepot_count + ? , saleable_count = saleable_count + ?'.
                ' where entrepot_id=? and sku_sn = ?', [$num, $num, $entrepot_id, $sku_sn]);
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
    
    
}
