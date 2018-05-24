@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/product/product.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productBar">
        <div class="lle">
            <a style="color: #333" href="/">首页</a>&nbsp;<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>&nbsp;
            <a style="color: #666" href="{{ url('product/index') }}">全部产品</a>&nbsp;
            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>&nbsp;
            @foreach($goods->category as $cat)
            	@if($loop->last)
            	<span style="color: #C3A46F">{{$cat->label}}</span>
            	@else
            	<a style="color: #666" href="{{ url('product/index') }}">{{$cat->label}}</a>&nbsp;
            	<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>&nbsp;
            	@endif
            @endforeach
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productInfo">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 proLef">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 view">
                        <div class="swiper-container first">
                            <a href="#" class="arrow-left"></a>
                            <a href="#" class="arrow-right"></a>
                            <div class="swiper-wrapper">
                                 @foreach($goods->imgs as $img)
                                    <div class="swiper-slide">
                                        <img src="{{$img->url}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="preview col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="#" class="arrow-left"></a>
                        <a href="#" class="arrow-right"></a>
                        <div class="swiper-container second">
                            <div class="swiper-wrapper">
                                @foreach($goods->imgs as $img)
                                    <div class="swiper-slide @if ($loop->first)
                                    							active-nav
                                							@endif">
                                        <img src="{{$img->url}}" alt="">
                                    </div>
                                @endforeach
                                
                            </div>
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
          <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 proRig">
                    <div class="proRigBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigTit">
                            {{$goods->goods_name}}
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigPrice">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="left col-lg-6 col-md-6 col-sm-4 col-xs-4">
                                    原价： <span class="llPrice">￥{{$goods->del_price}}</span>
                                </div>
                                <div class="right col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                    评价：{{$goods->comments}} 累积销量：{{$goods->sale_count}}
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                促销价： <span class="nowPrice">￥{{$goods->goods_price}}</span>
                                @if($goods->new_goods == 1)
                                <span class="nowMsg">新品限时促销</span>
                                @endif()
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                优惠券： <span class="lowTickets">新人立减10元</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 attr-box">
                        @foreach($goods->groupAttr as $attr)
                       	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 spec">
                            <div>{{$attr->name}}：</div>
                                @foreach($attr->attr as $item)
                                
                                	@if($item['addon_value'])
                                	<div class="colorBox">
									<img src="{{$item['addon_value']}}" width="76" height="76"/>
                                	@else
                                	<div class="specNum">
                                	{{$item['value']}}
                                	@endif
                                </div>
                                @endforeach
                        
                        </div>
                       	@endforeach
                       	</div>
<!--                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 attr-box"> -->
<!--                             <span>颜色：</span> -->
<!--                             <div class="colorBox"></div> -->
<!--                             <div class="colorBox"></div> -->
<!--                             <div class="colorBox"></div> -->
<!--                             <div class="colorBox"></div> -->
<!--                         </div> -->
<!--                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 spec"> -->
<!--                             <div>规格：</div> -->
<!--                             <div class="specNum"> -->
<!--                                 5件套 -->
<!--                                 <div class="cls"> -->
<!--                                     <span class="glyphicon glyphicon-ok " aria-hidden="true"></span> -->
<!--                                 </div> -->
<!--                             </div> -->
<!--                         </div> -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rigNum">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">
                                <div class="lefN">
                                    数量：
                                </div>
                                <div class="middleN">
                                    <input id="productNumber" type="number" class="productNumber" value="0">
                                    <div id="increase" class="increase">-</div>
                                    <div id="decrease" class="decrease">+</div>
                                </div>
                                <div class="repertory">库存：{{$goods->sale_able_count}}件</div>
                            </div>
                        </div>
                        <div class="shareBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="share">1512</div>
                            <div class="share">分享</div>
                        </div>
                        {{--<div class="buyBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
                                <div class="add buyNow col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    立即购买
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6">
                                <div class="add col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    加入购物车
                                </div>
                            </div>
                        </div>--}}
                        <div class="serviceBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div>服务承诺：</div>
                        </div>
                        <div class="payBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            支付方式：
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productContent">
       
           
                <div class="contentLeft col-lg-3 col-md-4 col-sm-5 col-xs-12">
                    <div class="title col-lg-12 col-md-12 col-sm-12 col-xs-12">相关推荐</div>
                    @foreach($recoms as $reItem)
                    <a href="{{URL('product', ['id'=>$reItem->id])}}">
                        <div class="lists col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="listBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="imgs col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{$reItem->cover_url}}" alt="">
                                </div>
                                <div class="listName col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{$reItem->goods_name}}
                                </div>
                                <div class="listPrice col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span class="price">￥{{$reItem->goods_price}}</span>
                                    </div>
                                    <div class="volum col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
                                        {{$reItem->sale_count}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                
                <div class="contentRight col-lg-9 col-md-8 col-sm-7 col-xs-12">
                    <div class="title col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="tabs actives">
                            商品详情
                            <div class="line"></div>
                        </div>
                        <div class="tabs">
                            累积评价
                            <span class="num">{{$goods->comments}}</span>
                        </div>
                    </div>
                    <div class="contentDetail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {!! $goods->description !!}
                        
                    </div>
                </div>
            
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#increase').on('click',function () {
                var num=$('#productNumber').val()
                if(num>0){
                    num-=1
                    $('#productNumber').val(num)
                }
            });
            $('#decrease').on('click',function () {
                var num=parseInt($('#productNumber').val())
                if(isNaN(num)){
                    num=0
                }
                $('#productNumber').val(num+=1)
            });
            var viewSwiper = new Swiper('.view .swiper-container', {
                on:{
                    slideChangeTransitionStart: function() {
                        updateNavPosition()
                    }
                }
            });

            $('.view .arrow-left,.preview .arrow-left').on('click', function(e) {
                e.preventDefault();
                if (viewSwiper.activeIndex == 0) {
                    viewSwiper.slideTo(viewSwiper.slides.length - 1, 1000);
                    return
                }
                viewSwiper.slidePrev()
            });
            $('.view .arrow-right,.preview .arrow-right').on('click', function(e) {
                e.preventDefault();
                if (viewSwiper.activeIndex == viewSwiper.slides.length - 1) {
                    viewSwiper.slideTo(0, 1000);
                    return
                }
                viewSwiper.slideNext()
            });

            var previewSwiper = new Swiper('.preview .swiper-container', {
                //visibilityFullFit: true,
                slidesPerView: 'auto',
                allowTouchMove: false,
                on:{
                    tap: function() {
                        viewSwiper.slideTo(previewSwiper.clickedIndex)
                    }
                }
            });

            function updateNavPosition() {
                $('.preview .active-nav').removeClass('active-nav');
                var activeNav = $('.preview .swiper-slide').eq(viewSwiper.activeIndex).addClass('active-nav');
                if (!activeNav.hasClass('swiper-slide-visible')) {
                    if (activeNav.index() > previewSwiper.activeIndex) {
                        var thumbsPerNav = Math.floor(previewSwiper.width / activeNav.width()) - 1;
                        previewSwiper.slideTo(activeNav.index() - thumbsPerNav)
                    } else {
                        previewSwiper.slideTo(activeNav.index())
                    }
                }
            }

        })
    </script>
@endsection