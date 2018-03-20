@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/information/news.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newsBanner">
        <img src="/images/home/product/banner.jpg" style="width: 100%;" alt="">
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newsContent">
        <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 lle">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 llf">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftContent">
	                    @foreach ($articles as $article)
	                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftCos">
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pic">
	                            	<img alt="" style="height: 300px;width: 100%;" src="{{ $article->image }}">
	                            </div>
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">{{ $article->title }}</div>
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 con">{{ $article->description }}</div>
	                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dat">{{ $article->created_at }}   
<!-- 	                            	李老师   浏览：1854 -->
	                            </div>
	                        </div>
					        
					        
					        
					    @endforeach
                        
<!--                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftCos"> -->
<!--                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pic"></div> -->
<!--                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">谈谈肌肤的压力</div> -->
<!--                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 con">知道吗，其实你的肌肤和你一样，面对空气、辐射等，每天都压力山大！知道吗，其实你的肌肤和你一样，面对空气、辐射等，每天都压力山大！知道吗，其实你的肌肤和你一样，面对空气、辐射等，每天都压力山大！</div> -->
<!--                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dat">2017-10-12   李老师   浏览：1854</div> -->
<!--                         </div> -->
                        
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
<!-- 	                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 scan">浏览量：1558</div> -->
	                            </div>
	                        </div>
					    @endforeach
<!--                         <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 rightCon"> -->
<!--                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 left"></div> -->
<!--                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 right"> -->
<!--                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">一大堆标题水电费</div> -->
<!--                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dat">2017-10-12</div> -->
<!--                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 scan">浏览量：1558</div> -->
<!--                             </div> -->
<!--                         </div> -->
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection