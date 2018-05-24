<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\AssignRepository;
use App\Repositories\Criteria\FieldEqual;
use App\Repositories\Criteria\FieldLike;
use App\Alg\ModelCollection;
use App\Events\Signatured;
use App\Models\Assign;
use App\Models\Communicate;

class CommunicateController extends Controller{
    public function index(Request $request){
        $data = [];
        $model = new Communicate();
        if($request->has('assign_id')){
            $data = $model->where('assign_id',$request->input('assign_id'))->get();
        }
        return ['items'=>$data,'total'=>count($data)];
    }
}
