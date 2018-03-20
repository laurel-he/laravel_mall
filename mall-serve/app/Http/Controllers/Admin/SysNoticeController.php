<?php

namespace App\Http\Controllers\Admin;

use App\Models\SysNotice;
use Illuminate\Http\Request;

class SysNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $model = null;

    public function  __construct(SysNotice $SysNotice)
    {
        $this->model = $SysNotice;

    }

    public function index(Request $request)
    {
        $where=[];
        if ($request->has('title')){
            $where['sys_notices.title']=$request->input('title');
        }
        $data = $this->model
            ->join('user_basic','user_basic.id','=','sys_notices.user_id')
            ->select('sys_notices.*','user_basic.account')
            ->where($where)
            ->orderBy('sys_notices.created_at', 'desc')
            ->get();
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
        //
        $re=$this->model->create($request->all());
        if ($re) {
            return $this->success($re);
        } else {
            return $this->error(0);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SysNotice  $sysNotice
     * @return \Illuminate\Http\Response
     */
    public function show(SysNotice $sysNotice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SysNotice  $sysNotice
     * @return \Illuminate\Http\Response
     */
    public function edit(SysNotice $sysNotice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SysNotice  $sysNotice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $re=$this->model->where('id',$id)->update($request->all());
        if ($re) {
            return $this->success($re);
        } else {
            return $this->error(0);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SysNotice  $sysNotice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $re = $this->model->destroy($id);
        if ($re) {
            return $this->success(1);;
        } else {
            return $this->error(0);
        }
    }
}
