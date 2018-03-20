<?php
namespace  App\Services\Users;

use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

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
        if ($this->request->has('order_sn')) {
            $where[]=['order_sn','=',$this->request->order_sn];
        }
        if ($this->request->has('goods_name')) {
            $where[]=['goods_name','like',$this->request->goods_name."%"];
        }
        if ($this->request->has('consignee')) {
            $where[]=['consignee','like',$this->request->consignee."%"];
        }
        if ($this->request->has('type')) {
            $where[]=['order_status','=', $this->request->type];
        }
        if ($this->request->has('deliver')) {
            $where[]=['shipping_status', '=', $this->request->deliver];
        }
        if ($this->request->has('start')) {
            $where[]=['order_time','>=', $this->request->start];
        }
        if ($this->request->has('end')) {
            $where[]=['order_time','<=', $this->request->end];
        }
        if(count($where)>0)
        {
            $order_status=  app()->makeWith('App\Repositories\Criteria\Orderlist\OrderStatus', ['where'=>$where]);
            $this->repository->pushCriteria($order_status);
        }
        $result = $this->repository->paginate();
        return [
            'items'=> $result->getCollection(),
            'total'=> $result->total()
        ];
        //下面的参考一下。字段没加全
//         return [
//             'items'=>[
//                 [
//                     'id'=> 1,
//                     'account'=> 'gfsdg',
//                     'realname'=> 'gsggs',
//                     'department_name'=>'hdfhd',
//                     'head'=>'gdfg',
//                     'qq'=> 'gdfh',
//                     'role'=> 'ndfhdf',
//                     'sex'=> '男' || '女',
//                     'phone'=> '132465465',
//                     'mphone'=> '23131',
//                     'remark'=>'hdghdf',
//                     'status'=>'hdfhd',
//                     'id_card'=>'dfjkhg',
//                     'qq_nickname'=>'fghdf',
//                     'weixin'=>'jfdj',
//                     'weixin_nikname'=>'kldfhgkdf',
//                     'address'=>'jfgjf',
//                     'ip'=>'192.168.0.10',
//                     'location'=>'ohigfdgjk',
//                     'lg_time'=>'2017-12-02',
//                     'out_time'=>'2017-12-02',
//                     'created_at'=>'2017-12-02',
//                     'creator'=>'fjkgjkf',
//                 ]
//             ],
//             'total'=>400
//         ];
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