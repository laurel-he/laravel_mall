<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryListController extends Controller
{
    /**
     * Display a listing of the resource.
     * todo 写不同的逻辑 select 、 default
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $query = Inventory::orderBy('id','desc');
        
        if ($request->has('goods_name')) {
            $query->where('goods_name','like',$request->input('goods_name')."%");
        }
        
        if ($request->has('goods_batch')) {
            $query->where('goods_batch', 'like',$request->input('goods_batch')."%");
        }
        
        if ($request->has('goods_version')) {
            $query->where('goods_version', 'like',$request->input('goods_version')."%");
        }
        
        if ($request->has('goods_version')) {
            $query->where('goods_version', 'like',$request->input('goods_version')."%");
        }
        
        if ($request->has('goods_type')) {
            $query->where('goods_type', $request->input('goods_type'));
        }
        
        if ($request->has('fields')) {
            $query->select($request->input('fields'));
        }
        
        
        $re = $query->paginate($request->input('pageSize'));
        $collection = $re->getCollection();
        foreach ($collection as  &$model){
//     		$model->type_text;
    		$model->setAppends(['type_text']);
    	}
        return [
            'items'=> $collection,
            'total'=> $re->total()

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
        $model = Inventory::make($request->all());
        
        if ($model->type==2) {
        	$oldModel = Inventory::find($request->input('ventory_id'));
        	$model->goods_name = $oldModel->goods_name;
        	$model->goods_version = $oldModel->goods_version;
        	$model->goods_batch = $oldModel->goods_batch;
        }
        
        $model->user = DB::table('user_basic')->where('id', $model->user_id)->value('realname');
        
        
        $re = $model->save();
        if ($re) {
        	return $this->success($model);
        } else {
        	return $this->error();
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
