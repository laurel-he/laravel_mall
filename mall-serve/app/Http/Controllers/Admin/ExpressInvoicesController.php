<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expressinvoices;
use App\Models\ExpressCompany;
use Illuminate\Support\Facades\DB;
use App\Models\Assign;
use Carbon\Carbon;

class ExpressInvoicesController extends Controller
{
    public function __construct( )
    {
        $this->model = new Expressinvoices();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('express_sn')) {
            $this->model = $this->model->where('express_sn', $request->input('express_sn'));
        }
        
        
        return [
            'items'=>$this->model->get(),
            'total'=>0
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $model = $this->model->make($request->all());
            $model->setSn(strtoupper(ExpressCompany::findOrFail($request->input('express_id'))->eng));
            $model->create_by = auth()->user()->realname;
            $re = $model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error([], $e->getMessage());
        }
        
        if ($re) {
            return $this->success($model);
        } else {
            return $this->error([]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $assign = Assign::select(['id','express_print_status','express_print_at'])->find($request->input('id'));
        $assign->express_print_status = 1;
        $assign->express_print_at = Carbon::now();
        $assign->save();
        
        return view('print/index', ['model'=>$this->model->find($id)]);
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
