@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/person/index.css">
    <link rel="stylesheet" href="../css/home/person/orderManage.css">
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
                    <a href="{{URL('person/collection')}}">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">
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
                    <a href="javascript:;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar listSta  m-listB">全部订单</div>
                    </a>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">待支付订单</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">待收货订单</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar m-listB">已关闭订单</div>
                </div>
            </div>
            <div id="personContentRight" class="col-lg-10 col-sm-9 col-sm-9 col-xs-12 personContentRight">
                <div id="rightContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rightContent">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 takeDelivery">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 takeDeliveryHead">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lef">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">待收货</div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mes">
                                    订单号：20171204111111111
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mes">
                                    订单日期：2017-12-04
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rig">
                                订单金额：
                                <span style="color: #FF6666;font-size: 18px">￥199元</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 takeDeliveryList">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 lef">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                    <img src="" alt="">
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 store">
                                    商品名称 商品属性<br/>
                                    <span style="color: #999">￥199.00元x1</span>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 rig">
                                <div id="confirmTake" class="rigBin">确认收货</div>
                                <div class="rigBin checkS">查看物流</div>
                                <a href="{{URL('person/orderDetails')}}?id=1">
                                    <div class="rigBin">订单详情</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 takeDelivery">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 takeDeliveryHead">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lef">
                                <div style="color: #007aff" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tit">待发货</div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mes">
                                    订单号：20171204111111111
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mes">
                                    订单日期：2017-12-04
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rig">
                                订单金额：
                                <span style="color: #FF6666;font-size: 18px">￥499元</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 takeDeliveryList">
                            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 lef">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                    <img src="" alt="">
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 store">
                                    商品名称 商品属性<br/>
                                    <span style="color: #999">￥199.00元x1</span>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 rig">
                                <a href="{{URL('person/orderDetails')}}?id=2">
                                    <div class="rigBin">订单详情</div>
                                </a>
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