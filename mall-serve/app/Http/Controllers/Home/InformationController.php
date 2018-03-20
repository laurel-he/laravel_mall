<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Article;

class InformationController extends CommonController
{
    //
    public function index(){
        static::$bar['bar5']='sta';
        static::$bar['line5']='line';

        return view('home/information/index',['bar'=>static::$bar]);
    }
    public function news(){
        static::$bar['bar6']='sta';
        static::$bar['line6']='line';
        $articles = Article::orderBy('id', 'desc')->paginate(15);
        return view('home/information/news',['bar'=>static::$bar, 'articles'=>$articles]);
    }
}
