<nav id="navbar" class="navbar navbar-fixed-top">
	<div class="container">
        <div class="row personBar"> 
                    
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div id="logo" class="">
                    <img src="/images/logo.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 ">
            	<div class="loginActionBars">
            	<!--  col-lg-6 col-md-6 col-sm-6  -->
                    <div role="presentation" class="searchBar">
                        <div id="searchBar">
                            <input id="searchB" type="text" maxlength="10" placeholder="新品限时特卖"/>
                            <span id="souI" class="iconfonts icon-sousuo"></span>
                        </div>
                    </div>
                    <!-- 登录 -->
                
                    <!-- / 登录  -->
                    <!-- 购物车 -->
                    <!-- / 购物车 -->
                </div>
                
            </div>
        </div>
	</div>
        
            <div class="headBar">
            	<div class="container">
            		<div class="navbar-header" style="padding: 0">
                        <button id="navBut" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
            		<div class="row">
            			
            			<div class="col-lg-12   col-md-12   col-sm-12 col-xs-12">
                    <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                                    <ul id="ul" class="nav nav-justified">
                                        <li role="presentation" class="active">
                                            <a href="/" class="{{$bar['bar1']}}">
                                                网站首页
                                                <div class="{{$bar['line1']}}"></div>
                                            </a>
                                        </li>
                                        {{--<li role="presentation">
                                            <a class="dropdown-toggle {{$bar['bar3']}}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                产品系列
                                                <span class="caret"></span>
                                                <div class="{{$bar['line3']}}"></div>
                                            </a>
                                            <ul class="dropdown-menu m-drop">
                                                <li><a href="{{URL('product/index?type=wakeup')}}">焕肤紧致系列</a></li>
                                                <li><a href="{{URL('product/index?type=youth')}}">青春凝时冻龄系列</a></li>
                                            </ul>
                                        </li>--}}
                                        <li role="presentation">
                                            <a href="{{URL('product/index')}}" class="{{$bar['bar2']}}">
                                                全部产品
                                                <div class="{{$bar['line2']}}"></div>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="{{URL('sale/index')}}" class="{{$bar['bar4']}}">
                                                畅销榜单
                                                <div class="{{$bar['line4']}}"></div>
                                            </a>
                                        </li>
                                        {{--<li role="presentation"><a href="{{URL('information/index')}}" class="{{$bar['bar5']}}">
                                                肌肤诊断
                                                <div class="{{$bar['line5']}}"></div>
                                            </a></li>--}}
                                        <li role="presentation"><a href="{{URL('sale/stars')}}" class="{{$bar['bar6']}}">
                                                明星产品
                                                <div class="{{$bar['line6']}}"></div>
                                            </a></li>
                                        <li role="presentation"><a href="{{URL('connection/index')}}" class="{{$bar['bar7']}}">
                                                联系我们
                                                <div class="{{$bar['line7']}}"></div>
                                            </a></li>
                                    </ul>
                                </div>
                           
               			 </div>
            		</div>
            	</div>
                
            </div>
        
    
</nav>