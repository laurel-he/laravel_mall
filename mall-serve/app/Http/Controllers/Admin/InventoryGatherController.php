<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assign;
use App\Models\ProduceEntry;
use App\Models\ProduceEntryProduct;
use App\Models\BadGoods;
use Illuminate\Http\Request;
use App\Models\InventorySystem;
use App\Models\OrderGoods;
use App\Models\ReturnRecord;

class InventoryGatherController extends Controller
{
    
    public function index(Request $request)
    {
        
        $fields = [
            'id',
            'entrepot_id',
            'goods_name',
            'sku_sn',
           
            'entrepot_count',
            'saleable_count',
            'entry_at',
        ];
        
        $model = new InventorySystem();
        
        if ($request->has('entrepot_id')) {
            $model->where('entrepot_id', $request->input('entrepot_id'));
        }
        
        if ($request->has('goods_name')) {
            $model->where('goods_name', 'like', $request->input('goods_name'));
        }
        
        if ($request->has('cate_kind_id')) {
            $cate_kind_id = $request->input('cate_kind_id');
            $model = $model->wherehas('goods', function($query) use($cate_kind_id){
                $query->where('cate_kind_id', $cate_kind_id);
            });
        } else if($request->has('cate_type_id')) {
            $cate_type_id = $request->input('cate_type_id');
            $model = $model->wherehas('goods', function($query) use($cate_type_id) {
                $query->where('cate_type_id', $cate_type_id);
            });
        }
       
//         $model->with(['goods','entrepot']);
//         $model->setVisible(['goods']);
        
        $result = $model->paginate($request->input('pageSize', 20), $fields);
        
        $collection = $result->getCollection();
        $collection->load('goods', 'entrepot');
        
        $re = $collection->toArray();
        
        $range = [];
        if($request->has('start') && $request->has('end')) {
            $range[] = $request->input('start');
            $range[] = $request->input('end');
        }
        
        
        $this->getAssign($re, $range);
        
        return [
            'items'=>$re,
            'total'=> $result->total()
        ];
    }
    
    
    private function setRange($rang, $field) 
    {
        return [
            [$field, '>=', $rang[0]],
            [$field, '<=', $rang[1]]
        ];
    }
    
    //累记出库数量
    //累记入库数量
    //累记损坏数量
    public function getAssign(&$re, $range)
    {
        foreach ($re as $key => &$goods) {
            //累记出库数量
            $Assignwhere =[
                ['entrepot_id', $goods['entrepot_id']],
                ['sku_sn', $goods['sku_sn']],
                ['status', 1]
            ];
            
            if (!empty($range)) {
                $Assignwhere = array_merge($Assignwhere, $this->setRange($range, 'out_entrepot_at'));
            }
            $goods['entrepot_out'] = Assign::where($Assignwhere)->sum('goods_num');
            
            //累记入库数量
            $proWhere = [
                ['sku_sn', $goods['sku_sn']],
            ];
            if (!empty($range)) {
                $proWhere= array_merge($proWhere, $this->setRange($range, 'created_at'));
            }
            $model = ProduceEntryProduct::where($proWhere);
            $entrepot_id = $goods['entrepot_id'];
            $goods['entrepot_id'] = $model->whereHas('produceEntry', function($query) use($entrepot_id) {
                $query->where('entrepot_id', $entrepot_id);
            })->sum('num');
            
            //累记损坏数量
            $badWhere = [
                ['entrepot_id', $goods['entrepot_id']],
                ['sku_sn', $goods['sku_sn']],
            ];
            if (!empty($range)) {
                $badWhere= array_merge($badWhere, $this->setRange($range, 'created_at'));
            }
            $goods['bad_num'] = BadGoods::where($badWhere)->sum('num');
            
        }
    }
    
    public function detail(Request $request)
    {
        $fields = [
            'id',
            'entrepot_id',
            'goods_name',
            'sku_sn',
            'entrepot_count',
            'entry_at',
        ];
        
        $model = new InventorySystem();
        
        if ($request->has('entrepot_id')) {
            $model = $model->where('entrepot_id', $request->input('entrepot_id'));
        }
        
        if ($request->has('goods_name')) {
            $model = $model->where('goods_name', 'like', $request->input('goods_name')."%");
        }
        
        if ($request->has('cate_kind_id')) {
            $cate_kind_id = $request->input('cate_kind_id');
            $model = $model->wherehas('goods', function($query) use($cate_kind_id){
                $query->where('cate_kind_id', $cate_kind_id);
            });
        } else if($request->has('cate_type_id')) {
            $cate_type_id = $request->input('cate_type_id');
            $model = $model->wherehas('goods', function($query) use($cate_type_id) {
                $query->where('cate_type_id', $cate_type_id);
            });
        }
        
        $result = $model->paginate($request->input('pageSize', 20), $fields);
        
        $collection = $result->getCollection();
        $collection->load('entrepot');
        
        $re = $collection->toArray();
        
        $range = [];
        if($request->has('start') && $request->has('end')) {
            $range[] = $request->input('start');
            $range[] = $request->input('end');
        }
        
        
        ///生产入库数量	
        //退货入库数量	 
        //销售锁定数	order_goods  created_at
        //发货锁定数	assign_basic created_at
        //换货锁定数  还没有
        
        $this->getSte($re, $range);
        logger($re);
        return [
            'items'=> $re,
            'total'=> $result->total()
        ];
        
    }
    
    private function getSte(&$re ,$range) {
        foreach ($re as &$goods) {
            //生产入库数量	
            $proWhere = [
                ['sku_sn', $goods['sku_sn']],
            ];
            if (!empty($range)) {
                $proWhere= array_merge($proWhere, $this->setRange($range, 'created_at'));
            }
            $model = ProduceEntryProduct::where($proWhere);
            $entrepot_id = $goods['entrepot_id'];
            $goods['entrepot_in'] = $model->whereHas('produceEntry', function($query) use($entrepot_id) {
                $query->where('entrepot_id', $entrepot_id);
            })->sum('num');

            //退货入库数量
            $returnWhere = [
                ['entrepot_id', $goods['entrepot_id']],
                ['sku_sn', $goods['sku_sn']],
                ['goods_status', 0]
            ];
            if (!empty($range)) {
                $returnWhere= array_merge($returnWhere, $this->setRange($range, 'created_at'));
            }
            $goods['return_num'] = ReturnRecord::where($returnWhere)->sum('goods_num');
            
            //销售锁定数
            $orderWhere =[
                ['sku_sn', $goods['sku_sn']],
            ];
            
            if (!empty($range)) {
                $orderWhere = array_merge($orderWhere, $this->setRange($range, 'created_at'));
            }
            $model = OrderGoods::where($orderWhere);
            $goods['order_lock'] = $model->whereHas('order', function($query) use($entrepot_id) {
                $query->where('entrepot_id', $entrepot_id);
            })->sum('goods_number');
            
            //发货锁定数
            $Assignwhere =[
                ['entrepot_id', $goods['entrepot_id']],
                ['sku_sn', $goods['sku_sn']],
                ['status', 1]
            ];
            
            if (!empty($range)) {
                $Assignwhere = array_merge($Assignwhere, $this->setRange($range, 'created_at'));
            }
            $goods['assign_lock'] = Assign::where($Assignwhere)->count();
            
            //换货锁定数  还没有
            $goods['exchange_lock'] = 0;
        }
        
    }
    
    
}