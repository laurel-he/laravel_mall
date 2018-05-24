<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConnectionController extends CommonController
{
    //
    public function index(){
        static::$bar['bar7']='sta';
        static::$bar['line7']='line';
        return view('home/connection/index',['bar'=>static::$bar]);
    }
    
    public function technology(){
        return view('home/connection/technology',['bar'=>static::$bar]);
    }
}
