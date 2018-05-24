@extends('home.base')

@section('css')
    <link rel="stylesheet" href="/css/home/information/index.css"/>
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 protectContent">

        <div class="col-lg-6 col-lg-offset-3 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12 lle">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 protectForm">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formTitle">
                    为你定制适合你的护肤方案！为了帮助你找到适合你的产品、满足您的护肤需求，请回答一下几个问题：
                </div>
                <form action="">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formList">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionT">
                            问题1 &nbsp;&nbsp;&nbsp;在您每天的肌肤保养中，你一般使用几种产品？
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_one" checked="checked" class="question1" value="少于3种">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                少于3种
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_one" class="question1" value="3-5种">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                3-5种
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_one" class="question1" value="多于5种">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                多于5种
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formList">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionT">
                            问题2 &nbsp;&nbsp;&nbsp;您喜欢哪种质地的面霜产品？
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_two" checked="checked" class="question1" value="奢华丰盈的面霜">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                奢华丰盈的面霜
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_two" class="question1" value="丰盈滋润，轻若无感的乳霜">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                丰盈滋润，轻若无感的乳霜
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_two" class="question1" value="柔滑轻盈的乳液">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                柔滑轻盈的乳液
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_two" class="question1" value="清爽水嫩的凝霜">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                清爽水嫩的凝霜
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formList">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionT">
                            问题3 &nbsp;&nbsp;&nbsp;您喜欢哪种类型的洁面产品？
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_three" checked="checked" class="question1" value="洁面泡沫">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                洁面泡沫
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_three" class="question1" value="洁面凝霜">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                洁面凝霜
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_three" class="question1" value="洁颜油">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                洁颜油
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_three" class="question1" value="洁面乳液">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                洁面乳液
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formList">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionT">
                            问题4 &nbsp;&nbsp;&nbsp;您期望达到的护肤效果是？
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_four" checked="checked" class="question1" value="提亮肤色，希望肌肤明亮，富有光泽">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                提亮肤色，希望肌肤明亮，富有光泽
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_four" class="question1" value="保湿滋润，希望肌肤水润柔滑、舒缓滋润">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                保湿滋润，希望肌肤水润柔滑、舒缓滋润
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_four" class="question1" value="平滑紧致，希望抚平细纹、紧致轮廓，换发年轻光彩">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                平滑紧致，希望抚平细纹、紧致轮廓，换发年轻光彩
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_four" class="question1" value="镇静舒缓，希望缓解肌肤泛红敏感，改善调理肌肤疤痕，修护肌肤">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                镇静舒缓，希望缓解肌肤泛红敏感，改善调理肌肤疤痕，修护肌肤
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_four" class="question1" value="温和美白，希望淡化色斑，改善肤色不均">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                温和美白，希望淡化色斑，改善肤色不均
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 formList">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionT">
                            问题5 &nbsp;&nbsp;&nbsp;你是否已经有固定的喜欢使用的护肤品牌？
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_five" checked="checked" class="question1" value="只有一个固定的喜欢的，不打算更换">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                只有一个固定的喜欢的，不打算更换
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_five" class="question1" value="目前为止只有一个固定喜欢的，还在寻找更喜欢的">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                目前为止只有一个固定喜欢的，还在寻找更喜欢的
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_five" class="question1" value="有几个固定喜欢的，经常换着买">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                有几个固定喜欢的，经常换着买
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 questionL">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                <input type="radio" name="problem_five" class="question1" value="没有，还没有找到固定喜欢的品牌">
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-10">
                                没有，还没有找到固定喜欢的品牌
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 userPhone">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12" for="inputSuccess2">留下的你联系方式：</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                            <input type="number" name="contact_phone" class="form-control" id="inputSuccess2" placeholder="手机号">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 userPhone">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                            <label class="control-label col-lg-12 col-md-12 col-sm-12 col-xs-12">验证码：</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 codeBox">
                            <input type="text" name="code" class="form-control" placeholder="验证码">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 imgBox">
                            <!--                         <img src="" alt=""> -->
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 butBox">
                        <div class="but" id="but">提交</div>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src=""></script>
    <script>
        $("#but").click(function(){
            $.ajax({
                url: '/admin/skincareinfo',
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