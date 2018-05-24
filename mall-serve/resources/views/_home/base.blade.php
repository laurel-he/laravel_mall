<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商城</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/swiper.min.css"/>
    <link rel="stylesheet" href="/css/home/index/index.css"/>
    <link rel="stylesheet" href="/css/home/index/iconfonts.css"/>
    @yield('css')
</head>
<body>
<!--导航-->
<nav id="navbar" class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personBar">
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div id="logo" class="">
                                <img src="/images/logo.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 loginActionBars">
                            <div role="presentation" class="col-lg-6 col-md-6 col-sm-6 searchBar">
                                <div id="searchBar">
                                    <input id="searchB" type="text" placeholder="输入搜索">
                                    <span id="souI" class="iconfonts icon-sousuo"></span>
                                </div>
                            </div>
                            <!-- 登录 -->
                            <div id="loginBar" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 barL">
                                    <a href="{{session('isLogin')}}">
                                        <span id="countP" class="iconfonts icon-person {{session('login')}}"></span>
                                    </a>
                                </div>

                                {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 barL">
                                    <a href="javascript:;">
                                        <span id="buyC" class="iconfonts icon-gouwuche1"></span>
                                    </a>
                                    <div id="buyNumber" class="buyNumber">0</div>
                                </div>--}}

                                <div id="myCenter" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 userImg">
                                        <img src="{{session('head_img')}}" alt="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 username">
                                        用户名
                                    </div>
                                    <a href="{{URL('person/index')}}">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <span class="glyphicon glyphicon-user"></span>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                个人中心
                                            </div>
                                        </div>
                                    </a>
                                    <a href="">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <span class="glyphicon glyphicon-list-alt"></span>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                我的订单
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{URL('person/index')}}">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <span class="glyphicon glyphicon-cog"></span>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                账户设置
                                            </div>
                                        </div>
                                    </a>
                                    <a href="{{URL('login/loginOut')}}">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                <span class="glyphicon glyphicon-off"></span>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                退出登录
                                            </div>
                                        </div>
                                    </a>
                                    <div class="tangle"></div>
                                </div>

                            </div>
                            <!-- / 登录  -->
                            <!-- 购物车 -->
                            <!-- <div id="buyCar" class="">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">购物车</div>
                                    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-12 totalBuy">
                                        共0件商品
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bottom">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 buyLists">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 buyList">
                                            <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-6 col-xs-offset-3 listL">
                                                <img src="" alt="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 listM">
                                                <div class="col-lg-12 col-md-12 col-sm-12 listName">商品名字</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 listV">商品属性</div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 listR">
                                                <div class="col-lg-12 col-md-12 col-sm-12 price">222229元</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 del">
                                                    <span class="glyphicon glyphicon-trash delete" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 buyList">
                                            <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-6 col-xs-offset-3 listL">
                                                <img src="" alt="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 listM">
                                                <div class="col-lg-12 col-md-12 col-sm-12 listName">商品名字</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 listV">商品属性</div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 listR">
                                                <div class="col-lg-12 col-md-12 col-sm-12 price">222229元</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 del">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 buyList">
                                            <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-6 col-xs-offset-3 listL">
                                                <img src="" alt="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 listM">
                                                <div class="col-lg-12 col-md-12 col-sm-12 listName">商品名字</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 listV">商品属性</div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 listR">
                                                <div class="col-lg-12 col-md-12 col-sm-12 price">222229元</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 del">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 buyList">
                                            <div class="col-lg-3 col-lg-offset-0 col-md-3 col-md-offset-0 col-sm-3 col-sm-offset-0 col-xs-6 col-xs-offset-3 listL">
                                                <img src="" alt="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 listM">
                                                <div class="col-lg-12 col-md-12 col-sm-12 listName">商品名字</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 listV">商品属性</div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 listR">
                                                <div class="col-lg-12 col-md-12 col-sm-12 price">222229元</div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 del">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 goBuy">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 goT">
                                            合计：11000.00元
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 goB">
                                            <div id="goTo">去购物车结算</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tangleBox">

                                </div>
                                <div class="tangle"></div>
                            </div> -->
                            <!-- / 购物车 -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 headBar">
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="col-xs-2 navbar-header" style="padding: 0">
                        <button id="navBut" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="nav" class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                        <div class="collapse navbar-collapse col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bs-example-navbar-collapse-1">
                            <ul id="ul" class="nav nav-justified">
                                <li role="presentation" class="active">
                                    <a href="{{URL('/')}}" class="{{$bar['bar1']}}">
                                        网站首页
                                        <div class="{{$bar['line1']}}"></div>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a class="dropdown-toggle {{$bar['bar3']}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        产品系列
                                        <span class="caret"></span>
                                        <div class="{{$bar['line3']}}"></div>
                                    </a>
                                    <ul class="dropdown-menu m-drop">
                                        <li><a href="{{URL('product/index?type=wakeup')}}">焕肤紧致系列</a></li>
                                        <li><a href="{{URL('product/index?type=youth')}}">青春凝时冻龄系列</a></li>
                                    </ul>
                                </li>
                                <li role="presentation">
                                    <a href="{{URL('product/index')}}" class="{{$bar['bar2']}}">
                                        全部产品
                                        <div class="{{$bar['line2']}}"></div>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="{{URL('brand/index')}}" class="{{$bar['bar4']}}">
                                        关于品牌
                                        <div class="{{$bar['line4']}}"></div>
                                    </a>
                                </li>
                                <li role="presentation"><a href="{{URL('information/index')}}" class="{{$bar['bar5']}}">
                                        肌肤诊断
                                        <div class="{{$bar['line5']}}"></div>
                                    </a></li>
                                <li role="presentation"><a href="{{URL('information/news')}}" class="{{$bar['bar6']}}">
                                        最新资讯
                                        <div class="{{$bar['line6']}}"></div>
                                    </a></li>
                                <li role="presentation"><a href="{{URL('connection/index')}}" class="{{$bar['bar7']}}">
                                        联系我们
                                        <div class="{{$bar['line7']}}"></div>
                                    </a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid indexContent">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productBanner">
            <img src="/images/home/product/banner.png" style="width: 100%;" alt="">
        </div>
        @yield('content')
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 navBottom">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 navBot">
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">关于普拉她</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">品牌故事</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">公司信息</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">美丽帮助</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">美丽资讯</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">技术资讯</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">客服电话：888-888888</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">QQ：123456</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">微信：</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">客户服务</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">退换货问题</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">购买问题</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">我的订单</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">我的美丽顾问</div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">联系我们</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">微商城</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">公众号：</div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 navNum">备案号：京P1235645465</div>
        </div>
        <div id="scrollTop">顶部</div>
    </div>
</div>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/swiper.min.js"></script>
<script>

    $(document).ready(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        })
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
        /*---------------*/
        var flg=true
        $('#navBut').on('touchend',function () {
            $('#ul li a').addClass('navC')
        })
        $('#ul li a').on('click',function () {
            $('#ul li a').removeClass('sta')
            $(this).addClass('sta')
        })
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
            if(top>=500){
                $('#scrollTop').fadeIn('fast')
            }else{
                $('#scrollTop').fadeOut('slow')
            }
        });
        $('#scrollTop').on('click',function () {
            $(document).scrollTop(0);
        })
    })
</script>
@yield('js')
</body>
</html>