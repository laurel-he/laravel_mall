<?php

namespace App\Http\Controllers\Admin;

use App\Models\DistributionCenter;
use Illuminate\Http\Request;
use App\Http\Requests\EntrePotCreate;

class DistributionCenterController extends Controller
{



    private $model = null;

    public function  __construct(DistributionCenter $DistributionCenter)
    {
        $this->model = $DistributionCenter;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = [];
        if($request->has('name')){
            $where['name']=$request->input('name');
        }
        if($request->has('contact')){
            $where['contact']=$request->input('contact');
        }
        if($request->has('contact_phone')){
            $where['contact_phone']=$request->input('contact_phone');
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
    public function store(EntrePotCreate $request)
    {
        $data = $request->all();
        $data['eng_name']=strtoupper($data['eng_name'] );
        $this->model->create($data);
        return $this->success([]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DistributionCenter  $distributionCenter
     * @return \Illuminate\Http\Response
     */
    public function show(DistributionCenter $distributionCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DistributionCenter  $distributionCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(DistributionCenter $distributionCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DistributionCenter  $distributionCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('eng_name');
//         $data['eng_name']=strtoupper($data['eng_name'] );
        $this->model->where('id',$id)->update($data);
        return $this->success([]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DistributionCenter  $distributionCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(DistributionCenter $distributionCenter,$id)
    {

      $re =  $this->model->destroy($id);
        if ($re) {
            return $this->success(1);
        } else {
            return $this->error(0);
        }
    }
}
