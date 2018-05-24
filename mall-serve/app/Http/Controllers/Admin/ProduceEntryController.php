<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProduceEntry;
use App\Models\ProduceEntryProduct;
use App\Models\OrderGoods;
use Illuminate\Support\Facades\DB;
use App\Models\EntrepotProductCategory;
use App\Events\ProduceEntried;
use Carbon\Carbon;

class ProduceEntryController extends Controller
{

    public function store(Request $request)
    {
        
        DB::beginTransaction();
        try {
            $products = $request->input('childrenData', []);
            $this->checkEntrepotProductCategory($products);
            $data = $request->except('childrenData');
            $data['entry_at'] = Carbon::parse($data['entry_at'])->setTimezone('Asia/Shanghai')->toDateTimeString();
            $model = ProduceEntry::create($data);
            
            $productsModels = [];
            foreach ($products as $product) {
                $productsModels[] = new ProduceEntryProduct($product);
            }
            if (!empty($productsModels)) {
                $model->products()->saveMany($productsModels);
            }
            event( new ProduceEntried($model->entrepot_id, $products));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return $this->error([], $e->getMessage());
        }

        return $this->success([]);
    }
    
    /**
     * 仓库里商品分类
     *
     */
    private function checkEntrepotProductCategory($products)
    {
        foreach ($products as $key => $product) {
            //判断是否有 sku_sn
            $modle = EntrepotProductCategory::where('sku_sn', $product['sku_sn'])->first();
            if ($modle) {
                if ($modle->cate_type_id != $product['cate_type_id']) {
                    throw  new \Exception('商品类型不正确');
                }
                
                if ($modle->cate_kind_id != $product['cate_kind_id']) {
                    throw  new \Exception('商品品种不正确');
                }
                
                if ($modle->product_sale_type != $product['product_sale_type']) {
                    throw  new \Exception('销售类型不正确');
                }
            } else {
                $nModel = EntrepotProductCategory::create($product);
            }
        }
        
    }

//    获取销售锁定展示数据
    public function GetSaleLockData(){
        $order_model = new OrderGoods();
        $saleLockData2 = $order_model
            ->join('order_basic','order_goods.order_id','=','order_basic.id')
            ->join('delivery_addresses','order_basic.address_id','=','delivery_addresses.id')
            ->join('user_basic','order_basic.deal_id','=','user_basic.id')
            ->select('order_basic.department_id','group_id',"order_basic.deal_name as sale_name","order_goods.goods_name","order_goods.goods_number as sale_number","delivery_addresses.name as customer_name",'order_basic.check_status as examine_status','order_goods.created_at as sale_lock_time')
            ->get();
        $saleLockData=[];
        foreach ($saleLockData2 as $k => $v){
            $name = $v['sale_name'];
            if($v['group_id']){
                $group_name = DB::table('group_basic')->where('id',$v['group_id'])->select('name')->first()->name;
                $name =$group_name.'-'.$name;
            }
            if($v['department_id']){
                $department_name = DB::table('department_basic')->where('id',$v['department_id'])->select('name')->first()->name;
                $name=$department_name.'-'.$name;
            }
            $v['sale_name']=$name;
            $saleLockData[$k] =$v;
        }
        return ['items'=>$saleLockData,'total'=>count($saleLockData)];

    }
    
}
