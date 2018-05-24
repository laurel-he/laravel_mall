<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShelvesPick;
use Illuminate\Http\Request;
use App\Models\ShelvesManagement;
use Illuminate\Support\Facades\DB;

class ShelvesPickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model = null;

    public function  __construct(ShelvesPick $ShelvesPick)
    {
        $this->model = $ShelvesPick;

    }

    public function index(Request $request)
    {
        $where=[];
        if($request->input('shelves_id')){
            $where['shelves_id']=$request->input('shelves_id');
        }
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
        $shelves_id =$request->input('shelves_id');
        $where =[];
        $where['shelves_id'] =$shelves_id;
        $where['goods_name'] =$request->input('goods_name');
       $re = $this->model->where($where)->select('goods_num')->get()->toArray();
       if($re){
           $new_goods_num =(int)$request->input('goods_num') + $re[0]['goods_num'];
           $res = $this->model->where($where)->update(['goods_num'=>$new_goods_num]);
       }else{
           $data = $request->except('shelvesData');
           $res =  $this->model->create($data);
       }
       if($res){
           ShelvesManagement::where('id',$shelves_id)->update($request->input('shelvesData'));
       }else{
           return false;
       }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShelvesPick  $shelvesPick
     * @return \Illuminate\Http\Response
     */
    public function show(ShelvesPick $shelvesPick)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShelvesPick  $shelvesPick
     * @return \Illuminate\Http\Response
     */
    public function edit(ShelvesPick $shelvesPick)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShelvesPick  $shelvesPick
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShelvesPick $shelvesPick,$id)
    {
        $data = $request->all();
        ShelvesManagement::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShelvesPick  $shelvesPick
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShelvesPick $shelvesPick)
    {
        //
    }
}
