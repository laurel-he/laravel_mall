<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class GoodsOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return [
         'items'=>[
             [
                    'order_sn'=>'201710281532580000',
                    'goods_name' => '华硕笔记本电脑',
                    'consignee'=>'张三=>18236521452',
                    'order_all_money'=>'5999.00',
                    'order_pay_money'=>'5999.00',
                    'order_status'=>'待确认',
                    'pay_name'=>'支付宝',
                    'shipping_status'=>'待发货',
                    'shipping_name'=>'顺丰',
                    'order_time'=>'2017-10-28 15=>32=>24',
             ]
         ],
         'total'=>400
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
