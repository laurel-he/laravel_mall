<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Inventory;

class EntrepotProductController extends Controller
{   
    /**
     * 获取仓库里面的商品可销售的数量
     * 
     * @param Request $request
     * @param String sku_sn
     * 
     * @return int
     */
    public function getEntrepotProductCount(Request $request, $sku_sn)
    {
        $user= auth()->user();
        if (empty($user->department_id)) {
            return ['num'=>0];
        }
        
        if (empty($user->department->entrepot_id)) {
            return ['num'=>0];
        }
        
        $inventorySystem = new Inventory();
        $re = $inventorySystem->getProductCount($user->department->entrepot_id, $sku_sn);
        return ['num'=>$re];
    }
    
    
    public function idnex()
    {
        
    }
}
