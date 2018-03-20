<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request)
    {
        $query = Article::orderBy('id', 'desc');
        
        if ($request->has('title')){
        	$query->where('title','like', $request->input('title')."%");
        }
        
        $re = $query->paginate(20);
        
        return [
        		'items' => $re->items(),
        		'total' => $re->total()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = Article::create($request->all());
        if ($model) {
        	return $this->success($model);
        } else {
        	return $this->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $article = Article::find($id);
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->image = $request->input('image');

        $re = $article->save();
        if ($re) {
            return $this->success($re);
        } else {
            return $this->error($re);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $re = Article::destroy($id);
        if ($re) {
        	return $this->success($re);
        } else {
        	return $this->error($re);
        }
    }






}
