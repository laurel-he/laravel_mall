<?php

namespace App\Http\Controllers\Admin;

use App\Models\VolumeRatio;
use Illuminate\Http\Request;

class VolumeRatioController extends Controller
{

    private $model = null;
    public function __construct(VolumeRatio $VolumeRatio) {
        $this->model = $VolumeRatio;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model->first()->toArray();
        return ['items' => $data];
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
        $data = $request->all ();
        $re = $this->model->create( $data );
        if ($re) {
            return $this->success ( $re );
        } else {
            return $this->error ( 0 );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VolumeRatio  $volumeRatio
     * @return \Illuminate\Http\Response
     */
    public function show(VolumeRatio $volumeRatio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VolumeRatio  $volumeRatio
     * @return \Illuminate\Http\Response
     */
    public function edit(VolumeRatio $volumeRatio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VolumeRatio  $volumeRatio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * @param  \App\Models\VolumeRatio  $volumeRatio
     * @return \Illuminate\Http\Response
     */
    public function destroy(VolumeRatio $volumeRatio)
    {
        //
    }
}
