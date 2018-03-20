@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/person/orderDetails.css">
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderDetails">
        <div id="orderDetails" class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
                <a href="{{URL('person/index')}}">个人中心</a> >
                <a style="color: #666" href="{{URL('person/orderManage')}}">订单管理</a> >
                <span style="color: #178B46">订单号：20171204111111111</span>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 status">
                <span style="font-size: 18px;color: #FF6666">待发货</span>
                <div id="cancel">取消订单</div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 stepList">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepOne">
                        <div class="box state">
                            <span class="iconfontStep states">&#xe739;</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightLine lineState"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepTwo textS">
                        待发货
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepTwo">
                        2017-12-04
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 stepList">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepOne">
                        <div class="box">
                            <span class="iconfontStep">&#xe671;</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leftLine"></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 rightLine"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepTwo">
                        待发货
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepTwo"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 stepList">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepOne">
                        <div class="box">
                            <span class="iconfontStep">&#xe6e5;</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 leftLine"></div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepTwo">
                        待发货
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 stepTwo"></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderContent">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">订单详情</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderList">
                    订单编号：&nbsp;&nbsp;<span>20171204111111111</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderList">
                    配送方式：&nbsp;&nbsp;<span>快递配送</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderList">
                    配送地址：&nbsp;
                    <span>丁某</span>&nbsp;&nbsp;
                    <span>13033333333</span>&nbsp;&nbsp;
                    <span>四川省</span>&nbsp;&nbsp;
                    <span>成都市</span>&nbsp;&nbsp;
                    <span>锦江区</span>&nbsp;&nbsp;
                    <span>东大街216号</span>&nbsp;&nbsp;
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderList">
                    商品信息：
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderValue">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 leftV">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 img">
                            <img src="" alt="">
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 text">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                商品名称
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeV">
                                商品属性
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rightV">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lls">￥199</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lls">x2</div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">￥398</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 orderPrice">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceTit">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lef">订单金额</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mid">运费金额</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 rig">实付金额</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 priceTit priceS">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lef">￥398元</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mid">0元</div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 total">￥398元</div>
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