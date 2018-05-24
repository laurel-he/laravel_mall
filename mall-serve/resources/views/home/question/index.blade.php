@extends('home.base')
@section('css')
    <link rel="stylesheet" href="/css/home/question/index.css"/>
@endsection
@section('content')
    <div id="question" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="questionContent col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="left col-lg-2 col-md-3 col-sm-3 col-xs-12">
                <div class="barBox col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="listBar col-lg-12 col-md-12 col-sm-12 col-xs-12 actionBar">常见问题</div>
                    <div class="listBar col-lg-12 col-md-12 col-sm-12 col-xs-12">购买相关</div>
                    <div class="listBar col-lg-12 col-md-12 col-sm-12 col-xs-12">退换货问题</div>
                    <div class="listBar col-lg-12 col-md-12 col-sm-12 col-xs-12">售后服务</div>
                </div>
            </div>
            <div class="right col-lg-10 col-md-9 col-sm-9 col-xs-12">
                <div class="rightContent col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="title col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        常见问题
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            1.问：普拉她的商品都是正品吗？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：普拉她选秉承网易一贯的严谨态度，对商品的产地、工艺、原材料都严格把关，力求帮消费者甄选到最优质的商品，你可以放新选购。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            2.问：普拉她的订单如何配送？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：普拉她会根据商品所在地、顾客所在地和商品的尺寸重量优选物流配送商，确保优质用户体验。目前暂不支持自选快递，具体物流信息可在下单成功后“我的订单-追踪物流”中查看。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            3.问：我的包裹多长时间能送到？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：我们会在订单支付成功后1-3天内发货（节假日顺延，部分特殊商品七天内发货），送达时间视快递配送时间而定。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            4.问：如何免运费？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：对于单笔所购商品总价值（不含运费）大于或者等于88元，我们提供一次免费送货服务（港澳台地区需大于或等于500元）。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            5.问：订单生成后我需要在多长时间内支付货款？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：下单后我们会为您保留1小时，为确保订单的有效性，需要您在一小时内完成支付。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            6.问：在线支付已经成功，为什么我的订单状态还是现实“待付款”？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：一般来说，网上支付是即时到账的。但有时因为网络原因，可能会有几分钟的延迟，请您耐心等待，并及时查询你的银行卡账户余额，如果费用已扣，但订单状态依然是“等待付款”，请联系客服处理。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            7.问：实物与图片由色差吗？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：普拉她中的商品照片均以实物拍摄，颜色经设计师校对，由于不同电脑显示器、光线、亮度都有差异，造成轻微色差难以避免。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            8.问：下单后可以修改订单信息吗？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：订单支付前，用户可以在订单详情页中修改订单收货信息和发票信息，修改结果以实际页面修改提示为准。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            9.问：下单时忘记选择开发票，我该如何申请补开发票？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            答：下单时如未选择开发票，可在订单确认收货后180天内，在需补开发票的订单详情页申请补开（普拉她App也可在“售后服务-发票服务”未开票订单列表申请）。确认后货超过180天的订单，请联系普拉她客服咨询是否可以补开。
                        </div>
                    </div>
                    <div class="questionList col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="question col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            10.问：客服的联系方式是什么？
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            &nbsp;&nbsp;答：你可以通过在线客服和电话联系客服。
                        </div>
                        <div class="answer col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;客服电话：400-0368-163
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

      })
    </script>
@endsection