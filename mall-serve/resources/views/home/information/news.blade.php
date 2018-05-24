@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/information/news.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newsContent">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lle">
            <div class="col-l2 col-md-12 col-sm-12 col-xs-12 llf">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftContent">
						<div class="leftBanner col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<img src="/images/home/information/ml_banner.jpg" alt="">
						</div>
						 @foreach ($articles as $article)

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftLists">
    							<a href="{{url("information", ['id'=>$article->id])}}" target="_blank">
    								<div class="imgBox col-lg-4 xol-md-5 col-sm-6 col-xs-12">
    									<img src="{{ $article->image }}" alt="">
    								</div>
    								<div class="msgBox col-lg-8 xol-md-7 col-sm-6 col-xs-12">
    									<div class="bigTit col-lg-12 col-md-12 col-sm-12 col-xs-12">
    										{{ $article->title }}
    									</div>
    									<div class="times col-lg-12 col-md-12 col-sm-12 col-xs-12">
    										<span>{{ $article->created_at }}</span>
<!--     										<span>浏览:26</span> -->
    									</div>
    									<div class="msgCon col-lg-12 col-md-12 col-sm-12 col-xs-12">
    										{{ $article->description }}...
    									</div>
    								</div>
    							</a>
    						</div>
					    @endforeach
<!-- 						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftLists"> -->
<!-- 							<a href="{{URL('information/newshow')}}"> -->
<!-- 								<div class="imgBox col-lg-4 xol-md-5 col-sm-6 col-xs-12"> -->
<!-- 									<img src="/images/home/information/ml_ggw.jpg" alt=""> -->
<!-- 								</div> -->
<!-- 								<div class="msgBox col-lg-8 xol-md-7 col-sm-6 col-xs-12"> -->
<!-- 									<div class="bigTit col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
<!-- 										邂逅Burberry全新包款 典就隽永英伦风华 -->
<!-- 									</div> -->
<!-- 									<div class="times col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
<!-- 										<span>2018-04-19</span> -->
<!-- 										<span>浏览:26</span> -->
<!-- 									</div> -->
<!-- 									<div class="msgCon col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
<!-- 										我们希望将DK&&打造成独居英伦隽永风格的包款系列，就像品牌标志性的Trench风衣一样，能够彰显并传递Burberry一直以来的品牌精神与态度。每只手袋都是用品牌底蕴深厚的Trench皮革精制而成的... -->
<!-- 									</div> -->
<!-- 								</div> -->
<!-- 							</a> -->
<!-- 						</div> -->


	


						<div class="leftPage col-lg-12 col-md-12 col-sm-12 col-xs-12">
						
						
							<nav id="navBars" aria-label="Page navigation">
							
								{{ $articles->links() }}
<!-- 								<ul id="pageNag" class="pagination"> -->
<!-- 									<li> -->
<!-- 										<a href="#"> -->
<!-- 											<span>首页</span> -->
<!-- 										</a> -->
<!-- 									</li> -->
<!-- 									<li> -->
<!-- 										<a href="#" aria-label="Previous"> -->
<!-- 											<span aria-hidden="true">上一页</span> -->
<!-- 										</a> -->
<!-- 									</li> -->
<!-- 									<li class="active"><a href="#">1</a></li> -->
<!-- 									<li><a href="#">2</a></li> -->
<!-- 									<li><a href="#">3</a></li> -->
<!-- 									<li><a href="#">4</a></li> -->
<!-- 									<li><a href="#">5</a></li> -->
<!-- 									<li> -->
<!-- 										<a href="#" aria-label="Next"> -->
<!-- 											<span aria-hidden="true">下一页</span> -->
<!-- 										</a> -->
<!-- 									</li> -->
<!-- 									<li> -->
<!-- 										<a href="#"> -->
<!-- 											<span>末页</span> -->
<!-- 										</a> -->
<!-- 									</li> -->
<!-- 									<li> -->
<!-- 										<a href="#"> -->
<!-- 											<span>共200条</span> -->
<!-- 										</a> -->
<!-- 									</li> -->
<!-- 								</ul> -->
							</nav>
						</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightContent">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightTit">
							一周热点资讯
							<div class="line"></div>
						</div>
						@foreach ($articles2 as $article)
    						<div class="rightList col-lg-12 col-md-12 col-sm-12 col-xs-12">
    							<div class="imgBox col-lg-3 col-md-4 col-sm-4 col-xs-4">
    								<img src="{{ $article->image }}" alt="">
    							</div>
    							<div class="msgBox col-lg-9 col-md-8 col-sm-8 col-xs-8">
    								{{ $article->title }}
    							</div>
    						</div>
					    @endforeach

<!-- 						<div class="rightList col-lg-12 col-md-12 col-sm-12 col-xs-12"> -->
<!-- 							<div class="imgBox col-lg-3 col-md-4 col-sm-4 col-xs-4"> -->
<!-- 								<img src="/images/home/information/ml_xggw.jpg" alt=""> -->
<!-- 							</div> -->
<!-- 							<div class="msgBox col-lg-9 col-md-8 col-sm-8 col-xs-8"> -->
<!-- 								原来被大家叫做女神的韩雪心中也有自己的女神！虽然已经... -->
<!-- 							</div> -->
<!-- 						</div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection