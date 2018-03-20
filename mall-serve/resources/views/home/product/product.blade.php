@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/swiper.min.css">
    <link rel="stylesheet" href="/css/home/product/product.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productBar">
        <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 lle">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 lle">
                <a style="color: #333" href="/">首页</a>&nbsp;&nbsp;<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>&nbsp;&nbsp;
                <a style="color: #666" href="{{ url('product/index') }}">全部产品</a>&nbsp;&nbsp;<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>&nbsp;&nbsp;
                <span style="color: #2F9F6D">{{ $goods->goods_name }}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productInfo">
        <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 lle">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 lle">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 proLef">
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                        @if($goods->imgs)
                        	@foreach($goods->imgs as $img)
                        	<div class="swiper-slide" style="background-image:url({{ asset($img->url) }})"></div>
                        	@endforeach
                        @else
                        	<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/1)"></div>
                        @endif
                           
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                        	@if($goods->imgs)
	                        	@foreach($goods->imgs as $img)
	                        	<div class="swiper-slide" style="background-image:url({{ asset($img->url) }})"></div>
	                        	@endforeach
	                        @else
	                        	<div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/1)"></div>
	                        @endif
                            
                        </div>
                    </div>
                    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 topLef"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></div>
                        <div id="maxImg" class="col-lg-10 col-md-10 col-sm-10 col-xs-10 topImg">
                            <img src="__ROOT__/static/images/home/product/product.jpg" style="width: 100%" alt="">
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 topRig"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bot">
                        <div id="minImg" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 botI">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 imgB sta"></div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 botI">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 imgB"></div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-5 botI">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 imgB"></div>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 proRig">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigTit">
                        {{$goods->goods_name}}
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigFun">
                        {{ $goods->subtitle }}
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigDes">
                        {!! nl2br($goods->brief) !!}
                    </div>
<!--                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigLis"> -->
<!--                         <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>&nbsp;洗面奶100ML*1 -->
<!--                     </div> -->
<!--                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigLis"> -->
<!--                         <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>&nbsp;洗面奶100ML*1 -->
<!--                     </div> -->
<!--                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigLis"> -->
<!--                         <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>&nbsp;洗面奶100ML*1 -->
<!--                     </div> -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigPri">
                        <span style="color: red;font-size: 24px">特价：{{ $goods->goods_price }}元</span>&nbsp;&nbsp;&nbsp;
                        <!--  
                        <span style="color: #333;font-size: 18px">原价：199元</span>
                        -->
                    </div>
<!--                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigNum"> -->
<!--                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 left"> -->
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="font-size: 16px;color: #666">型号： {{ $goods->goods_number }}</div>
<!--                             <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9"> -->
<!--                                 <input id="productNumber" type="number" class="productNumber" value="0"> -->
<!--                                 <div id="increase" class="increase">-</div> -->
<!--                                 <div id="decrease" class="decrease">+</div> -->
<!--                             </div> -->
<!--                         </div> -->
<!--                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 right"> -->
<!--                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">收藏：</div> -->
<!--                         </div> -->
<!--                     </div> -->
<!--                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigAct"> -->
<!--                         <div class="col-lg-3 col-md-4 col-sm-5 col-xs-5 buyNow">立即购买</div> -->
<!--                         <div class="col-lg-3 col-md-4 col-sm-5 col-xs-5 addStore">加入购物车</div> -->
<!--                     </div> -->
<!--                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigShare"> -->
<!--                         分享到 -->
<!--                     </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productContent">
        <div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12 lle">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftCon">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productTit">产品介绍</div>
                    {!! $goods->description !!}
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightCon">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productTit">相关产品</div>
                    
                    
                    @foreach($allgoods as $g)
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 productLis">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proImg">
                            <img src="{{ asset($g->cover_url) }}"  alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">{{ $g->goods_name }}</div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price">{{ $g->goods_price }}元</div>
                    </div>
                    @endforeach
                    


                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/js/swiper.jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#increase').on('click',function () {
                var num=$('#productNumber').val()
                if(num>0){
                    num-=1
                    $('#productNumber').val(num)
                }
            })
            $('#decrease').on('click',function () {
                var num=parseInt($('#productNumber').val())
                if(isNaN(num)){
                    num=0
                }
                $('#productNumber').val(num+=1)
            })
            var galleryTop = new Swiper('.gallery-top', {
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                spaceBetween: 10,
                loop:true,
                loopedSlides: 5, //looped slides should be the same
            });
            var galleryThumbs = new Swiper('.gallery-thumbs', {
                spaceBetween: 10,
                slidesPerView: 4,
                touchRatio: 0.2,
                loop:true,
                loopedSlides: 5, //looped slides should be the same
                slideToClickedSlide: true
            });
            galleryTop.params.control = galleryThumbs;
            galleryThumbs.params.control = galleryTop;
        })
    </script>
@endsection