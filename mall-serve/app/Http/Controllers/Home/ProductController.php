<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\Models\Goods;

class ProductController extends CommonController
{
    //
    public function index(Request $request){
        static::$bar['bar2']='sta';
        static::$bar['line2']='line';
        $type=array('sale'=>'','youth'=>'','wakeup'=>'','new'=>'');
        $type[$request->input('type','new')]='actionBar';
        $name=array('sale'=>'畅销产品','youth'=>'青春系列','all'=>'全部','wakeup'=>'焕肤紧致系列','new'=>'新品首发');

        $goodsModel = new Goods;
        if($request->has('seachText')){
            $goodsModel = $goodsModel->where('goods_name', 'like', '%'.$request->input('seachText').'%');
        }

        $goods = $goodsModel->select(['id','goods_name','goods_price','del_price','new_goods','cover_url'])->active()->get();
        $gust = $goodsModel->select(['id','goods_name','goods_price','del_price','new_goods','cover_url'])->active()->inRandomOrder()->limit(8)->get();

        return view('home/product/index',['bar'=>static::$bar, 'goods'=>$goods, 'gust'=>$gust,'type'=>$type,'name'=>$name[$request->input('type','all')]]);
    }

    
    public function product(Request $request, $id){
        static::$bar['bar2']='sta';
        static::$bar['line2']='line';
        
        $goods = Goods::with(['category','imgs','derectAttr'])->active()->findOrFail($id);
        $goods->derectAttr->load('spec');
        $this->setAttrGroup($goods);
        
        //推荐
        $recoms = Goods::select(['id','cover_url','goods_name','sale_count','goods_price'])->limit(6)->get();
        return view('home/product/product',['bar'=>static::$bar, 'goods'=>$goods, 'recoms'=>$recoms]);
    }
    
    /**
     * 这个应该抽离出去 不应该写在这里
     */
    private function setAttrGroup($model)
    {
        $group = [];
        foreach ($model->derectAttr as $sku) {
            if (!isset($group[$sku->spec->id])) {
                $group[$sku->spec->id] = $sku->spec;
                $group[$sku->spec->id]->attr = [];
            }
            $attr = $group[$sku->spec->id]->attr;
            $attr[] = ['value'=>$sku->value, 'addon_value'=>$sku->addon_value];
            $group[$sku->spec->id]->attr = $attr;
        }
        $model->groupAttr = $group;
    }
}
