<?php
namespace App\Services\Ordergoods;

use App\Repositories\OrdergoodsRepository;
use Illuminate\Http\Request;
use App\Repositories\Criteria\Ordergoods\Ordergoods;
use App\Repositories\Criteria\FieldEqual;
use App\Repositories\Criteria\Ordergoods\Enterpot;
use App\Repositories\Criteria\Ordergoods\DateRange;
class CustomerService
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
        
        if ($this->request->has('cus_id')) {
            $cus_id = $this->request->input('cus_id');
            $this->repository->with(['order'=>function($query) use($cus_id){
                $query->where('cus_id', $cus_id);
            }]);
        }
        
        

        return [
            'items'=> $collection->toArray(),
            'totle'=> $result->total()
        ];
    }
}
