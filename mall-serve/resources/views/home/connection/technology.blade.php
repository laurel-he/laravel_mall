@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/connection/index.css"/>
@endsection
@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 connectContent">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lle">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 messageBox">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 title">
                    技术资讯
                </div>
                <form action="">
                    <div class="col-lg-12 col-md-12 col-sm-12 formName">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tit">你的姓名：</div>
                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-8 int">
                            <input class="username" type="text" name="name" placeholder="输入你的姓名">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formName">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tit">你的电话：</div>
                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-8 int">
                            <input class="username" type="text" name="phone" placeholder="输入你的手机号">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formContent">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 tit">留言内容：</div>
                        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 int">
                            <textarea class="cont" onpropertychange="this.style.height=this.scrollHeight + 'px'" oninput="this.style.height=this.scrollHeight + 'px'" name="content" placeholder="输入留言内容"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 butBoxss">
                        <div class="but" id="but">提交</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
      $("#but").click(function(){
        $.ajax({
          url: '/admin/connection',
          type: 'POST',
          dataType: 'json',
          data: $("form").serialize(),
          success:function(response){
            console.log(response);
            $('form')[0].reset();
            alert("提交成功，感谢您的反馈!");
          },
          error:function(response){
            console.log(response);
            alert("联系我们！");
          }
        });

      });
    </script>


@endsection