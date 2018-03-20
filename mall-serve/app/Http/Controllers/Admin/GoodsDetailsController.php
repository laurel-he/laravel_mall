<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GoodsDetails;
use App\Repositories\GoodsDetailsRepository;
use App\Models\GoodsCategory;
use App\Models\GoodsImg;
use App\Models\Goods;
use App\Models\Sku;
use App\Alg\Sn;
use Illuminate\Support\Facades\DB;

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
     * @todo 改成事务
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
    	
        DB::beginTransaction();
        try {
            
            $goods_sn = Sn::getGoodsSn(Goods::getCount());
            $data['goods_sn'] = $goods_sn;
            $goodsModel = Goods::create($data);
            
            $imgs = $request->input('img_path', []);
            foreach ($imgs as $img){
                $imgModel = $goodsModel->imgs()->create(['url'=>$img]);
            }
            
            $cates = $request->input('cate_id', []);
            $goodsModel->category()->attach($cates);
            
            
            $skus = $request->input('skus', []);
            //json_decode($request->input('skus'), true);
            if (!empty($skus)) {
                $skuModels = [];
                $skuCount = Sku::getCount();
                foreach ($skus as $sku) {
//                     $sku['sku_sn'] = Sn::getSkuSn($skuCount);
                    $skuModels[] = Sku::make($sku);
                    $skuCount++;
                    
                }
                
                $goodsModel->skus()->saveMany($skuModels);
                
                foreach ($skuModels as $index => $skModel) {
                    $attrs = $skus[$index]['attr'];
                    $attachArr = [];
                    foreach ($attrs as $key => $item) {
                        $attachArr[$item['id']] = [
                            'value'       => $item['value'],
                            'addon_value' => $item['addon_value'],
                            'goods_id'    => $goodsModel->id
                        ];
                    }
                    
                    $skModel->attr()->attach($attachArr);
                }
            }
            DB::commit();
        }catch(\Error $e) {
            DB::rollback();
            throw $e;
        }
        
        
        
 
    	
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
    	$this->repository->with(['category', 'imgs']);
    	return $this->repository->find($id);
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
     * @todo 考虑重构 把图片处理的代码移到另一个控制器里
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
        $data = $request->all();
        if($request->has('cover_url')){
            $coverArr = explode('/',$request->input('cover_url'));
            $data['cover_url'] = '/'.$coverArr[count($coverArr)-2].'/'.$coverArr[count($coverArr)-1];
            
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
        }

        

        $goodsModel = Goods::find($id);

        $goodsModel->update($data);
        
        $cates = $request->input('cate_id', []);
        $goodsModel->category()->sync($cates);
        if (isset($data['imgs']) || isset($data['img_path'])) 
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
