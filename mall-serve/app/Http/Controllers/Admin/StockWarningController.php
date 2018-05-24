<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InventorySystem;

class StockWarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $model = new InventorySystem;

        if ($request->has('entrepot_id')) {
            $model = $model->where('entrepot_id', $request->input('entrepot_id'));
        }
        
        if ($request->has('goods_name')) {
            $model = $model->where('goods_name', 'like', '%'.$request->input('goods_name').'%');
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
       
        $result = $model->paginate($request->input('pageSize', 15));
        
        $collection = $result->getCollection();
        $collection->load('goods', 'entrepot');
        
        $re = $collection->toArray();
        
        return [
            'items'=>$re,
            'total'=> $result->total()
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
        $model = InventorySystem::find($id);
        $model->inventory_max = $request->input('inventory_max');
        $model->inventory_min = $request->input('inventory_min');
        $re = $model->save();
        if($re){
            return $this->success($re);
        }else{
            return $this->error($re);
        }
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
