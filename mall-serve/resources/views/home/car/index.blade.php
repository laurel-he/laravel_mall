@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/car/index.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carContent">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 carBox">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
                <span class="iconfonts icon-gouwuche1"></span>
                我的购物车
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carHead">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
                    <input id="checkAll" type="checkbox" placeholder="">
                    <label class="checkbox checkAll state" for="checkAll">√</label>
                    全选
                </div>
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12 m-th">商品</div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 m-th">单价</div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 m-th">数量</div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 m-th">小计</div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 m-th">操作</div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carList">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                    <input id="checkAll0" type="checkbox" placeholder="">
                    <label class="checkbox checkAll state" for="checkAll0">√</label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-11 stores">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 left">
                        <img src="" alt="">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeTitle">
                            商品名称
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeValue">
                            商品属性
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-7 m-pd price">
                    199元
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 m-pd amount">
                    <div class="amountNumber">
                        <div class="lef">-</div>
                        <div class="mid">2</div>
                        <div class="rig">+</div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-7 m-pd totalPrice">
                    398元
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 m-pd action">
                    <span class="glyphicon glyphicon-trash delete" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carList">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                    <input id="checkAll0" type="checkbox" placeholder="">
                    <label class="checkbox checkAll state" for="checkAll0">√</label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-11 stores">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 left">
                        <img src="" alt="">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeTitle">
                            商品名称
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeValue">
                            商品属性
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-7 m-pd price">
                    199元
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 m-pd amount">
                    <div class="amountNumber">
                        <div class="lef">-</div>
                        <div class="mid">2</div>
                        <div class="rig">+</div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-7 m-pd totalPrice">
                    398元
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 m-pd action">
                    <span class="glyphicon glyphicon-trash delete" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carList">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-1">
                    <input id="checkAll0" type="checkbox" placeholder="">
                    <label class="checkbox checkAll state" for="checkAll0">√</label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-11 stores">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 left">
                        <img src="" alt="">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeTitle">
                            商品名称
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 storeValue">
                            商品属性
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-7 m-pd price">
                    199元
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-7 m-pd amount">
                    <div class="amountNumber">
                        <div class="lef">-</div>
                        <div class="mid">2</div>
                        <div class="rig">+</div>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-7 m-pd totalPrice">
                    398元
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5 m-pd action">
                    <span class="glyphicon glyphicon-trash delete" aria-hidden="true"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 carActionBar">
                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 leftBars">
                    <div class="selectDel">删除所选</div>
                    <div class="moveFocus">移至关注</div>
                </div>
                <div class="col-lg-4 col-lg-offset-4 col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-0 col-xs-12 col-xs-offset-0 rightBars">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <span style="font-size: 12px">共2件商品，</span>
                        <span>合计：</span>
                        <span style="color: #F96868">￥398元</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div id="balance">去结算</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 perLike">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 perLikeTittle">猜你喜欢</div>
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 perLikeLists">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 perLikeList">
                <img src="" alt="">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 perLikeList">
                <img src="" alt="">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 perLikeList">
                <img src="" alt="">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 perLikeList">
                <img src="" alt="">
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