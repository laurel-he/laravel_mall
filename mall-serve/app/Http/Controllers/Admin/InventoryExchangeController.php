<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InventoryExchange;
use App\Events\ProductExchange;

class InventoryExchangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model  = new InventoryExchange();
        
        if ($request->has('entrepot_id')) {
            $model = $model->where('entrepot_id', $request->input('entrepot_id'));
        }
        
        if ($request->has('sku_sn')) {
            $model = $model->where('sku_sn', $request->input('sku_sn'));
        }
        
        if ($request->has('sku_sn')) {
            $model = $model->where('sku_sn', $request->input('sku_sn'));
        }
        
        if ($request->has('start') && $request->has('end')) {
            $range= [];
            $range[] = $request->input('start');
            $range[] = $request->input('end');
            $model = $model->where([
                ['exchange_at', '>=', $range[0]],
                ['exchange_at', '<=', $range[1]] 
            ]);
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
        $data = $request->all();
        $result = InventoryExchange::create($data);
        if ($result) {
            //after_goods_num
            //sku_sn
            //entrepot_id
            event(new ProductExchange($data['sku_sn'], $data['after_goods_num'], $data['entrepot_id']));
            $this->success($result);
        }else{
            $this->error($result);
        }
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
