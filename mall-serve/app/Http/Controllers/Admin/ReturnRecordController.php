<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AfterSale;
use Illuminate\Support\Facades\DB;
use App\Models\ReturnRecord;
use App\Http\Controllers\Inventory;

class ReturnRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new ReturnRecord();
        
        if ($request->has('entrepot_id')) {
            $model->where('entrepot_id', $request->input('entrepot_id'));
        }
        
        if ($request->has('sku_sn')) {
            $model->where('sku_sn', $request->input('sku_sn'));
        }
        
        
        return [
            'items' => $model->get(),
            'total' => 0
        ];
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

           $model = AfterSale::find($request->input('after_sale_id'));
           $goods = $request->input('goods');
           $order = $model->order;
           $inventory = new Inventory();
           
           DB::beginTransaction();
           $goodsList = [];
           try {
               foreach ($goods as  $product) {
                   ReturnRecord::create([
                       'entrepot_id' => $order->entrepot_id,
                       'goods_name'  => $product['goods_name'],
                       'goods_num'   => $product['goods_num'],
                       'goods_status' => $product['goods_status'],
                       'sku_sn'      => $product['sku_sn'],
                       'express_sn'  => $request->input('express_sn'),
                       'cus_nanme'   => $order->cus_name,
                       'reason'      => $model->remark,
                       'sale_name'   => $order->deal_name,
                       'user_id'     => $request->input('user_id'),
                       'user_name'   => $request->input('user_name'),
                       'return_at'   => Date('Y-m-d H:i:s')
                   ]);
                   
                   if ($product['goods_status'] == 0) { //0 完好　１损坏

                       //下面如果不加　括号　就报语法错误
                       $goodsList[] = ([ 
                           'num'=>$product['goods_num'],
                           'sku_sn'=>$product['sku_sn']
                       ]);


                   }
                   
               }

               $inventory->returnEntry($order->entrepot_id, $goodsList);
               $order->updateAfterSaleDone($model->type);
               DB::commit();
           } catch (Exception $e) {
               DB::rollback();
               return $this->error([]);
           }
           
           return $this->success([]);
       
//         $table->string('cus_qq', 20)->nullable()->comment("客户qq");
//         $table->string('cus_phone', 20)->nullable()->comment('客户 phone');
//         $table->string('cus_weixin', 20)->nullable()->comment("客户 weixin");
//        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
