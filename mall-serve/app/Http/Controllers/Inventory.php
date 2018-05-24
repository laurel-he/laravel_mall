<?php
namespace App\Http\Controllers;

use App\Models\InventorySystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

/**
 * 库存
 * @author hyf
 *
 */

class Inventory 
{
    
    protected $model = null;
    
    public function __construct()
    {
        $this->model = new InventorySystem();
    }
    /**
     * 添加订单逻辑
     * @ todo 
     *  1、 done 生成锁定记录 表结构参考 库存明细下面的销售锁定
     *  2、 done 库存表 更新对应的 可售数量和锁定数量 注意 要用事务
     *  //
     * 
     * @param integer $entrepot_id
     * @param array $goods
     * 
     * @throws \Exception
     * @return void
     */
    public function AddOrder($entrepot_id, $goods)
    {
        $this->model->addOrder($entrepot_id, $goods);   
    }
    
    /**
     * 取消订单逻辑
     * @todo 通知仓库 修改 配货单 
     * @param integer $entrepot_id 仓库ID
     * @param array   $goodsList
     * 
     * @throws 
     * 
     * @return int
     */
    public function cancelOrder($entrepot_id, $goodsList)
    {
        return $this->model->orderCancel($entrepot_id, $goodsList);
    }
    
    /**
     * 订单发货（通知仓库配货发货）
     * @todo 
     *  1、生成发货单 生成发货锁定
     *  //done 2、库存表 更新对应的 销售锁定 和 发货锁定
     *  3、 扣保证金 （并生成记录）
     */
    public function setOrderAssign($entrepot_id, $goodsList)
    {
        
        $this->model->assignOrder($entrepot_id, $goodsList);
    }
    
    /**
     * 发货完成
     * @todo 
     *  // done 自动有了 1、生成发货记录
     *  2、库存表 更新对应的 发货锁定 和  仓库数量 、发货在途
     */
    public function orderAssigned($entrepot_id, $goods)
    {
        return $this->model->assignedOrder($entrepot_id, $goods);
    }
    
    /**
     * 签收 完成
     * @todo
     *  // done 暂不需要了 1、生成签收记录
     *  2、库存表 更新对应的 发货在途 和  签收数量
     */
    public function orderSignatured($entrepot_id, $goods)
    {
        return $this->model->orderSignatured($entrepot_id, $goods);
    }
    
    /**
     * 生产入库
     * 
     * @param int $entrepot_id 仓库ID
     * @param array $products  商品数组
     */
    public function produceEntry($entrepot_id, $products)
    {
//        先判断库存有没有 
//         把没有的 挑出来 单独处理
//        有的就 直接调用 entrysUpdate ＝
// 改
//         效率不是最好的 但是可以避免一些 坑
//        假如在$products里面有两个一样的商品 
//        一个 10 个 一个 20个 如果用 entrysUpdate 这个批量插入 会有问题
        DB::beginTransaction();
        try {
            foreach ($products as $product) {
                $entry_at = Carbon::parse($product['entry_at'])->setTimezone('Asia/Shanghai')->toDateTimeString();
                if ($this->model->hasOneBySkuSn($entrepot_id, $product['sku_sn'])) {
                    $this->model->entryUpdate($entrepot_id, $product['sku_sn'], $product['num'],$entry_at);
                } else {
                    $this->model->insert([
                        'entrepot_id'  => $entrepot_id ,
                        'sku_sn'       => $product['sku_sn'],
                        'goods_name'   => $product['goods_name'],
                        'entrepot_count' => $product['num'],
                        'saleable_count' => $product['num'],
                        'entry_at'     => $entry_at,
                    ]);
                }
            }
            DB::commit();   
        } catch (Exception $e) {
            DB::rollback();
        }
    }
    
    /**
     * 退货入库
     * @param integer $entepot_id
     * @param array $goodsList //要入库的商品
     */
    public function returnEntry($entrepot_id, $goodsList)
    {
        $this->model->entrysUpdate($entrepot_id, $goodsList);
    }
    
    /**
     * 查询商品的可销售库存
     * @param integer $entrepot_id
     * @param string $sku_sn
     */
    public function getProductCount($entrepot_id, $sku_sn)
    {
        $re = $this->model->where([
            ['entrepot_id','=', $entrepot_id],
            ['sku_sn', '=', $sku_sn]
        ])->value('saleable_count');
        return is_numeric($re) ? $re : 0 ;
    }
    
    /**
     * 换货锁定
     */
    public function exchangeLock($entrepot_id, $goodsList)
    {
        $this->model->exchangeLock($entrepot_id, $goodsList);
    }
    
    public function exchangeUnLock($entrepot_id, $goodsList)
    {
        $this->model->exchangeUnLock($entrepot_id, $goodsList);
    }
    
}
