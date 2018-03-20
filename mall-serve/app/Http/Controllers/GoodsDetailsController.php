<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsDetails;
use App\Repositories\GoodsDetailsRepository;
use App\Models\GoodsCategory;
use App\Models\GoodsImg;
use App\Models\Goods;

class GoodsDetailsController extends Controller
{

    private $repository = null;
    private $categoryModel = null;
    private $goodsImgMdodel = null;
    public function  __construct(GoodsDetailsRepository $goodsDetailsRepository,GoodsCategory $goodsDetails,GoodsImg $goodsImg) 
    {
        $this->repository = $goodsDetailsRepository;
        $this->categoryModel = $goodsDetails;
        $this->goodsImgMdodel = $goodsImg;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         // $re = Goods::find(3)->imgs;
         // foreach ($re as $url) {
         //     echo $url->url;
         // }
         // die;

        $business = $request->query('business', 'default');
        $result = [];
        switch ($business) {
            case 'UnitTypes':
                $result = GoodsDetails::getUnitTypes();
                break;
            
            default:
                $service = app('App\Services\GoodsDetails\GoodsDetailsService');
                $result = $service->get();
                break;
        }
        return $result;
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
        $data = [];
        $data = $request->all();
        if(!empty($data['img_path'])){
            $data['cover_url'] = $data['img_path'][0];
        }
    	//事务transaction()
    	$goodsModel = Goods::create($data);
    	
    	$imgs = $request->input('img_path', []);
    	foreach ($imgs as $img){
    		$imgModel = $goodsModel->imgs()->create(['url'=>$img]);
    	}
    	
    	$cates = $request->input('cate_id', []);
    	$goodsModel->category()->attach($cates);
    	// end of 事务
    	
    	return $this->success($goodsModel);
    	
    	
    	
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
        $data = [];
        $data = $request->all();
        if($request->input('cover_url')){
            $coverArr = explode('/',$request->input('cover_url'));
            $data['cover_url'] = '/'.$coverArr[count($coverArr)-2].'/'.$coverArr[count($coverArr)-1];
        }

        if($data['cover_url'] && count($data['del_imgs']) == count($data['imgs'])){
            if(!empty($data['img_path'])){
                $data['cover_url'] = $data['img_path'][0];
            }else{
                $data['cover_url'] = '';
            }
        }else if($data['cover_url'] && count($data['del_imgs']) !=count($data['imgs']) && count($data['del_imgs'])>0){
            $imgArr = array_column($data['imgs'],'url');
            $diff = array_diff($imgArr,$data['del_imgs']);
            $data['cover_url'] = reset($diff);
        }else if($data['cover_url'] && count($data['del_imgs']) !=count($data['imgs']) && empty($data['del_imgs'])){
            $coverArr = explode('/',$request->input('cover_url'));
            $data['cover_url'] = '/'.$coverArr[count($coverArr)-2].'/'.$coverArr[count($coverArr)-1];
        }else if(!empty($data['img_path'])){
            $data['cover_url'] = $data['img_path'][0];
        }

        $goodsModel = Goods::find($id);

        $goodsModel->update($data);

        $cates = $request->input('cate_id', []);
        $goodsModel->category()->sync($cates);

        if($data['imgs']){
            $goodsModel->imgs()->delete();

            $imgArr = array_column($data['imgs'],'url');
            $diff = array_diff($imgArr,$data['del_imgs']);

            foreach ($data['img_path'] as $v) {
                array_push($diff,$v);
            }

            foreach ($diff as $value) {
                $goodsModel->imgs()->create(['url'=>$value]);
            }
            
        }else{
            foreach ($data['img_path'] as $value){
                $goodsModel->imgs()->create(['url'=>$value]);
            }
        }

        return $this->success($goodsModel);


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
