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
        $articles2 = Article::orderBy('id', 'desc')->limit(10)->get();
        return view('home/information/news',['bar'=>static::$bar, 'articles'=>$articles, 'articles2'=>$articles2]);
    }
    
    public function detail($id)
    {
        static::$bar['bar6']='sta';
        static::$bar['line6']='line';
        $article = Article::findOrFail($id);
        $articles2 = Article::orderBy('id', 'desc')->limit(10)->get();
        $prev = Article::where('id','<',$id)->select(['id','title'])->first();
        $next = Article::where('id','>',$id)->select(['id','title'])->first();
        return view('home/information/newshow', ['article'=>$article, 'articles'=>$articles2, 'bar'=>static::$bar, 'prev'=>$prev, 'next'=>$next]);
    }
}
