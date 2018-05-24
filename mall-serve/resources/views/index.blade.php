<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', '商城') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="shortcut icon" href="/32.ico" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper.min.css"/>
    <link rel="stylesheet" href="css/home/index/index.css"/>
    <link rel="stylesheet" href="css/home/index/iconfonts.css"/>
</head>
<body>
<!--导航-->
@include("home.nav")
<!--/ 导航-->

<div id="banner" class="indexContent">
        <img src="/images/home/index/banner.jpg">
        {{--<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12 col-sm-12">--}}
            {{--<div class=" bannerBox col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12" style="height: 100%;padding: 0">--}}
                {{--<div class="swiper-container2" style="width: 100%;height: 100%">--}}
                    {{--<div class="swiper-wrapper">--}}
                        {{--<div class="swiper-slide">--}}
                            {{--<img class="imgs" src="images/home/index/banner1.png" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="swiper-slide">--}}
                            {{--<img class="imgs" src="images/home/index/banner2.png" alt="">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="swiper-pagination"></div>--}}
                    {{--<div class="swiper-button-prev"></div>--}}
                    {{--<div class="swiper-button-next"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
</div>

<div class="container ">

    <div class="row" >
    	<div id="minBanner">
            <div class="imgBox col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{URL('product/index?type=new')}}">
                    <img width="100%" src="images/home/index/minBanner/1.png" alt="">
                </a>
            </div>
            <div class="imgBox col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{URL('product/index?type=sale')}}">
                    <img width="100%" src="images/home/index/minBanner/2.png" alt="">
                </a>
            </div>
            <div class="imgBox col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{URL('product/index?type=wakeup')}}">
                    <img width="100%" src="images/home/index/minBanner/3.png" alt="">
                </a>
            </div>
            <div class="imgBox col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <a href="{{URL('product/index?type=youth')}}">
                    <img width="100%" src="images/home/index/minBanner/4.png" alt="">
                </a>
            </div>
        </div>
    </div>
    
    <div class="row" >
    	<div id="productList">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 list">
                <a href="{{URL('sale/stars')}}">
                    <img src="/images/home/index/leftsidebar.jpg" alt="">
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 list">
                <a href="{{URL('sale/stars?type=youth')}}">
                    <img src="/images/home/index/rightsidebar.jpg" alt="">
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div id="content">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newProduct">
                <div class="newT col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <span class="line"></span>
                        <span >新品首发 The new start</span>
                    </div>
                    <div class="right col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-xs-6">
                        <a href="{{URL('product/index?type=new')}}">
                            查看全部>
                        </a>
                    </div>
                </div>
                <div class="newC col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <img src="images/home/index/new/leftnew.jpg" alt="">
                    </div>
                    <div class="right col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    	@foreach($newGoods as $goods)
                    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 imgBox">
                            <a href="{{URL("product",['id'=>$goods->id])}}" title="{{$goods->goods_name}}">
                                <img src="{{$goods->cover_url}}" alt="">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 msg">
                                    <div class="goodsName col-lg-12 col-md-12 col-sm-12 col-xs-12">{{$goods->goods_name}}</div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price">￥{{$goods->goods_price}}</div>
                                </div>
                            </a>
                        </div>
                    	@endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newProduct">
                <div class="newT col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <span class="line"></span>
                        <span >畅销精品 Best-selling products</span>
                    </div>
                    <div class="right col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-xs-6">
                        <a href="{{URL('product/index?type=new')}}">
                            查看全部>
                        </a>
                    </div>
                </div>
                <div class="newC col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-5 col-md-5 col-sm-6 col-xs-12">
                        <img src="images/home/index/product/selling.jpg" alt="">
                    </div>
                    <div class="right col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    	@foreach($hotGoods as $goods)
                    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 imgBox">
                            <a href="{{URL("product",['id'=>$goods->id])}}" title="{{$goods->goods_name}}">
                                <img src="{{$goods->cover_url}}" alt="">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 msg">
                                    <div class="goodsName col-lg-12 col-md-12 col-sm-12 col-xs-12">{{$goods->goods_name}}</div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price">￥{{$goods->goods_price}}</div>
                                </div>
                            </a>
                        </div>
                    	@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
 @include("home.sidetool")
@include("home.navBottom")


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/swiper.min.js"></script>
<script>
    $(document).ready(function () {
        var flag = true;
        function IsPC() {
            var userAgentInfo = navigator.userAgent;
            var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone"];
            for (var v = 0; v < Agents.length; v++) {
                if (userAgentInfo.indexOf(Agents[v]) > 0) {
                    flag = false;
                    break;
                }
            }
        }
        var num=5;
        IsPC();
        if(!flag){
            num=1
        }
        /*----轮播插件----*/
        var mySwiper=new Swiper('#banner .swiper-container2',{
            direction:'horizontal',
            loop:true,
            //前进后退按钮
            navigation:{
                nextEl:'.swiper-button-next',
                prevEl:'.swiper-button-prev'
            },
            //分页器
            pagination:{
                el:'.swiper-pagination'
            },
            autoplay:{
                delay:5000,
                stopOnLastSlide:false,
                disableOnInteraction:true
            }
        });
        var mySwiper1=new Swiper('#newProduct .swiper-container1',{
            direction:'horizontal',
            loop:true,
            //前进后退按钮
            navigation:{
                nextEl:'.swiper-button-next',
                prevEl:'.swiper-button-prev'
            },
            //分页器
            autoplay:{
                delay:5000,
                stopOnLastSlide:false,
                disableOnInteraction:true
            },
            slidesPerView:num,
        });
        /*---------------*/
        var flg=true
        /*$('#navBut').on('touchend',function () {
            $('#ul li a').addClass('navC')
        })
        $('#ul li a').on('click',function () {
            $('#ul li a').removeClass('sta')
            $(this).addClass('sta')
        })*/
        /*---------------菜单鼠标事件*/
        $('#ul li a').hover(function () {
            $('#ul li a div').removeClass('line')
            $(this).children('div').addClass('line')
        })
        $('#ul').mouseleave(function () {
            var flg=true
            $('#ul li a').each(function () {
                if($(this).hasClass('sta')){
                    $('#ul li a div').removeClass('line')
                    $(this).children('div').addClass('line')
                    flg=false
                }
            })
            if(flg){
                $('#ul li a div').removeClass('line')
            }
        })
        $('#buyC').click(function (e) {
            flg=true
            if($('#buyCar').css('display')=='none'){
                $('#buyCar').fadeIn(100);
                $('#myCenter').fadeOut(10)
            }else{
                $('#buyCar').fadeOut(10)
            }
        })
        $('#loginBar .countP').click(function (e) {
            if($('#myCenter').css('display')=='none'){
                $('#myCenter').fadeIn(100);
                $('#buyCar').fadeOut(10)
            }else{
                $('#myCenter').fadeOut(10)
            }
        })
        $('#goTo').click(function () {
            window.location.href="{{URL('car/index')}}"
        })
        $('.buyList .del').click(function () {
            flg=false
        })
        $(document.body).click(function (e) {
            var ee=e.srcElement?e.srcElement:e.target
            if(ee.id!='countP'){
                $('#myCenter').fadeOut(10)
            }
            if(ee.id!='buyC'&&flg){
                $('#buyCar').fadeOut(10)
            }
        });
        //监听滚动条
        $(window).scroll(function () {
            var top=$(document).scrollTop();
            if(top>=200){
                $('.personBar').fadeOut('slow');
            }else{
                $('.personBar').fadeIn('fast')
            }
        });
        $('#scrollTop').on('click',function () {
            $(document).scrollTop(0);
        })
        //搜索点击事件
        $('#souI').click(function(event) {
            var seachText = $('#searchB').val();
            if(seachText){
                window.location.href="{{URL('product/index?seachText=')}}"+seachText;
            }
        });
    })
</script>
</body>
</html>
