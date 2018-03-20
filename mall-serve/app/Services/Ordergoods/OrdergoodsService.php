<?php
namespace App\Services\Ordergoods;

use App\Repositories\OrdergoodsRepository;
use Illuminate\Http\Request;
use App\Repositories\Criteria\Ordergoods\Ordergoods;
class OrdergoodsService
{
    /**
     * department 资源库
     * @var unknown
     */
    private $repository = null;

    private $request = null;

    public function  __construct(OrdergoodsRepository $departRepository, Request $request)
    {
        $this->repository = $departRepository;
        $this->request = $request;
    }


    public function  get()
    {
        $where = array();
        $whereIn = array();
        if ($this->request->has('goods_id')&&$this->request->has('order_id')) {
            $goods_id = explode(',',$this->request->goods_id);
            $where[] = ['order_id','=',$this->request->order_id];
            $whereIn[]=$goods_id;
        }
        if(count($whereIn)>0)
        {
            $order_status=  app()->makeWith('App\Repositories\Criteria\Ordergoods\Ordergoods', ['where'=>$where,'whereIn'=>$whereIn]);
            $this->repository->pushCriteria($order_status);
        }

        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'totle'=> $result->total()
        ];
    }
}
