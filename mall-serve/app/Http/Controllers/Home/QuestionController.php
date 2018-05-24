<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends CommonController
{
    //
    public function index(){
        return view('home/question/index',['bar'=>static::$bar]);
    }
}
