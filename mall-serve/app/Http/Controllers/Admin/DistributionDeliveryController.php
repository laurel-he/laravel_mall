<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assign;
class DistributionDeliveryController extends Controller
{

    public function index(Request $request)
    {
        $business = $request->query('business', 'default');
        $id = $request->input('id',0);
        if($request->input('id')){
            $model = Assign::where('id','=',$id);
            $fields = $request->input('fields','*');
        }
        $result = [];
        switch ($business) {
            case 'deliveryDetail':
                $result = $model->select($fields)->get();
                break;
            case 'tableData2':
                $result = $model->select($fields)->get();
                break;
            case 'tableData2':
                $result = $model->select($fields)->get();
                break;
            case 'deliveryAddress':
                $result = $model->select($fields)->get();
                break;
            case 'communication':
                $result = $model->select($fields)->get();
                break;
            case 'operation':
                $result = $model->select($fields)->get();
                break;
            default:
                $result = Assign::get();
                break;
        }
        
        return $result;
    }


}
