<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $returnMsg = ['status'=>1, 'msg'=>'操作成功', 'data'=>null ];
    
    private function  getReturnMsg($data, $msg = null) 
    {
        $returnMsg = $this->returnMsg;
        if ($msg) {
            $returnMsg['msg'] = $msg;
        }
        $returnMsg['data'] = $data;
        return $returnMsg;
    }
    
    protected function success($data, $msg=null)
    {
        $succesMsg = $this->getReturnMsg($data, $msg);
        $succesMsg['status'] = 1;
        return $succesMsg;
    }
    
    protected function error($data, $msg=null) 
    {
        $succesMsg = $this->getReturnMsg($data, $msg);
        $succesMsg['status'] = 0;
        return $succesMsg;
    }
}
