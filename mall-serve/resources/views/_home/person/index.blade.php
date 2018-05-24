@extends('home.base')
@section('css')
    <link rel="stylesheet" href="../css/home/person/index.css">
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
                    <a href="#">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-4 listBar listSta m-listB">
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicTitle">基本资料</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 lef">个人头像</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rig">
                            <div class="changHeadBox">
                                <div class="basicUserImg">
                                    <img id="headImg" src="{{session('head_img')}}" alt="">
                                </div>
                                <input id="userImg" type="file" accept="image/jpeg,image/png,image/jpg,image/gif,image/bmp">
                                <label for="userImg" id="changeUser" class="basicUserChange">修改头像</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leff">登录名</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <b>{{$user['username']}}</b>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leff">会员类型</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <span style="color: #50E8A7">注册会员</span>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">昵称</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="nick_name" name="nickName" type="text" placeholder="输入昵称" value="{{$user['nick_name']}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">真实姓名</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="real_name" name="realName" type="text" placeholder="输入真实姓名" value="
{{$user['real_name']}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leff">手机号码</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <b>{{$user['phone']}}</b>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicTitle">其他资料</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">QQ号码</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="qq" name="QQ" type="text" placeholder="输入QQ号码" value="{{$user['qq']}}">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 basicList">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 leffI">微信号码</div>
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 rigg">
                            <input id="weChart" name="weChat" type="text" placeholder="输入微信号码" value="{{$user['wechart']}}">
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
            var formdata=new FormData();
            var headImg=$('#userImg').val()
            var nickname=$('#nick_name').val()
            var realname=$('#real_name').val()
            var qq=$('#qq').val()
            var weChart=$('#weChart').val()
            var num=0;
            /*-----------记录初始数据-------------*/
            $('#confirmChange').on('click',function () {
                if(nickname!=''&&$('#nick_name').val()!=nickname){
                    num+=1
                    formdata.append('nick_name',$('#nick_name').val())
                }
                if(weChart!=''&&$('#weChart').val()!=weChart){
                    num+=1
                    formdata.append('wechart',$('#weChart').val())
                }
                /*-----------真实姓名已填，则验证中文-------------*/
                if(realname!=''&&$('#real_name').val()!=realname){
                    num+=1
                    formdata.append('real_name',$('#real_name').val())
                    if(!/^[\u4E00-\u9FA5]{1,6}$/.test(realname)){
                        $(this).siblings('.message').text('真实姓名必须为中文')
                        return false
                    }
                }
                if(qq!=''&&$('#qq').val()!=qq){
                    num+=1
                    formdata.append('qq',$('#qq').val())
                    if(!/^[1-9]{4,12}/.test(qq)){
                        $(this).siblings('.message').text('QQ号码格式不对')
                        return false
                    }
                }
                if(num>0){
                    $.ajax({
                        url:"{{URL('person/personChange')}}",
                        type:'post',
                        headers:{'X-CSRF-Token':$('meta[name=csrf-token]').attr('content')},
                        data:formdata,
                        processData:false,
                        contentType:false,
                        success:function (msg) {
                            if(msg['state']=='success'){
                                alert(msg['message'])
                                window.location.reload()
                            }else{
                                $(this).siblings('.message').text(msg['message'])
                            }
                        }
                    })
                }else{
                    $(this).siblings('.message').text('没有任何改变')
                }
            })
            /*-------------------上传预览头像-------------*/
            $('#userImg').on('change',function () {
                var objUrl=getObjectURL(this.files[0])
                if(objUrl){
                    $('#headImg').attr('src',objUrl)
                }
                var files=!!this.files?this.files:[];
                if(!files.length||!window.FileReader) return;
                if(/^image/.test(files[0].type)){
                    var reader=new FileReader();
                    reader.readAsDataURL(files[0]);
                    formdata.append('myfile',files[0])
                    formdata.append('upload','success')
                    num+=1
                }
            })
            function getObjectURL(file) {
                var url=null;
                if (window.createObjectURL!=undefined) { // basic
                    url = window.createObjectURL(file) ;
                } else if (window.URL!=undefined) { // mozilla(firefox)
                    url = window.URL.createObjectURL(file) ;
                } else if (window.webkitURL!=undefined) { // webkit or chrome
                    url = window.webkitURL.createObjectURL(file) ;
                }
                return url
            }

        })
    </script>
@endsection