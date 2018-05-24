@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/person/index.css">
    <link rel="stylesheet" href="../css/home/person/password.css">
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
                    <a href="#">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar listSta m-listB">
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicTitle">修改密码</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            旧密码
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="oldPwd" name="oldPassword" type="password" placeholder="请输入旧密码">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            新密码
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="newPwd" name="newPassword" type="password" placeholder="请输入新密码">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">
                            <span style="color: #FF4E4E;font-size: 16px">*</span>
                            确认新密码
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="newPwds" name="newPasswords" type="password" placeholder="请输入新密码">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 confirmChange">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI"></div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <div id="confirmChange">确认修改</div>
                            <div class="message"></div>
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
            $('#confirmChange').on('click',function () {
                var old=$('#oldPwd').val();
                var newP=$('#newPwd').val()
                var newPs=$('#newPwds').val()
                var flg=true
                if(old==''||newP==''||newPs==''){
                    flg=false
                    $(this).siblings('.message').text('密码不能为空')
                }
                if(newP!=newPs){
                    flg=false
                    $(this).siblings('.message').text('确认新密码不一致')
                }else{
                    $(this).siblings('.message').text('')
                }
                if(flg){
                    $.ajax({
                        url:"{{URL('person/password_do')}}",
                        type:'post',
                        headers:{'X-CSRF-Token':$('meta[name=csrf-token]').attr('content')},
                        data:{
                            oldPassword:old,
                            newPassword:newP
                        },
                        success:function (msg) {
                            if(msg['state']=='success'){
                                alert(msg['message'])
                                window.location.href="{{URL('login/loginOut')}}"
                            }else{
                                $('#confirmChange').siblings('.message').text(msg['message'])
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection