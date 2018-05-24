<div id="loginBar" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 barL">
            <a href="{{session('isLogin')}}">
                <img id="countP" class="{{session('login')}}" src="/images/home/index/login.jpg" alt="">
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 collection">
            <img src="/images/home/index/collect.jpg" alt="">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 buyCar">
            <img src="/images/home/index/shopping.jpg" alt=""> 
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 barL">
            <a href="javascript:;">
                <span id="buyC" class="iconfonts icon-gouwuche1"></span>
            </a>
            <div id="buyNumber" class="buyNumber">0</div>
        </div>
        <div id="myCenter" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 userImg">
                <img src="{{session('head_img')}}" alt="">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 username">
                用户名
            </div>
            <a href="{{URL('person/index')}}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        个人中心
                    </div>
                </div>
            </a>
            <a href="">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="glyphicon glyphicon-list-alt"></span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        我的订单
                    </div>
                </div>
            </a>
            <a href="{{URL('person/index')}}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="glyphicon glyphicon-cog"></span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        账户设置
                    </div>
                </div>
            </a>
            <a href="{{URL('login/loginOut')}}">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 barList">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <span class="glyphicon glyphicon-off"></span>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        退出登录
                    </div>
                </div>
            </a>
        <div class="tangle"></div>
    </div>

</div>