@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/information/news.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newsContent">
        <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 lle">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 llf">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftContent">
	                   
	                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftCos">
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pic">
	                            	<img alt="" style="height: 300px;width: 100%;" src="{{ $article->image }}">
	                            </div>
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">{{ $article->title }}</div>
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 con">{!! $article->body !!}</div>
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dat">{{ $article->created_at }}   
	                            </div>
	                        </div>	        
					    

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightContent">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightTit">为你推荐</div>
                         @foreach ($articles as $article)
	                    	
	                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 rightCon">
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 left">
	                            	<img alt="{{ $article->title }}" style="max-width:120px" src="{{ $article->image }}">
	                            </div>
	                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right">
	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">{{ $article->title }}</div>
	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dat">{{ $article->created_at }}</div>
	                            </div>
	                        </div>
					    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection