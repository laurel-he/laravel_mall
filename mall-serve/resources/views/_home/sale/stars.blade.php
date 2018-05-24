@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/sale/stars.css"/>
@endsection
@section('content')
    <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
        <div id="stars" class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
            <div class="starsTitle col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a href="{{URL('/')}}">首页</a>>
                <a href="{{URL('product/index')}}">全部产品</a>>
                <span>明星系列</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productTit">
                <div class="col-lg-6 col-lg-offset-3 col-md-6 col-sm-8 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="{{URL('sale/stars')}}" class="{{$type['wakeup']}}">焕肤系列</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <a href="{{URL('sale/stars?type=youth')}}" class="{{$type['youth']}}">
                            青春凝时冻龄系列
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 productBanners">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 left">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lefBox">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tits">
                            PULATA Brighten Series
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minTit">
                            @if($yt=='wakeup')
                            普拉她  焕肤系列
                            @else
                                普拉她  青春凝时冻龄系列
                                @endif
                            <div class="line"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lefCon">
                            一般女人到了三十五岁新陈代谢便开始减慢，这时肌肤真皮层已空，松弛程度持续加重，皱纹也已固定成型，不但黯淡无光，更缺乏滋润感；如不注意保养，皮肤当然问题练练了。如果你碰到了衰老问题而徘徊在畏老的情绪中不能自拔时，就是在暗示该要为脸部的整理存一点基金了。这时请你放下包袱，因为，三十五岁女人可以不变老。
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 imgBox">
                        @if($yt=='wakeup')
                        <img src="/images/home/sale/mx_xc.jpg" alt="">
                            @else
                            <img src="/images/home/sale/rightsidebar.jpg" alt="">
                            @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 proLists">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proList">
                    <a href="{{URL('product/product')}}">
                        <div class="imgB col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <img src="/images/home/sale/mxcp.jpg" alt="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 proTit">
                            护肤品套装面部护理保湿锁水爽肤水保湿霜乳液化妆水
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceBox">
                            <span class="price">￥119</span>
                            <span class="saleN">新品</span>
                            <span class="saleN saleB">畅销</span>
                            <span class="shop">
                            <img src="/images/home/sale/shopping.jpg" alt="">
                        </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
      $(document).ready(function () {

      })
    </script>
@endsection