<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CustomerUser;
class PlanController extends Controller
{

    public function update(Request $request)
    {
            var_dump($request->input());
        $re = CustomerUser::where('id',$request->input('id'))->update($request->input());
        if ($re) {
            return $this->success(1);
        } else {
            return $this->error(0);
        }
    }
}
