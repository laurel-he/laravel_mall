@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/person/index.css">
    <link rel="stylesheet" href="../css/home/person/address.css">
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
                    <a href="#">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar listSta m-listB">
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicTitle">新建地址</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            收货人
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input name="nickName" type="text" placeholder="输入收货人">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            所在地区
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <select class="phoneMargin" name="province"></select>
                            <select class="phoneMargin" name="city"></select>
                            <select class="phoneMargin" name="area"></select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            详细地址
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 detailAddress">
                                <input name="nickName" type="text" placeholder="输入详细地址">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            手机号码
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input name="nickName" type="text" placeholder="输入手机号码">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="saveAddress" name="saveAddress" type="checkbox">
                            <label id="saveAction" class="saveAction" for="saveAddress"></label>
                            保存为默认地址
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 confirmChange">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI"></div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <div id="confirmChange">保存地址</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicTitle">已有地址</div>
                    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 addressB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBox boxState">
                            <div class="col-lg-12 col-md-12 col-sm-122 col-xs-12 addressBoxTitle">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lef">钉钉</div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 rig">130333333333</div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCon">
                                四川-成都-锦江
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCon">
                                四川省成都市龙泉驿区大面镇柳树南街66号
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCons">
                                默认地址
                            </div>
                            <div class="addressBoxAction">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">编辑</div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">删除</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 addressB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBox">
                            <div class="col-lg-12 col-md-12 col-sm-122 col-xs-12 addressBoxTitle">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lef">钉钉</div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 rig">130333333333</div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCon">
                                四川-成都-锦江
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCon">
                                详细地址
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCons">
                                默认地址
                            </div>
                            <div class="addressBoxAction">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">编辑</div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">删除</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 addressB">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBox">
                            <div class="col-lg-12 col-md-12 col-sm-122 col-xs-12 addressBoxTitle">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 lef">钉钉</div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 rig">130333333333</div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCon">
                                四川-成都-锦江
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCon">
                                详细地址
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 addressBoxCons">
                                默认地址
                            </div>
                            <div class="addressBoxAction">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">编辑</div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">删除</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="../js/PCASClass.js"></script>
    <script>
        new PCAS("province","city","area");
        $(document).ready(function () {
            $('#saveAction').on('click',function () {
                if($(this).text()==''){
                    $(this).text('√')
                    $(this).css('box-shadow','0 0 5px #33B16D')
                }else{
                    $(this).text('')
                    $(this).css('box-shadow','0 0 5px #999')
                }
            })
        })
    </script>
@endsection