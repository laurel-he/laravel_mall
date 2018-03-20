<?php
namespace App\Services\GoodsDetails;

use App\Repositories\GoodsDetailsRepository;
use Illuminate\Http\Request;
use App\Alg\ModelCollection;
use App\Repositories\Criteria\Goods\Name;
use App\Repositories\Criteria\Goods\Categories;
use App\Repositories\Criteria\Goods\Number;
use App\Models\GoodsImg;
use App\Repositories\Criteria\Order;
use App\Repositories\Criteria\Goods\SkuSn;

class GoodsDetailsService{

    /**
     * department 资源库
     * @var unknown
     */
    private $repository = null;

    private $request = null;

    public function  __construct(GoodsDetailsRepository $goodsDetailsRepository, Request $request)
    {
        $this->repository = $goodsDetailsRepository;
        $this->request = $request;
    }


    public function  get() 
    {
        if ($this->request->has('orderField')  ) {
            $this->repository->pushCriteria( new Order($this->request->input('orderField'), 
                $this->request->input('orderWay', 'desc')));
        }

    	if ($this->request->has('goods_name')) {
    		$this->repository->pushCriteria( new Name($this->request->input('goods_name')));
    	}
    	
    	if ($this->request->has('cate_id')) {
    		$this->repository->pushCriteria( new Categories($this->request->input('cate_id')));
    	}

        if ($this->request->has('goods_number')) {
            $this->repository->pushCriteria( new Number($this->request->input('goods_number')));
        }
		
        if ($this->request->has('sku_sn')) {
            $this->repository->pushCriteria( new SkuSn($this->request->input('sku_sn')));
        }
        
        
        if ($this->request->has('with')) {
        	$with = $this->request->input('with');
//         	foreach ($with as &$value) {
//         		if ($value == "skus"){
//         			$value = 'skus.attr';
//         		}
//         	}
        	$this->repository->with($with);
        }
        
        
    	$fields = $this->request->input('fields', ["*"]);
    	$result = $this->repository->paginate($this->request->input('pageSize'),$fields);
        
        $collection = $result->getCollection();
//         if ($this->request->has('appends')) {
//         	$collection = ModelCollection::setAppends($collection, $this->request->input('appends'));
//         }
        
//         $collection = ModelCollection::setAppends($collection, ['imgs']);
// 		$goodsInfo=[];
//         foreach ($collection as &$model) {
//         	$model->imgs;
//         	$model->category;
//         	$goodsInfo[$model->id]=$model;
//         }
        
        return [
        		'items'=> $collection,
//         		'goods'=> $goodsInfo,
            	'total'=> $result->total()
        ]; 
    }

	  
    /**
    * [setEndTime 设置查询时间段结束]
    */
    protected function setEndTime(){
        $end = $this->request->end;
        $today = Date('Y-m-d');
        if($end >=  $today){
          $end = Date('Y-m-d H:i:s', strtotime($today) + 86400);
        }else{
          $end = Date('Y-m-d H:i:s', strtotime($end) + 86400);
        }
        return $end;
    }



}
