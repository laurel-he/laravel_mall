<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;

class SaleController extends CommonController
{
    //
    public  function index(){
        static::$bar['bar4']='sta';
        static::$bar['line4']='line';
        
        $allgoods = Goods::active()->get(['id','cover_url','goods_name','goods_price','new_goods','hot_goods']);
        return view('home/sale/index',['bar'=>static::$bar, 'allGoods'=>$allgoods]);
    }
    public  function stars(Request$request){
        $type=['wakeup'=>'','youth'=>''];
        $type[$request->input('type','wakeup')]='active';
        $yt=$request->input('type','wakeup');
        static::$bar['bar6']='sta';
        static::$bar['line6']='line';
        $allgoods = Goods::active()->get(['id','cover_url','goods_name','goods_price','new_goods','hot_goods']);
        return view('home/sale/stars',['bar'=>static::$bar,'type'=>$type,'yt'=>$yt, 'allGoods'=>$allgoods]);
    }
}
