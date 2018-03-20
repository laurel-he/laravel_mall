<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
class IndexController extends CommonController
{
    //
    public function index(){
        static::$bar['bar1']='sta';
        static::$bar['line1']='line';
        
        $allgoods = Goods::all(['id','cover_url']);
        return view('index',['bar'=>static::$bar, 'allgoods'=>$allgoods]);
    }
}
