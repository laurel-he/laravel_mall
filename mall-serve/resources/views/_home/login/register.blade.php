@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/login/register.css"/>
@endsection
@section('content')
    <div id="registerContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 registerForm">
            <form action="" id="registerFrom">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
                    注册账户
                    <div class="loginAction">
                        <a href="{:url('home/login/index')}">已有账号？</a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 line">
                    <div class="diamond"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">
                        用户名
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 rightBar">
                        <input id="user" type="text" name="username" placeholder="用户名字母开头，4-20位">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">
                        密码
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 rightBar">
                        <input id="pwd" type="password" name="password" placeholder="6-12位">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">
                        重复密码
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 rightBar">
                        <input id="pwdR" type="password" name="passwordR" placeholder="6-12位">
                        <div class="message"></div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">
                        手机号
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8 rightBar">
                        <input id="phone" type="text" name="phone" placeholder="输入你的手机号">
                        <div class="message"></div>
                    </div>
                    <div id="sendCode" class="col-lg-3 col-xs-offset-0 col-md-3 col-xs-offset-0 col-sm-3 col-sm-offset-0 col-xs-4 col-xs-offset-3">发送验证码</div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">
                        验证码
                        <span style="color: red">*</span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 rightBar">
                        <input type="text" placeholder="输入你的验证码">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 minT">更多资料</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ling"></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">QQ号码</div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 rightBar">
                        <input id="qq" type="text" name="qq" placeholder="输入你的QQ号">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 registerBar">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 leftBar">微信号</div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 rightBar">
                        <input id="wechart" type="text" name="wechart" placeholder="微信号">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 agreeContent">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 left">
                        <input name="checkbox" type="checkbox" id="checkbox" />
                        <label id="checkA" class="checkB" for="checkbox"></label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 ccn">
                        我愿意接受XX发送的新款推荐、特别优惠以及更多邮件推送
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 agreeContent">
                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 left">
                        <input name="checkbox1" type="checkbox" id="checkbox1" />
                        <label id="checkAs" class="checkB" for="checkbox1"></label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8 ccn">
                        我接受XXX的隐私政策和服务条款
                    </div>
                </div>
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-7 col-sm-offset-3 col-xs-8 col-xs-offset-3 registerAction">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="register">立即注册</div>
                    <div class="message"></div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.agreeContent .checkB').on('click',function () {
                if($(this).html()==''){
                    $(this).html('<span></span>')
                }else{
                    $(this).html('')
                }
            })
            $('#register').on('click',function () {
                var flg=true;
                var user=$('#user').val()
                var pwd=$('#pwd').val()
                var pwdR=$('#pwdR').val()
                var phone=$('#phone').val()
                var qq=$('#qq').val()
                var wechart=$('#wechart').val()
                /*------正则验证-----*/
                /*----------验证用户名----------*/
                var userP=/^[a-zA-Z][a-zA-Z0-9]{3,19}$/
                if(user==''){
                    $('#user').siblings('.message').text('用户名不能为空')
                    flg=false
                }else{
                    if(!userP.test(user)){
                        $('#user').siblings('.message').text('用户名格式有误')
                        flg=false
                    }else{
                        $('#user').siblings('.message').text('')
                    }
                }
                /*-------验证手机----*/
                var phonePat=/^1[34578]\d{9}$/;
                if(phone==''){
                    $('#phone').siblings('.message').text('手机号不能为空')
                    flg=false
                }else{
                    if(!phonePat.test(phone)){
                        $('#phone').siblings('.message').text('手机格式有误')
                        flg=false
                    }else{
                        $('#phone').siblings('.message').text('')
                    }
                }
                /*---------------密码验证-------------------*/
                var pwP=/^[a-zA-Z0-9]{6,20}/
                if(pwd==''){
                    $('#pwd').siblings('.message').text('密码不能为空')
                    flg=false
                }else{
                    if(!pwP.test(pwd)){
                        $('#pwd').siblings('.message').text('密码格式有误，格式为6-20位')
                        flg=false
                    }else {
                        $('#pwd').siblings('.message').text('')
                        if(pwd!=pwdR){
                            flg=false
                            $('#pwdR').siblings('.message').text('两次密码不一致')
                        }else{
                            $('#pwdR').siblings('.message').text('')
                        }
                    }
                }
                /*--------------------同意协议--------------------*/
                if(!$('#checkbox').is(':checked')||!$('#checkbox1').is(':checked')){
                    $('#register').siblings('.message').text('请先同意协议')
                    flg=false
                }else{
                    $('#register').siblings('.message').text('')
                }
                if(flg){
                    $.ajax({
                        url:"{:url('home/login/registerAction')}",
                        type:'post',
                        data:{
                            username:user,
                            password:pwd,
                            phone:phone,
                            qq:qq,
                            wechart:wechart
                        },
                        success:function (msg) {
                            var mes=$.parseJSON(msg)
                            if(mes['state']=='success'){
                                window.location.href="{:url('home/login/index')}";
                            }else{
                                $('#register').siblings('.message').text(mes['message'])
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection