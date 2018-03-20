<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GoodsType;
use App\Repositories\GoodsTypeRepository;

class GoodsTypeController extends Controller
{

    private $repository = null;
    public function  __construct(GoodsTypeRepository $goodsTypeRepository) 
    {
        $this->repository = $goodsTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = GoodsType::orderBy('id', 'desc');
        
        if ($request->has('name')){
            $query->where('name','like', $request->input('name')."%");
        }
		
        $collection = $query->paginate(15);
        
        foreach ($collection as &$model) {
            $model->specs;
        }
        
        return [
            'items'=> $collection->items(),
            'total'=> $collection->total(),
        ]; 

    }
    public  function goodsTypeList(){
        $data = GoodsType::all();
        return ['items'=>$data];
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
    	//事务
    	$typeGoods = $this->repository->create($request->all());
    	$typeGoods->specs()->attach($request->input('sepc_ids', []));
    	// end of 事务
    	return  $this->success($typeGoods);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->repository->with(['specs'])->find($id);
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
        $goodsType = GoodsType::find($id);
        $goodsType->name = $request->input('name');
        $goodsType->save();

        $spec_ids = $request->input('sepc_ids',[]);
        $goodsType->specs()->sync($spec_ids);

        if ($goodsType) {
            return $this->success($goodsType);
        } else {
            return $this->error($goodsType);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //返回 int
        $re = $this->repository->delete($id);
        if ($re) {
            return $this->success($re);
        } else {
            return $this->error($re);
        }
    }
}
