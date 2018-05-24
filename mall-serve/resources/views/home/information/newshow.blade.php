@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/information/newshow.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newsContent">
    	<div class="row">
    		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 leftContent">
                <div class="contentShow col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bigTitle col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{$article->title}}
                    </div>
                    <div class="timeZone col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span>{{$article->created_at}}</span>
                        <span>来源互联网</span>
                        <span>评论：0</span>
                        <span>已有0人阅读</span>
                    </div>
                    <div class="content col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span class="daodu">导读：{{$article->description}}</span>
                        
                        {!! $article->body !!}
                    </div>
                </div>
                <div class="proNext col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="pre col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    @if($prev)
                    <a href="{{url('information', ['id'=>$prev->id])}}">
                            上一篇：{{ $prev->title }}
                        </a>
                    @endif
                    </div>
                    <div class="next col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    @if($next)
                    <a href="{{url('information', ['id'=>$next->id])}}">
                            下一篇：{{ $next->title }}
                        </a>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rightContent">
            	<div class="rightBackgroun">
                	<div class="rightTit">
                        一周热点资讯
                        <div class="line"></div>
                    </div>
               			 @foreach ($articles as $article)
    						<div class="rightList">
    					
        					<div class="imgBox col-lg-3 col-md-4 col-sm-4 col-xs-4">
        						<img src="{{ $article->image }}" alt="">
        					</div>
        					<div class="msgBox col-lg-9 col-md-8 col-sm-8 col-xs-8">
        						{{ $article->title }}
        					</div>
    						</div>
    		   			 @endforeach
            	</div>
            </div>
    	</div>
    	
        
        
        
       
    </div>
@endsection
@section('js')

@endsection