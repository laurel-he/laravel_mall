@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/brand/index.css"/>
@endsection
@section('content')
    <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
        <div id="brand" class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">
            <div class="left col-lg-2 col-md-3 col-sm-3 col-xs-12">
                <div id="leftNav" class="navbar-example col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-pills nav-stacked" role="tablist">
                        <li class="active">
                            <a href="#brandIntroduction">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌简介
                            </a>
                        </li>
                        <li>
                            <a href="#mission">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌使命
                            </a>
                        </li>
                        <li>
                            <a href="#location">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌定位
                            </a>
                        </li>
                        <li>
                            <a href="#slogan">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌口号
                            </a>
                        </li>
                        <li>
                            <a href="#culture">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌文化
                            </a>
                        </li>
                        <li>
                            <a href="#style">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌风格
                            </a>
                        </li>
                        <li>
                            <a href="#characteristic">
                                <span class="icons glyphicon glyphicon-play" aria-hidden="true"></span>
                                品牌特点
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="right col-lg-10 col-md-9 col-sm-9 col-xs-12">
                <div id="brandIntroduction" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/introduction1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/introduction2.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/introduction3.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/introduction4.png" alt="">
                </div>
                <div id="mission" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/mission1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/mission2.png" alt="">
                </div>
                <div id="location" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/location1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/location2.png" alt="">
                </div>
                <div id="slogan" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/slogan1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/slogan2.png" alt="">
                </div>
                <div id="culture" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/culture1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/culture2.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/culture3.png" alt="">
                </div>
                <div id="style" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/style1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/style2.png" alt="">
                </div>
                <div id="characteristic" class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/characteristic1.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/characteristic2.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/characteristic3.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/characteristic4.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/characteristic5.png" alt="">
                </div>
                <div class="imgBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="/images/home/brand/characteristic6.png" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('body').attr('data-spy','scroll');
            $('body').attr('data-target','#leftNav');
            $('body').scrollspy({target:'#leftNav'});
            $(window).scroll(function () {
                var top=document.getElementById('leftNav').offsetTop
                var tops=$(document).scrollTop()
                var width=$('#brand .left').css('width');
                if(tops>=360){
                    $('#leftNav').fadeIn('slow',function () {
                        $('#leftNav').addClass('leftNavDisplay');
                        $('#leftNav').css('width',width);
                    })
                }else {
                    $('#leftNav').removeClass('leftNavDisplay');
                    $('#leftNav ul li:first-child').addClass('active')
                }
            })
        })
    </script>
@endsection