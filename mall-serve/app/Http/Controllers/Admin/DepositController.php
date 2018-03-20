<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Deposit;
use Monolog\Handler\IFTTTHandler;
use PhpParser\Node\Stmt\If_;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where=[];
    	if($request->has('department_id')){
        $where[]=['department_id','=',$request->input('department_id')];
        }
        if($request->has('group_id')){
        $where[]=['group_id','=',$request->input('group_id')];
        }
        if($request->has('user_id')){
        $where[]=['user_id','=',$request->input('user_id')];
        }
    	return [
    			'items'=> Deposit::orderBy('id','desc')->where($where)->get(),
    			'total'=> Deposit::where($where)->count(),
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
    	$model = Deposit::create($request->all());
    	if ($model) {
    		return $this->success($model);
    	} else {
    		return $this->error(0);
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
