<?php
namespace  App\Services\Orderlist;

use App\Repositories\OrderlistRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderlistService
{
    private $repository = null;

    private $request = null;

    public function  __construct(OrderlistRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    public function get()
    {
        $where = array();
        $whereIn = array();
        if ($this->request->has('refund_id')) {
            $this->refund($this->request->refund_id);
        }
	    if ($this->request->has('id')) {
            $where[]=['id','=',$this->request->id];
        }
        if ($this->request->has('sn')) {
        	$where[]=['order_sn','like',$this->request->sn."%"];
        }
        if ($this->request->has('order_sn')) {
            $where[]=['order_sn','=',$this->request->order_sn];
        }
        if ($this->request->has('goods_name')) {
            $goods = DB::table('goods_basic')
                ->where('goods_name', 'like', "%".$this->request->goods_name."%")
                ->get();
            $ids = array();
            foreach($goods as $v)
            {
                $ids[] = $v->id;
            }
            $whereIn = $ids;
        }
        if ($this->request->has('consignee')) {
            $sales = DB::table('customer_basic')
                ->where('name', 'like', "%".$this->request->consignee."%")
                ->get();
            foreach ($sales as $v){
                $where[] = ['cus_id',$v->id];
            }
        }
        if ($this->request->has('sale_name')) {
            $where[]=['deal_name','like',"%".$this->request->sale_name."%"];

        }
        if ($this->request->has('type')) {
            $where[]=['order_status','=', $this->request->type];
        }
        if ($this->request->has('deliver')) {
            $where[]=['shipping_status', '=', $this->request->deliver];
        }
        if ($this->request->has('start')) {
            $where[]=['created_at','>=', $this->request->start];
        }
        if ($this->request->has('end')) {
            $where[]=['created_at','<=', $this->request->end];
        }
        if(count($where)>0||count($whereIn>0))
        {
            $order_status=  app()->makeWith('App\Repositories\Criteria\Orderlist\OrderStatus', ['where'=>$where,'whereIn'=>$whereIn]);
            $this->repository->pushCriteria($order_status);
        }
        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'total'=> $result->total()
        ];
    }
    /**
     *
     * 发起退款
     * @param $status
     * @return array
     */
    public function refund($refund_id){
        $data = array(
            'refund_status' => '1',
            'order_status'  => '4',
            'refund_check' => '0',
            'check_status' => '0'
        );
        if($refund_id)
        {
            DB::table('order_basic')
                ->where('id', $refund_id)
                ->update($data);
        }

    }
    public function get_order_status($status){
        $status = app()->makeWith('App\Repositories\Criteria\Orderlist\Order_status', ['status'=>$status]);
        $this->repository->pushCriteria($status);
        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'total'=> $result->total()
        ];
    }
    public function get_deliver_status($status){
        $status = app()->makeWith('App\Repositories\Criteria\Orderlist\Deliver_status', ['status'=>$status]);
        $this->repository->pushCriteria($status);
        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'total'=> $result->total()
        ];
    }
}
