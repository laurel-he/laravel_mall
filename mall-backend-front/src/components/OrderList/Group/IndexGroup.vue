<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" ref="searchForm" :model="searchForm">
                <el-form-item prop="value7" >
                    <el-date-picker
                            size="small"
                            v-model="searchForm.value7"
                            type="daterange"
                            placeholder="选择日期"
                            unlink-panels
                            start-placeholder="开始日期"
                            end-placeholder="结束日期"
                            :picker-options="pickerOptions2"
                            @change="startDateChange">
                    </el-date-picker>
                </el-form-item>

                <!-- <el-form-item prop="goods_name">
                    <el-input size="small" v-model="searchForm.goods_name" placeholder="请输入商品名称"></el-input>
                </el-form-item> -->

                <!-- <el-form-item prop="deal_id" class="form-item-unique">
                    <el-select v-model="searchForm.deal_id" placeholder="请选择员工" size="small">
                        <el-option v-for="item in users" :key="item.id" :label="item.realname" :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item> -->


                <el-form-item prop="consignee" class="form-item-unique">
                    <el-input size="small" v-model="searchForm.consignee" placeholder="请输入收货人名称"></el-input>
                </el-form-item>

                <el-form-item prop="phone"  class="form-item-unique">
                    <el-input size="small" v-model="searchForm.phone" placeholder="请输入收货人手机"></el-input>
                </el-form-item>

                <!-- <el-form-item prop="sn" class="form-item-unique">
                    <el-input size="small" v-model="searchForm.sn" placeholder="请输入订单编号"></el-input>
                </el-form-item> -->
                

                <el-form-item label-width="5px">
                    <el-button type="info" size="small" icon="search"  @click="searchToolChange('searchForm')">查询</el-button>
                    <el-tooltip content="清空搜索条件" placement="bottom-start" style="margin-left:10px;">
                        <el-button  size="small" @click="searchToolReset('searchForm')"  type="warning">重置</el-button>
                    </el-tooltip>
                </el-form-item>
                <el-form-item prop="type">
                    <el-button size="small" type="primary"  @click="showDialog('advance')" >高级查询</el-button>
                    <!-- 改成新的 -->
                    <el-badge :value="0"  class="badge-dot" hidden>
                        <el-button size="small" @click="searchToolReset('searchForm')"  type="info" >全部</el-button>
                    </el-badge>
                    <el-badge :value="0" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('0', '', '')"  type="info" >待审核</el-button>
                    </el-badge>

                    <!-- <el-badge :value="0" :max="9" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('2', '', '')"  type="info" >待充值</el-button>
                    </el-badge> -->

                    <el-badge :value="200" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('', '1', '')"  type="info" >配货中</el-button>
                    </el-badge>

                    <el-badge :value="200" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('', '2', '')"  type="info" >已发送</el-button>
                    </el-badge>

                    <el-badge :value="200" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('', '3', '')"  type="info" >已签收</el-button>
                    </el-badge>

                    <el-badge :value="200" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('3', '', '')"  type="info" >完成</el-button>
                    </el-badge>

                    <el-badge :value="200" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('4', '', '')"  type="info" >已取消</el-button>
                    </el-badge>

                    <el-badge :value="200" class="badge-dot" is-dot hidden>
                        <el-button size="small" @click="typesearch('', '', '1')"  type="info" >退换货</el-button>
                    </el-badge>
                   
                   
                </el-form-item>

            </el-form>
        </el-row>

        <el-row>
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" @cellclick="rowCellClick" @dbclick="showRow" :page-size="20" >
                    <el-table-column prop="order_sn" label="订单号" align="center" width="180">
                    </el-table-column>

                    <el-table-column prop="order_all_money" label="总金额" align="center">
                    </el-table-column>

                    <el-table-column prop="order_pay_money" label="应付金额" align="center">
                    </el-table-column>

                    <el-table-column prop="cus_name" label="购买顾客" align="center">
                    </el-table-column>

                    <el-table-column prop="deal_name" label="成交员工" align="center">
                    </el-table-column>

                    <el-table-column prop="status_text" label="订单状态" align="center">
                    </el-table-column>

                    <el-table-column prop="product_status_text" label="货物状态" align="center">
                    </el-table-column>

                    <el-table-column prop="after_sale_status_text" label="售后状态" align="center">
                    </el-table-column>

                    <el-table-column prop="created_at" label="下单时间" align="center" width="180">
                    </el-table-column>

                    <el-table-column fixed="right" label="操作" align="center" width="210">
                        <template slot-scope="scope">
                            <el-button type="primary" @click="showRowData(scope.row)" size="small">编辑</el-button>
                            <el-button type="danger" @click="handleDelete(scope.row.id)" size="small">删除</el-button>
                        </template>
                    </el-table-column>

                    <div slot="buttonbar">
                        <!-- 暂时注释添加 等改完后再加回去 -->

                        <!-- <el-button type="primary" size="small" @click="open2()">发起退货</el-button>
                        <el-button type="primary" size="small" @click="showExchange()">发起换货</el-button> -->
                        <el-button type="primary" size="small" @click="checkOrder()">订单审核</el-button>
                        <el-button type="primary" size="small" @click="cancelOrder()">取消订单</el-button>
                        <!-- <el-button type="primary" size="small" :disabled="reFundCheckShow" @click="RefundCheck()">退换货审核</el-button> -->

                    </div>

                </TableProxy>
            </el-col>
        </el-row>

        <br>
        <SubDetail :row="dbRow"/>

        <rowInfo name="rowInfo"
                 :ajax-proxy="ajaxProxy"
                 @submit-success="handleReload"/>
        
        <ReturnGoods name="returnGoods" :ajax-proxy="ajaxProxy"  @submit-success="handleReload"></ReturnGoods>
        <ExchangeGoods name="exchangeGoods" :ajax-proxy="ajaxProxy"  @submit-success="handleReload"></ExchangeGoods>
      
        <Advance name="advance" :users="users"></Advance>
    </div>
</template>
<script>
import addDialog from "../Add.vue";
import Advance from './Advance.vue';

import deleteMix from '@/mix/Delete';
import TableProxy from '../../common/TableProxy';
import OrderBasic from '@/ajaxProxy/OrderBasic';

import EmployeeSelectProxy from '@/packages/EmployeeSelectProxy';
import mix from '../mix';
import { mapGetters  } from 'vuex';

export default {
    name: 'OrderList',
    pageTitle:"订单详情",
    mixins: [mix,deleteMix],
    components:{
        addDialog,
        Advance
    },
    data () {
        return {
            ajaxProxy:OrderBasic,
            orderBasicAjaxProxy:OrderBasic,
            mainurl:OrderBasic.getUrl(),
            mainparam:"",
            daterange:'',
            searchForm:{
                phone:'',
                start:'',
                // goods_name:'',
                consignee:'',
                sn:'',
                // deal_name:'',
                end:'',
                condition:'',
                value7:"",

                // hyf 添加
                status:"", //订单状态 
                product_status:"", //货物状态
                after_sale_status:"",//售后状态,
                appends:['status_text','product_status_text','after_sale_status_text'],
                // group_id:'',
                // department_id:'',
                deal_id:'',

            },
            // tableData: '',
            bubble:null,

            value6: '',
            value7: '',
            dbRow:null,
            department:[],
            group:[],
            users:[],
            row_model:'',
            reFundCheckShow:false
        }
    },
    computed:{
        ...mapGetters([
            'user_id',
            'getUser'
          ])
    },
    methods:{
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        showRowData(row){
            this.$modal.show('rowInfo',{rowData:row});
        },
        

        /** 点击订单列表展示用户信息 */
        showRow(row){
            this.dbRow = row;
        },

        refund(id)
        {
            let refundProxy = new SelectProxy(OrderlistAjaxProxy.getUrl(), this.loadtest, this);
            refundProxy.setExtraParam({refund_id:id}).load();

        },
        loadtest(data){
            this.mainData = data.items;
            // console.log(data.items);
        },
        // showAdd:function(){
        //     this.$modal.show('add-orderBasic');
        // },
        startDateChange:function(v){
            if (v) {
                var sdate = v.split(' - ');
                this.searchForm.start = sdate[0] + " 00:00:00";
                this.searchForm.end = sdate[1] + " 23:59:59";
            } else {
                this.searchForm.start = "";
                this.searchForm.end = "";
            }
        },
        onSearchChange(param){
            // param.department_id = this.getUser.department_id;
            param.group_id = this.getUser.group_id;
            this.mainparam = JSON.stringify(param);
        },
        getUsers(data){
            this.users = data.items;
        },
        groupChange(department_id,group_id){
            this.EmployeeProxy.setParam({
                department_id:department_id,
                group_id:group_id,
                fields:['id','realname','group_id','department_id']
            }).load();
        },
    },
    created(){
        let o = {};
        o['row-dblclick'] = this.showRow;
        this.bubble = o;

        this.onSearchChange(this.searchForm);
        this.$on('search-tool-change', this.onSearchChange);

        this.EmployeeProxy = new EmployeeSelectProxy({ fields:["*"]},this.getUsers,this);
        this.groupChange(this.getUser.department_id,this.getUser.group_id);

    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
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
    .form-item-unique{
        width: 140px !important;
    }
</style>
