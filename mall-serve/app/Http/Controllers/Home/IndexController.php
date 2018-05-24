<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
class IndexController extends CommonController
{
    private $goodsBuilder = null;
    public function __construct()
    {
        $this->goodsBuilder = new Goods();
    }
    //
    public function index(){
        static::$bar['bar1']='sta';
        static::$bar['line1']='line';
        
        $indexModelFields = ['id','cover_url','goods_price','goods_name'];
        
        $allgoods = Goods::all(['id','cover_url']);
        
        $newGoods = $this->goodsBuilder->active()->where([['new_goods',1]])->orderBy('id','desc')->limit(6)->select($indexModelFields)->get();
        $hotGoods = $this->goodsBuilder->active()->where([['hot_goods',1]])->orderBy('id','desc')->limit(6)->select($indexModelFields)->get();
        
        return view('index',['bar'=>static::$bar, 'newGoods'=>$newGoods, 'hotGoods'=>$hotGoods]);
    }
}
