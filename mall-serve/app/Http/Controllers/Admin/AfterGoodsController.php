<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AfterSaleGoods;
use App\Alg\ModelCollection;

class AfterGoodsController extends Controller
{
    public function index(Request $request)
    {
        $builder = new AfterSaleGoods();
        
        if ($request->has('cus_id')) {
            $cus_id = $request->input('cus_id');
            $builder = $builder->with(['afterSale'=>function($query) use($cus_id){
                $query->where('cus_id', $cus_id);
            }]);
        }
        
        $result = $builder->paginate($request->input('page', 1000));
        
        $collection = $result->getCollection();
        
        if ($request->has('appends')) {
            ModelCollection::setAppends($collection, $request->input('appends'));
        }
        return [
            "items" => $collection,
            "total" => $result->total()
        ];
    }
}
