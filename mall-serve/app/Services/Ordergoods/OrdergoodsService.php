<?php
namespace App\Services\Ordergoods;

use App\Repositories\OrdergoodsRepository;
use Illuminate\Http\Request;
use App\Repositories\Criteria\Ordergoods\Ordergoods;
use App\Repositories\Criteria\FieldEqual;
use App\Repositories\Criteria\Ordergoods\Enterpot;
use App\Repositories\Criteria\Ordergoods\DateRange;
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

        if($this->request->has('order_id')){
            $where[] = ['order_id','=',$this->request->order_id];
        }

        if(count($whereIn)>0 || count($where)>0){
            $order_status=  app()->makeWith('App\Repositories\Criteria\Ordergoods\Ordergoods', ['where'=>$where,'whereIn'=>$whereIn]);
            $this->repository->pushCriteria($order_status);
        }
        
        if ($this->request->has('sku_sn')) {
            $this->repository->pushCriteria(new FieldEqual('sku_sn', $this->request->input('sku_sn')));
        }
        
        if ($this->request->has('entrepot_id')) {
            $this->repository->pushCriteria(new Enterpot($this->request->input('entrepot_id')));
        }
        
        if ($this->request->has('start') && $this->request->has('end')) {
            $range= [];
            $range[] = $request->input('start');
            $range[] = $request->input('end');
            $this->repository->pushCriteria(new DateRange($range));
        } 
        
        $result = $this->repository->paginate();
        $collection = $result->getCollection();
        
        
        if ($this->request->has('load')) {
            $collection->load($this->request->input('load'));
            if (in_array('order', $this->request->input('load'))) {
                $collection->each(function($item){
                    $item['order']->setAppends(['status_text']);
                });
            }
            
        }
        
        

        return [
            'items'=> $collection->toArray(),
            'totle'=> $result->total()
        ];
    }
}
