<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExpressReceive;
use Illuminate\Http\Request;

class ExpressReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $model = null;

    public function  __construct(ExpressReceive $ExpressReceive)
    {
        $this->model = $ExpressReceive;

    }

    public function index(Request $request)
    {
        $where = [];
        if($request->has('express_id')){
            $where['express_id']=$request->input('express_id');
        }
        if($request->has('assign_sn')){
            $where['assign_sn']=$request->input('assign_sn');
        }
        if($request->has('express_sn')){
            $where['express_sn']=$request->input('express_sn');
        }
        if($request->has('start')){
            $where[]=['created_at','>=',$request->input('start')];
        }
        if($request->has('end')){
            $where[]=['created_at','<=',$request->input('end')];
        }
//        var_dump($where);die();
        $data = $this->model->where($where)->orderBy('created_at','desc')->get();
        return ['items'=>$data, 'total'=>count($data)];
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
        $model = $this->model->create($data);
        return $this->success([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpressReceive  $expressReceive
     * @return \Illuminate\Http\Response
     */
    public function show(ExpressReceive $expressReceive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpressReceive  $expressReceive
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpressReceive $expressReceive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpressReceive  $expressReceive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpressReceive $expressReceive,$id)
    {
        $data = $request->all();
        $this->model->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpressReceive  $expressReceive
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpressReceive $expressReceive)
    {
        //
    }
}
