<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CommonController extends Controller
{
    //
    static $bar=array('bar1'=>'','bar2'=>'','bar3'=>'','bar4'=>'','bar5'=>'','bar6'=>'','bar7'=>'','line1'=>'','line2'=>'','line3'=>'','line4'=>'','line5'=>'','line6'=>'','line7'=>'',);
    public function __construct()
    {
        if(session('isLogin')==''){
            session(array('isLogin'=>URL('login/index')));
        }
    }
}
