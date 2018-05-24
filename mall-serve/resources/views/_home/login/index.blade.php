@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/login/index.css"/>
@endsection
@section('content')
    <div id="loginBox" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 loginForm">
            <form id="myForm">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
                    用户登录
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 line">
                    <div class="diamond"></div>
                </div>
                <div id="message" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 messageBar">
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 inputBar">
                    <input id="user" class="inp" name="username" type="text" placeholder="请输入用户名" value="{{$username}}">
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 inputBar">
                    <input id="pwd" class="inp" name="password" type="password" placeholder="请输入密码" value="{{$password}}">
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12 inputBar check">
                    <input {{$check}} type="checkbox" id="checkbox" />
                    <label id="checkA" class="checkB" for="checkbox">{{$checks}}</label>
                    记住密码
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 cols-sm-12 col-xs-12 actionB" id="login">立即登录</div>
                </div>
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 cols-sm-12 col-xs-12 actionB" id="register">没有账号？立即注册</div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#checkA').on('click',function () {
                if($(this).text()==''){
                    $(this).text('√')
                }else{
                    $(this).text('')
                }
            })
            $('#login').on('click',function () {
                var user=$('#user').val()
                var pwd=$('#pwd').val()
                var check=''
                if($('#checkbox').is(':checked')){
                    check='success'
                }else{
                    check='error'
                }
                if(user==''||pwd==''){
                    alert('账号或者密码不能为空')
                }else{
                    $.ajax({
                        url:"{{URL('login/loginIn')}}",
                        type:'post',
                        headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                        data:{
                            username:user,
                            password:pwd,
                            check:check
                        },
                        success:function (msg) {
                           // var mes=$.parseJSON(msg)
                            if(msg['state']=='success'){
                                window.location.href="{{URL('/')}}"
                            }else{
                                $('#message').text(msg['message'])
                            }
                        }
                    })
                }
            })
            $('#register').on('click',function () {
                window.location.href="{:url('home/login/register')}"
            })
        })
    </script>
@endsection