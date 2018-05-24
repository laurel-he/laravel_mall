<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends CommonController
{
    //
    public function index(){
        return view('home/brand/index',['bar'=>static::$bar]);
    }
}
