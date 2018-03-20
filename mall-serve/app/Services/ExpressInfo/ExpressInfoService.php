<?php
namespace App\Services\ExpressInfo;

use App\Repositories\ExpressInfoRepository;
use Illuminate\Http\Request;

class ExpressInfoService{

    /**
     * department 资源库
     * @var unknown
     */
    private $repository = null;
    
    private $request = null;
    
    public function  __construct(ExpressInfoRepository $expressInfoRepository, Request $request) 
    {
        $this->repository = $expressInfoRepository;
        $this->request = $request;
    }


    public function  get() 
    {
      	$search = [];
        
        if($this->request->has('order_sn')){
        	$search[] = ['order_number','like',$this->request->order_number.'%'];
        }

        if($this->request->has('express_sn')){
        	$search[] = ['express_no','like',$this->request->express_no.'%'];
        }

        if($this->request->has('express_status')){
        	$search[] = ['express_status',$this->request->express_status];
        }

        if($this->request->has('start')){
        	$search[] = ['express_time','>=',$this->request->start." 00:00:00"];
        }

		if($this->request->has('end')){
        	$search[] = ['express_time','<',$this->setEndTime()];
        }

        if (!empty($search)) {
            $search = app()->makeWith('App\Repositories\Criteria\ExpressInfo\Search', ['search'=>$search]);
            $this->repository->pushCriteria($search);
        }
 
        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'totle'=> $result->total()
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