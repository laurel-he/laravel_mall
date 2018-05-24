<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商城</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper.min.css"/>
    <link rel="stylesheet" href="css/home/index/index.css"/>
    <link rel="stylesheet" href="css/home/index/iconfonts.css"/>
</head>
<body>
<!--导航-->
<nav id="navbar" class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personBar">
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="col-lg-4 col-lg-offset-8 col-md-4 col-md-offset-8 col-sm-6 loginActionBars">
                            <!-- 登录 -->
                            <div id="loginBar" class="col-lg-4 col-lg-offset-8 col-md-5 col-md-offset-7 col-sm-6 col-sm-offset-6 col-xs-8 col-xs-offset-4">
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
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 headBar">
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
                    <div id="logo" class="">
                        <img src="images/logo.png" alt="">
                    </div>
                    <div class="collapse navbar-collapse col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bs-example-navbar-collapse-1">
                        <ul id="ul" class="nav nav-justified">
                            <li role="presentation" class="active">
                                <a href="#" class="{{$bar['bar1']}}">
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
                            <li role="presentation" style="min-width: 120px">
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
                            <li role="presentation">
                            </li>
                            <div role="presentation" class="col-lg-4 col-md-4 col-sm-6 searchBar">
                                <div id="searchBar">
                                    <input id="searchB" type="text" placeholder="输入搜索">
                                    <span id="souI" class="iconfonts icon-sousuo"></span>
                                </div>
                            </div>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid indexContent">
    <div class="row">
        <div id="banner" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12 col-sm-12">
            <div class=" bannerBox col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12" style="height: 100%;padding: 0">
                <div class="swiper-container2" style="width: 100%;height: 100%">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img class="imgs" src="images/home/index/banner1.png" alt="">
                        </div>
                        <div class="swiper-slide">
                            <img class="imgs" src="images/home/index/banner2.png" alt="">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
        <div id="minBanner" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12 col-sm-12">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
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
        <div id="content" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
            <div id="newProduct" class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                <div class="newT col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <span class="line"></span>
                        <span >新品首发</span>
                    </div>
                    <div class="right col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-xs-6">
                        <a href="{{URL('product/index?type=new')}}">
                            查看全部>
                        </a>
                    </div>
                </div>
                <div class="newC col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <img src="images/home/index/new/1.png" alt="">
                    </div>
                    <div class="right col-lg-10 col-md-9 col-sm-8 col-xs-6">
                        <div class="swiper-container1" style="width: 100%;height: 100%">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/2.png" alt="">
                                        <div class="msg">
                                            <div>美白抗皱精华液</div>
                                            <div class="price">￥99.00</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/3.png" alt="">
                                        <div class="msg">
                                            <div>补水美白面膜</div>
                                            <div class="price">￥49.00/片</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/4.png" alt="">
                                        <div class="msg">
                                            <div>美白柔肤水</div>
                                            <div class="price">￥99.00</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/5.png" alt="">
                                        <div class="msg">
                                            <div>淡斑晚霜</div>
                                            <div class="price">￥99.00</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/6.png" alt="">
                                        <div class="msg">
                                            <div>美白补水洗面奶</div>
                                            <div class="price">￥99.00</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/2.png" alt="">
                                        <div class="msg">
                                            <div>美白抗皱精华液</div>
                                            <div class="price">￥99.00</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide imgBox">
                                    <a href="{{URL('product/product')}}">
                                        <img src="images/home/index/new/3.png" alt="">
                                        <div class="msg">
                                            <div>补水美白面膜</div>
                                            <div class="price">￥49.00/5片</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-button-prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></div>
                            <div class="swiper-button-next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="saleProduct" class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                <div class="saleT col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-2 col-md-2 col-sm-4 col-xs-12">
                        <span class="line"></span>
                        <span>畅销产品</span>
                    </div>
                    <div class="middle col-lg-8 col-md-8 col-sm-4 col-xs-12">
                        <div class="saleType saleAction">面膜</div>
                        <div class="saleType">护肤套装</div>
                        <div class="saleType">保湿水</div>
                        <div class="saleType">精华液</div>
                    </div>
                    <div class="right col-lg-2 col-md-2 col-sm-4 col-xs-12">
                        <a href="{{URL('product/index?type=sale')}}">
                            查看全部>
                        </a>
                    </div>
                </div>
                <div class="saleContent col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-3 col-md-3 col-sm-4 col-xs-12">
                        <img src="images/home/index/sale/0.png" alt="">
                    </div>
                    <div class="right col-lg-9 col-md-9 col-sm-8 col-xs-12">
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/1.png" alt="">
                                <div class="mes">
                                    <div>补水面膜</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/2.png" alt="">
                                <div class="mes">
                                    <div>美白补水套装</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/3.png" alt="">
                                <div class="mes">
                                    <div>美白抗皱精华液</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/4.png" alt="">
                                <div class="mes">
                                    <div>普拉她花颜舒柔多效修护调理精华液</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/5.png" alt="">
                                <div class="mes">
                                    <div>蔚蓝之美五谷臻萃元气精华液</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/6.png" alt="">
                                <div class="mes">
                                    <div>美白补水洁面乳</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/7.png" alt="">
                                <div class="mes">
                                    <div>普拉她换白美肌宠爱套装</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="imgB col-lg-3 col-md-4 col-sm-6 col-xs-6">
                                <img src="images/home/index/sale/8.png" alt="">
                                <div class="mes">
                                    <div>密集修护面膜套装</div>
                                    <div class="price">￥99.00</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="wakeUpSkin" class="contentBox col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                <div class="newT col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span class="line"></span>
                        <span>焕肌紧致系列</span>
                    </div>
                    <div class="right col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <a href="{{URL('product/index?type=wakeup')}}">
                            查看全部>
                        </a>
                    </div>
                </div>
                <div class="contentCls col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <img src="images/home/index/wakeup/0.png" alt="">
                    </div>
                    <div class="right col-lg-10 col-md-9 col-sm-8 col-xs-12">
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/wakeup/1.png" alt="">
                                <div class="msgB">
                                    <div>美白抗皱精华液</div>
                                    <div>￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/wakeup/2.png" alt="">
                                <div class="msgB">
                                    <div>补水美白面膜</div>
                                    <div>￥49.00/5片</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/wakeup/3.png" alt="">
                                <div class="msgB">
                                    <div>美白柔肌水</div>
                                    <div>￥99.00</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div id="youth" class="contentBox col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                <div class="newT col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <span class="line"></span>
                        <span>青春凝时冻龄系列</span>
                    </div>
                    <div class="right col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <a href="{{URL('product/index?type=youth')}}">
                            查看全部>
                        </a>
                    </div>
                </div>
                <div class="contentCls col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="left col-lg-2 col-md-3 col-sm-4 col-xs-6">
                        <img src="images/home/index/youth/0.png" alt="">
                    </div>
                    <div class="right col-lg-10 col-md-9 col-sm-8 col-xs-12">
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/youth/1.png" alt="">
                                <div class="msgB">
                                    <div>补水美白面膜</div>
                                    <div>￥49.00/5片</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/youth/2.png" alt="">
                                <div class="msgB">
                                    <div>美白柔肤水</div>
                                    <div>￥99.00</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/youth/3.png" alt="">
                                <div class="msgB">
                                    <div>淡斑晚霜</div>
                                    <div>￥99.00</div>
                                </div>
                            </div>

                        </a>
                        <a href="{{URL('product/product')}}">
                            <div class="proBox">
                                <img src="images/home/index/youth/4.png" alt="">
                                <div class="msgB">
                                    <div>美白补水洗面奶</div>
                                    <div>￥99.00</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="bag" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
            <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                <a href="{{URL('brand/index')}}">
                    <div class="left col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/home/index/bg2.png" alt="">
                    </div>
                </a>
                <a href="{{URL('information/index')}}">
                    <div class="right col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <img src="images/home/index/bg1.png" alt="">
                    </div>
                </a>
            </div>
        </div>
        <div id="service" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class=" service col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
                <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <div class="serviceBox col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <img src="images/home/index/1.png" alt="">
                        </div>
                        <div class="serviceBox col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <img src="images/home/index/2.png" alt="">
                        </div>
                        <div class="serviceBox col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <img src="images/home/index/3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>