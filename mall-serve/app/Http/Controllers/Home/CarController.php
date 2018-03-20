<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends CommonController
{
    //
    public function index(){
        return view('home/car/index',['bar'=>static::$bar]);
    }
}
