<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" ref="searchForm" :model="searchForm">
                <el-form-item prop="value7" >
                    <el-date-picker
                            size="small"
                            v-model="searchForm.value7"
                            type="daterange"
                            align="right"
                            placeholder="选择日期"
                            unlink-panels
                            range-separator="/"
                            start-placeholder="开始日期"
                            end-placeholder="结束日期"
                            :picker-options="pickerOptions2"
                            @change="startDateChange">
                    </el-date-picker>
                </el-form-item>

                <el-form-item prop="goods_name">
                    <el-input size="small" v-model="searchForm.goods_name" placeholder="请输入商品名称"></el-input>
                </el-form-item>

                <el-form-item prop="sale_name">
                    <el-input size="small" v-model="searchForm.sale_name" placeholder="请输入员工名称"></el-input>
                </el-form-item>

                <el-form-item prop="consignee">
                    <el-input size="small" v-model="searchForm.consignee" placeholder="请输入客户名称"></el-input>
                </el-form-item>

                <el-form-item prop="id">
                    <el-input size="small" v-model="searchForm.id" placeholder="请输入订单编号"></el-input>
                </el-form-item>
                

                <el-form-item label-width="5px">
                    <el-button type="info" size="small" icon="search"  @click="searchToolChange('searchForm')">查询</el-button>
                    <el-tooltip content="清空搜索条件" placement="bottom-start" style="margin-left:10px;">
                        <el-button  size="small" @click="show_all" type="warning">重置</el-button>
                    </el-tooltip>
                </el-form-item>

                <br>
                <el-form-item prop="type">
                    <el-button size="small" @click="show_all"         type="info" >全部</el-button>
                    <el-button size="small" @click="typesearch('0')"  type="info" >待付款</el-button>
                    <el-button size="small" @click="typesearch('1')"  type="info" >待确认</el-button>
                    <el-button size="small" @click="delivesearch('0')" type="info" >待发货</el-button>
                    <el-button size="small" @click="delivesearch('1')"   type="info" >已发货</el-button>
                    <el-button size="small" @click="delivesearch('2')"    type="info" >已收货</el-button>
                    <el-button size="small" @click="typesearch('2')"        type="info" >已完成</el-button>
                    <el-button size="small" @click="typesearch('3')"      type="info" >已关闭</el-button>
                    <el-button size="small" @click="typesearch('4')"      type="info" >退款中</el-button>
                </el-form-item>

            </el-form>
        </el-row>

        <el-row>
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" @dbclick="showRow" >
                    <el-table-column type="selection" align="center" width="50"></el-table-column>
                    <el-table-column prop="order_sn" label="单号" align="center" width="180"></el-table-column>
                    <!--<el-table-column prop="id" label="订单号" width="200" align="center">-->
                    <!--</el-table-column>-->
                    <el-table-column prop="order_all_money" label="总金额" align="center" width="80">
                    </el-table-column>
                    <el-table-column prop="order_pay_money" label="应付金额" align="center" width="120">
                    </el-table-column>
                    <el-table-column prop="cus_name" label="购买顾客" align="center" width="120">
                    </el-table-column>
                    <el-table-column prop="user_name" label="成交员工" align="center" width="120">
                    </el-table-column>

                    <el-table-column prop="order_status" label="订单状态" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.order_status==0">待付款</span>
                            <span v-else-if="scope.row.order_status==1" >待确认</span>
                            <span v-else-if="scope.row.order_status==2">已完成</span>
                            <span v-else-if="scope.row.order_status==3">已关闭</span>
                            <span v-else-if="scope.row.order_status==4">退货中</span>
                            <span v-else-if="scope.row.order_status==5">换货中</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="shipping_status" label="发货状态" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.shipping_status==0">待发货</span>
                            <span v-else-if="scope.row.shipping_status==1" >已发货</span>
                            <span v-else-if="scope.row.shipping_status==2">已收货</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="check_status" label="审核状态" align="center" width="100">
                        <template slot-scope="scope">
                            <span v-if="scope.row.check_status==0">未审核</span>
                            <span v-else-if="scope.row.check_status==1" >通过</span>
                            <span v-else-if="scope.row.check_status==2">未通过</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="refund_check" label="退款审核" align="center" width="100">
                        <template slot-scope="scope">
                            <span v-if="scope.row.refund_check==0">未审核</span>
                            <span v-else-if="scope.row.refund_check==1" >通过</span>
                            <span v-else-if="scope.row.refund_check==2">未通过</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="refund_check" label="换货审核" align="center" width="100">
                        <template slot-scope="scope">
                            <span v-if="scope.row.exchange_check==0">未审核</span>
                            <span v-else-if="scope.row.exchange_check==1" >通过</span>
                            <span v-else-if="scope.row.exchange_check==2">未通过</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="refund_status" label="退款状态" align="center" width="100">
                        <template slot-scope="scope">
                            <span v-if="scope.row.refund_status==0">正常</span>
                            <span v-else-if="scope.row.refund_status==1" >退款中</span>
                            <span v-else-if="scope.row.refund_status==2">已退款</span>
                            <span v-else-if="scope.row.refund_status==3">已驳回</span>
                        </template>
                    </el-table-column>
                    <el-table-column prop="created_at" label="下单时间" align="center" width="180">
                    </el-table-column>
                    <el-table-column  width="200" fixed="right" label="操作" align="center">
                        <template slot-scope="scope">
                            <el-dropdown trigger="click" menu-align="start">
                                <el-button type="primary" size="small">
                                    更多操作<i class="el-icon-caret-bottom el-icon--right"></i>
                                </el-button>
                                <el-dropdown-menu slot="dropdown" split-button>
                                    <el-dropdown-item>
                                        <el-button type="text"  @click="open2(scope.row.id)">发起退款</el-button>
                                    </el-dropdown-item>
                                    <el-dropdown-item>
                                        <el-button type="text"  @click="showExchange(scope.row)">换货</el-button>
                                    </el-dropdown-item>
                                    <el-dropdown-item>
                                        <el-button type="text"  @click="showRowData(scope.row)">编辑</el-button>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                            <el-button type="danger" @click="handleDelete(scope.row.id)" size="small">删除</el-button>
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-tooltip content="点击添加订单" placement="right">
                            <el-button size="small" icon="plus" type="info" @click="showAdd" >添加</el-button>
                        </el-tooltip>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>


        <rowInfo name="rowInfo"
                 :ajax-proxy="ajaxProxy"
                 :users="users"
                 :buyer="buyer"
                 @submit-success="handleReload"
        />
        <exchange name="exchange"
                 :ajax-proxy="orderBasicAjaxProxy"
                 :users="users"
                 :buyer="buyer"
                 :CategoryList="CategoryList"
                 @submit-success="handleReload"
        />
        <div id="app2" class="b" style="margin-top:5px;">
            <el-row>
                <el-col :span="24">
                    <el-tabs type="border-card" @tab-click="handleClick">
                        <el-tab-pane label="订单客户信息">
                            <el-table  :data="usertableData"  v-loading.body="dataLoad" highlight-current-row border ref="select" style="width: 100%"
                                       empty-text="请点击客户显示跟踪信息">
                                <el-table-column prop="name" label="客户姓名" align="center">
                                </el-table-column>

                                <el-table-column prop="sex" label="客户性别" align="center">
                                    <template slot-scope="scope">
                                        <span v-if="scope.row.sex==0">未定义</span>
                                        <span v-else-if="scope.row.sex==1" >男</span>
                                        <span v-else-if="scope.row.sex==2">女</span>
                                    </template>
                                </el-table-column>

                                <el-table-column prop="phone" label="客户电话" align="center">
                                </el-table-column>

                                <el-table-column prop="qq" label="客户qq" align="center">
                                </el-table-column>

                                <el-table-column prop="qq_nickname" label="qq昵称" width="180" align="center">
                                </el-table-column>

                                <el-table-column prop="weixin" label="客户微信" align="center">
                                </el-table-column>

                                <el-table-column prop="weixin_nickname" label="微信昵称" align="center">
                                </el-table-column>

                            </el-table>
                        </el-tab-pane>

                        <!-- <el-tab-pane label="软件账号">软件账号</el-tab-pane>
                        <el-tab-pane label="通话记录">通话记录</el-tab-pane> -->
                        <el-tab-pane label="订单商品信息">
                            <el-table :data="goodstableData"  v-loading.body="dataLoad" highlight-current-row border ref="select" empty-text="请点击客户显示跟踪信息" border style="width: 100%">

                                <el-table-column prop="goods_name" label="商品名称" align="center">
                                </el-table-column>
                                <el-table-column prop="price" label="商品价格" align="center">
                                </el-table-column>

                                <el-table-column prop="goods_number" label="商品数量" width="180" align="center">
                                </el-table-column>
                                <el-table-column prop="remark" label="备注" width="180" align="center">
                                </el-table-column>

                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="订单收货地址">
                            <el-table :data="addresstableData"  v-loading.body="dataLoad" highlight-current-row border ref="select" empty-text="请点击客户显示订单收货地址" border style="width: 100%">
                                <el-table-column prop="address" label="收货地址" align="center">
                                </el-table-column>
                                <el-table-column prop="default_address" label="是否为默认地址" align="center">
                                    <template slot-scope="scope">
                                        <span v-if="scope.row.default_address==0">否</span>
                                        <span v-else-if="scope.row.default_address==1" >是</span>
                                    </template>
                                </el-table-column>
                                <el-table-column prop="name" label="收货人姓名" align="center">
                                </el-table-column>
                                <el-table-column prop="phone" label="收货人电话" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="订单操作记录">
                            <el-table :data="manageData" empty-text="请点击客户显示跟踪信息" border style="width: 100%">
                                <el-table-column  prop="order_id" label="订单id" align="center">
                                </el-table-column>
                                <el-table-column  prop="order_action" label="操作动作" align="center">
                                </el-table-column>
                                <el-table-column  prop="manager" label="操作员" align="center">
                                </el-table-column>
                                <el-table-column  prop="remark" label="操作备注" align="center">
                                </el-table-column>
                                <el-table-column  prop="time" label="操作时间" align="center">
                                </el-table-column>

                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="订单收件人">
                            <el-table empty-text="请点击客户显示跟踪信息" border style="width: 100%">
                                <el-table-column prop="user" label="操作员工" align="center">
                                </el-table-column>

                                <el-table-column label="投诉内容" align="center">
                                    <template slot-scope="scope">
                                        {{scope.row.content | handleString}}
                                    </template>
                                </el-table-column>

                                <el-table-column prop="created_at" label="投诉时间" width="180" align="center">
                                </el-table-column>

                                <el-table-column prop="type_text" label="投诉类型" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="订单发货信息">
                            <el-table empty-text="请点击客户显示跟踪信息" border style="width: 100%">
                                <el-table-column prop="user" label="操作员工" align="center">
                                </el-table-column>

                                <el-table-column label="投诉内容" align="center">
                                    <template slot-scope="scope">
                                        {{scope.row.content | handleString}}
                                    </template>
                                </el-table-column>

                                <el-table-column prop="created_at" label="投诉时间" width="180" align="center">
                                </el-table-column>

                                <el-table-column prop="type_text" label="投诉类型" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="订单快递信息">
                            <el-table empty-text="请点击客户显示跟踪信息" border style="width: 100%">
                                <el-table-column prop="user" label="操作员工" align="center">
                                </el-table-column>

                                <el-table-column label="投诉内容" align="center">
                                    <template slot-scope="scope">
                                        {{scope.row.content | handleString}}
                                    </template>
                                </el-table-column>

                                <el-table-column prop="created_at" label="投诉时间" width="180" align="center">
                                </el-table-column>

                                <el-table-column prop="type_text" label="投诉类型" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="订单成交员工">
                            <el-table empty-text="请点击客户显示跟踪信息" border style="width: 100%">
                                <el-table-column prop="user" label="操作员工" align="center">
                                </el-table-column>

                                <el-table-column label="投诉内容" align="center">
                                    <template slot-scope="scope">
                                        {{scope.row.content | handleString}}
                                    </template>
                                </el-table-column>

                                <el-table-column prop="created_at" label="投诉时间" width="180" align="center">
                                </el-table-column>

                                <el-table-column prop="type_text" label="投诉类型" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>

                        <el-tab-pane label="成交比例">
                            <el-table empty-text="请点击客户显示跟踪信息" border style="width: 100%">
                                <el-table-column prop="user" label="操作员工" align="center">
                                </el-table-column>

                                <el-table-column label="投诉内容" align="center">
                                    <template slot-scope="scope">
                                        {{scope.row.content | handleString}}
                                    </template>
                                </el-table-column>

                                <el-table-column prop="created_at" label="投诉时间" width="180" align="center">
                                </el-table-column>

                                <el-table-column prop="type_text" label="投诉类型" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>

                    </el-tabs>
                </el-col>
            </el-row>
        </div>
        <add-dialog
                name='add-orderBasic'
                width="70%"
                :customers="buyer"
                :ajax-proxy="orderBasicAjaxProxy"
                :CategoryList="CategoryList"
                @submit-success="handleReload">
        </add-dialog>
    </div>
</template>
<script src="./index.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    /* .el-form-item {
        margin-bottom: 2px;
    } */
    .menu
    {
        width: 100%;
        border: none;
        background-color: #20A0FF;
        color:#fbfdff;
    }
    .menu:hover
    {
        width: 100%;
        border: none;
        background-color: #20A0FF;
        color: black;
    }
</style>
