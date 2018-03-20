<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline">
                <el-form-item prop="users">
                  <el-input v-model="searchForm.consignee" placeholder="客户名称" size="small"></el-input>
                </el-form-item>

                <el-form-item prop="employee">
                  <el-input v-model="searchForm.sale_name" placeholder="销售员工" size="small"></el-input>
                </el-form-item>

                <el-form-item prop="goods_name">
                  <el-input v-model="searchForm.goods_name" placeholder="产品名称" size="small"></el-input>
                </el-form-item>

                <el-form-item prop="value7" >
                    <el-date-picker
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

                <el-form-item>
                  <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                  <el-button type="primary" size="small" @click="show_all">重置</el-button>
                  <el-button type="danger" size="small" @click="refresh">刷新</el-button>
                </el-form-item>
            </el-form>
        </el-row>
        <el-row>
					<el-col>
                        <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload">
                            <el-table-column type="selection" align="center" width="50"></el-table-column>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <!--<el-table-column prop="id" label="订单号" width="200" align="center">-->
                            <!--</el-table-column>-->
                            <el-table-column prop="order_all_money" label="总金额" align="center" width="100">
                            </el-table-column>
                            <el-table-column prop="order_pay_money" label="应付金额" align="center" width="100">
                            </el-table-column>
                            <el-table-column prop="cus_name" label="购买顾客" align="center" width="200">
                            </el-table-column>
                            <el-table-column prop="user_name" label="成交员工" align="center" width="200">
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
                            <el-table-column prop="check_status" label="审核状态" align="center" width="100">
                                <template slot-scope="scope">
                                    <span v-if="scope.row.check_status==0">未审核</span>
                                    <span v-else-if="scope.row.check_status==1" >通过</span>
                                    <span v-else-if="scope.row.check_status==2">未通过</span>
                                </template>
                            </el-table-column>
                            <el-table-column  label="操作" align="center" width="140">
                                <template slot-scope="scope">
                                    <el-button type="info" size="small" @click="showRow(scope.row)">查看</el-button>
                                    <el-button type="warning" size="small" @click="handleCheck(scope.row)">审核</el-button>
                                </template>
                            </el-table-column>

                        </TableProxy>
					</el-col>
        </el-row>


        <showRowDialog name="showRow"
                       :buyer="buyer"
                       :users="users"
                       :ajax-proxy="orderBasicAjaxProxy"
        />
        <checkDialog name="check" :ajax-proxy="orderBasicAjaxProxy"/>
    </div>

</template>

<script>
import showRowDialog from "./showRow";
import checkDialog from "./check";

import PageMix from '../../mix/Page';
import DataProxy from '../../packages/DataProxy';
import SearchTool from '../../mix/SearchTool';
import BuyOrderAjaxProxy from '../../ajaxProxy/BuyOrder';
import UsersSelectProxy from '../../packages/UsersSelectProxy';
import OrderBasic from '../../ajaxProxy/OrderBasic';
import TableProxy from '../common/TableProxy';
import DataTable from '../../mix/DataTable';
import config from '../../mix/Delete';
import BuyerAjaxProxy from '../../ajaxProxy/Buyer';
import SelectProxy from  '../../packages/SelectProxy';

export default {
    name: 'BuyOrders',
    pageTitle:"订单审核",
    mixins: [PageMix,SearchTool,DataTable,config,BuyOrderAjaxProxy],
    components:{
      showRowDialog,
      checkDialog
    },
    data () {
      return {
        ajaxProxy:OrderBasic,
        orderBasicAjaxProxy:OrderBasic,
        mainurl:OrderBasic.getUrl(),
        mainparam:"",
        msg: 'Welcome to Your Vue.js App',
        searchForm:{
            users:'',
            employee:'',
            goods_name:'',
            pay_name:'',
        },
          total:100,
          buyer:[],
          users:[],
          dataLoad:false,
          currentPage4:1,
          tableData:'',
          pickerOptions2: {
              shortcuts: [{
                  text: '最近一周',
                  onClick(picker) {
                      const end = new Date();
                      const start = new Date();
                      start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                      picker.$emit('pick', [start, end]);
                  }
              }, {
                  text: '最近一个月',
                  onClick(picker) {
                      const end = new Date();
                      const start = new Date();
                      start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                      picker.$emit('pick', [start, end]);
                  }
              }, {
                  text: '最近三个月',
                  onClick(picker) {
                      const end = new Date();
                      const start = new Date();
                      start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                      picker.$emit('pick', [start, end]);
                  }
              }]
          },
          value6: '',
          value7: ''
      }
    },
    methods:{
      getAjaxProxy(){
          return  this.ajaxProxy;
      },
      refresh(){
          this.$emit('refresh-success');
      },
      showRow(row){
//        this.$modal.show('showRow',{row:row});
          this.$modal.show('showRow',{rowData:row});
      },
      handleCheck(row){
        this.$modal.show('check',{row:row});
      },
      show_all:function(){
          this.searchForm.type = '';
          this.searchForm.deliver = '';
          this.searchForm.goods_name = '';
          this.searchForm.consignee = '';
          this.searchForm.id = '';
          this.searchForm.sale_name = '';
          this.searchForm.end = '';
          this.searchForm.condition = '';
          this.searchForm.type = '';
          this.searchForm.deliver = '';
          this.searchForm.value7 = '';
          this.searchToolChange('searchForm');
          this.refresh();
      },
      mainTableLoad(data){
          this.toggleTableLoad();
          this.tableData = data.items;
          this.total = data.total;
      },
      currentChange(v){
          this.toggleTableLoad();
          this.mainProxy.setPage(v).load();
      },
      searchToolReset(name){
          this.$refs[name].resetFields();
          this.$emit('search-tool-change', this[name]);
          this.refresh();
      },
      loadbuyer(data) {
          this.buyer = data.items;
      },
      loadUsers(data) {
          this.users = data.items;
      },
      toggleTableLoad(){
          this.dataLoad = !this.dataLoad;
      },
//      onSearchChange(param) {
//              this.toggleTableLoad();
//              this.mainProxy.setExtraParam(param).load();
//      },
        onSearchChange(param){
          console.log(11111);
          console.log(JSON.stringify(param));
            this.mainparam = JSON.stringify(param);
        },
      buyTimeDateChange(v){
        this.searchForm.buy_time = v;
      },
      mainTableLoad(data){
          this.toggleTableLoad();
          this.tableData = data.items;
          this.total = data.total;
      },
      toggleTableLoad(){
          this.dataLoad = !this.dataLoad;
      },
      startDateChange:function(v){
          var date = v.split('/');
          this.searchForm.start = date[0]+" 00:00:00";
          this.searchForm.end = date[1]+" 23:59:59";
      },

    },

     created(){
         let selectProxy = new SelectProxy(BuyerAjaxProxy.getUrl(), this.loadbuyer, this);
         selectProxy.load();
         let orderProxy = new UsersSelectProxy(null, this.loadUsers, this);
         this.orderProxy = orderProxy;
         this.orderProxy.load();
         this.$on('search-tool-change', this.onSearchChange);
         this.$on('refresh-success', this.handleReload);
     },
    filters: {
      handleString: function (v) {
        if(v.length > 16){
          return v.substring(0,6)+'......';
        }else{
          return v;
        }
      },
      delHtmlTag:function(v){
        return v.replace(/<[^>]+>/g,"");
      }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .el-form-item {
      margin-bottom: 2px;
  }
</style>
