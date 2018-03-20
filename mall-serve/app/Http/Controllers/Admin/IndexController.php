<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     * todo 写不同的逻辑 select 、 default
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin/index');
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
