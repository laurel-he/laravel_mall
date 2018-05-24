<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShelvesManagement;
use Illuminate\Http\Request;

class ShelvesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        if($request->input('shelvesUP')){
//            var_dump('111111111111111');die();
//            ShelvesManagement::sum('deposit_num')->groupBy('distributor_id')->get();
//        }
        $where=[];
        if($request->has('shelves_num')){
            $where['shelves_num']=$request->input('shelves_num');
        }
        if($request->has('shelves_name')){
            $where['shelves_name']=$request->input('shelves_name');
        }
        if($request->has('distributor_id')){
            $where['distributor_id']=$request->input('distributor_id');
        }
        if($request->has('shelves_manager_id')){
            $where['shelves_manager_id']=$request->input('shelves_manager_id');
        }
       $data =  ShelvesManagement::where($where) ->paginate($request->input('pageSize'));
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
        ShelvesManagement::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShelvesManagement  $shelvesManagement
     * @return \Illuminate\Http\Response
     */
    public function show(ShelvesManagement $shelvesManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShelvesManagement  $shelvesManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(ShelvesManagement $shelvesManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShelvesManagement  $shelvesManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ShelvesManagement::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShelvesManagement  $shelvesManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShelvesManagement $shelvesManagement,$id)
    {
        ShelvesManagement::destroy($id);
    }
}
