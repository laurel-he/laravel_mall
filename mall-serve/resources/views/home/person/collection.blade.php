@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/person/index.css">
    <link rel="stylesheet" href="../css/home/person/collection.css">
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personCenter">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 personContent">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 personContentHead">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 userBox">
                    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 userImg">
                        <img src="{{session('head_img')}}" alt="">
                    </div>
                    <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 userName">
                        用户名
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 minBox">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minHead">我的收藏</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minBot">4</div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 minBox">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minHead">待支付</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minBot">4</div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 minBox">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minHead">待收货</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minBot">4</div>
                </div>
            </div>
            <div id="personContentLeft" class="col-lg-2 col-md-3 col-sm-3 col-xs-12 personContentLeft">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftNavList">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listTitle">账号设置</div>
                    <a href="{{URL('person/index')}}">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">
                            个人资料
                        </div>
                    </a>
                    <a href="{{URL('person/password')}}">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">
                            修改密码
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftNavList">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listTitle">个人中心</div>
                    <a href="{{URL('person/address')}}">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">
                            我的地址
                        </div>
                    </a>
                    <a href="#">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar listSta m-listB">
                            我的收藏
                        </div>
                    </a>
                    <a href="#">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">
                            我的优惠券
                        </div>
                    </a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 leftNavList">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 listTitle">订单管理</div>
                    <a href="{{URL('person/orderManage')}}">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">全部订单</div>
                    </a>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">待支付订单</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">待收货订单</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">已关闭订单</div>
                </div>
            </div>
            <div id="personContentRight" class="col-lg-10 col-sm-9 col-sm-9 col-xs-12 personContentRight">
                <div id="rightContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightContent">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicTitle">
                        我的收藏（6）
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 collectB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBox">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxImg">
                                <img src="" alt="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxName">
                                清爽保湿套装
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxPrice">
                                <span style="color: red">优惠价：99元</span>&nbsp;
                                <span style="text-decoration: line-through">原价：195元</span>
                            </div>
                            <div class="collectAction">
                                <span class="glyphicon glyphicon-heart"></span>
                                <span style="font-size: 16px">15</span>
                            </div>
                            <div class="collectDel">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 collectB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBox">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxImg">
                                <img src="" alt="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxName">
                                清爽保湿套装
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxPrice">
                                <span style="color: red">优惠价：99元</span>&nbsp;
                                <span style="text-decoration: line-through">原价：195元</span>
                            </div>
                            <div class="collectAction">
                                <span class="glyphicon glyphicon-heart"></span>
                                <span style="font-size: 16px">15</span>
                            </div>
                            <div class="collectDel">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 collectB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBox">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxImg">
                                <img src="" alt="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxName">
                                清爽保湿套装
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxPrice">
                                <span style="color: red">优惠价：99元</span>&nbsp;
                                <span style="text-decoration: line-through">原价：195元</span>
                            </div>
                            <div class="collectAction">
                                <span class="glyphicon glyphicon-heart"></span>
                                <span style="font-size: 16px">15</span>
                            </div>
                            <div class="collectDel">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 collectB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBox">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxImg">
                                <img src="" alt="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxName">
                                清爽保湿套装
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 collectBoxPrice">
                                <span style="color: red">优惠价：99元</span>&nbsp;
                                <span style="text-decoration: line-through">原价：195元</span>
                            </div>
                            <div class="collectAction">
                                <span class="glyphicon glyphicon-heart"></span>
                                <span style="font-size: 16px">15</span>
                            </div>
                            <div class="collectDel">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            </div>
                        </div>
                    </div>
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