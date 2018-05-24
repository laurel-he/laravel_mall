<?php

namespace App\Http\Controllers\Admin;

use App\Models\CartonManagement;
use Illuminate\Http\Request;
use App\Models\OrderBasic;
use App\Models\Goods;
class CartonManagementController extends Controller
{

    private $model = null;
    public function __construct(CartonManagement $CartonManagement) {
        $this->model = $CartonManagement;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        if ($request->has('carton_name')) {
            $where['carton_management.carton_name'] = $request->input('carton_name');
        }
        if ($request->has('carton_model')) {
            $where['carton_management.carton_model'] = $request->input('carton_model');
        }
        $data = $this->model->where($where)
            ->paginate($request->input('pageSize'));
        return ['items' => $data->items(), 'total' => $data->total()];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all ();
        $re = $this->model->create( $data );
        if ($re) {
            return $this->success ( $re );
        } else {
            return $this->error ( 0 );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartonManagement  $cartonManagement
     * @return \Illuminate\Http\Response
     */
    public function show(CartonManagement $cartonManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartonManagement  $cartonManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(CartonManagement $cartonManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartonManagement  $cartonManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $re=$this->model->where('id',$id)->update($request->all());
        if ($re) {
            return $this->success($re);
        } else {
            return $this->error(0);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartonManagement  $cartonManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $re = $this->model->destroy($id);
        if ($re) {
            return $this->success(1);
        } else {
            return $this->error(0);
        }
    }


//    判断商品应该使用哪种型号的纸箱包装
    public function goods_carton(Request $request)
    {
//         获取纸箱的体积，以纸箱的id作为key值
        $cartons = $this->model->get()->toArray();
        $carton_volumes = [];
        foreach ($cartons as $k=>$v){
            $carton_volumes[$v['id']]=(int)$v['carton_long'] * (int)$v['carton_wide'] * (int)$v['carton_high'];
        }
//        按纸箱体积从大到小排序
        arsort($carton_volumes);
//        获取订单id
        $order_id = $request->input('order_id');
//        获取该订单中的商品
        $order_goods_ids =  OrderBasic::where(['id'=>$order_id])->select('goods_id')->first()->toArray();
        $goods_ids = explode(',',$order_goods_ids['goods_id']);
        $goods = Goods::whereIn('id',$goods_ids)->select('id','length','width','height')->get()->toArray();
//        获取订单中每种商品的体积，并与纸箱体积的70%作比较，选出合适该商品的纸箱型号
        $goods_volumes=[];
        foreach ($goods as $k=>$v){
            $goods_volume=[];
            $temp = null;
            $temp=(int)$v['length'] * (int)$v['width'] * (int)$v['height'];
            foreach($carton_volumes as $k1=>$v1){
                if($temp <= $v1*0.7){
                    $goods_volume['goods_id']=$v['id'];
                    $goods_volume['carton_id']=$k1;
                }
            }
            $goods_volumes[] = $goods_volume;
        }
        var_dump($goods_volumes);die;


    }

}
