<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Sku;
use App\Alg\Sn;
//GoodsSkuController 

class GoodsSkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $re = Sku::where('goods_id', $request->input('goods_id'))
                   ->with(['attr'])->get();
        return [
        		'items' => $re,
        		'total' => $re->count()
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
     * @todo 添加事务
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();

        
        $attrs = $all['attr'];
    	$attachArr = [];
    	foreach ($attrs as $key => $item) {
    		$attachArr[$item['id']] = [
    				'value'       => $item['value'],
    				'addon_value' => $item['addon_value'],
    				'goods_id'    => $all['goods_id']
    		];
    	}
    	//这里改成事务
    	$all['sku_sn'] = Sn::getSkuSn(Sku::getCount());
    	$sku = Sku::create($all);
    	$sku->attr()->attach($attachArr);
    	
    	return $this->success($sku);
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
     * @todo 改成事务
     *  
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	//$user = App\User::find(1);
    	//$user->roles()->updateExistingPivot($roleId, $attributes);
    	$re = Sku::where('id', $id)->update($request->except(['attr','id']));
    	
    	$sku = Sku::find($id);
    	$attr = $request->input('attr',[]);
    	
    	foreach ($attr as $a) {
    		$sku->attr()->updateExistingPivot($a['id'], 
    				['value'=>$a['value'],'addon_value'=>$a['addon_value']]);
    	}
    	
    	return $this->success(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Sku::destroy($id);
    	return $this->success(null);
    }
}
