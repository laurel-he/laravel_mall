<?php
namespace App\Services\GoodsSpecs;

use App\Repositories\GoodsSpecsRepository;
use Illuminate\Http\Request;

class GoodsSpecsService{

    /**
     * department 资源库
     * @var unknown
     */
    private $repository = null;

    private $request = null;

    public function  __construct(GoodsSpecsRepository $goodsSpecsRepository, Request $request)
    {
        $this->repository = $goodsSpecsRepository;
        $this->request = $request;
    }


    public function  get() 
    {
      	$search = [];
        
        if($this->request->has('name')){
        	$search[] = ['name','like',$this->request->name.'%'];
        }

        if (!empty($search)) {
            $search = app()->makeWith('App\Repositories\Criteria\GoodsSpecs\Search', ['search'=>$search]);
            $this->repository->pushCriteria($search);
        }
 
        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'totle'=> $result->total()
        ]; 
    }


















}