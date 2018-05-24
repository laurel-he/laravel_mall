<?php

namespace App\Http\Controllers\Admin;

use App\Models\ExpressCompany;
use Illuminate\Http\Request;

class ExpressCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where=[];
        if($request->has('company_name')){
            $where['company_name']=$request->input('company_name');
        }
        if($request->has('contact_name')){
            $where['contact_name']=$request->input('contact_name');
        }
        if($request->has('contact_tel')){
            $where['contact_tel']=$request->input('contact_tel');
        }
       $data = ExpressCompany::where($where)->get();
        return ['items'=>$data,'total'=>count($data)];
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
        $this->validate($request, ['eng'=>'required|unique:express_companies|max:2'],['eng.unique'=>'编号前缀已使用']);
        $model = ExpressCompany::create($request->all());
        return $this->success($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpressCompany  $expressCompany
     * @return \Illuminate\Http\Response
     */
    public function show(ExpressCompany $expressCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpressCompany  $expressCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpressCompany $expressCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpressCompany  $expressCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpressCompany $expressCompany,$id)
    {
        ExpressCompany::where('id',$id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpressCompany  $expressCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpressCompany $expressCompany,$id)
    {
        ExpressCompany::destroy($id);
    }
}
