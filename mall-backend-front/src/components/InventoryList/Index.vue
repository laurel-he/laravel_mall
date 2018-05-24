<template>
    <div >
        <!-- <el-alert
            title="需要跟据实际情况进行修改,功能不完鄯"
            type="error"
            show-icon>
          </el-alert> -->
        <el-row>
            <el-col>
                <el-form :inline="true" ref="searchForm" class="demo-form-inline"  :model="searchForm">
                    <el-form-item style="width:170px" prop="goods_name">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>

                    <el-form-item style="width:170px" prop="goods_batch">
                        <el-input v-model="searchForm.goods_batch" size="small" placeholder="商品批次"></el-input>
                    </el-form-item>
                    <el-form-item style="width:170px" prop="goods_version">
                        <el-input v-model="searchForm.goods_version" size="small" placeholder="商品型号"></el-input>
                    </el-form-item>

                    <!-- <el-form-item prop="start" >
                        <el-date-picker size="small" v-model="searchForm.start"
                                        placeholder="入库开始时间"
                                        @change="startDateChange"
                                        :editable="false">
                        </el-date-picker>
                    </el-form-item>

                    <el-form-item prop="end">
                        <el-date-picker size="small" v-model="searchForm.end"
                                        placeholder="入库截止时间"
                                        @change="endDateChange"
                                        :editable="false">
                        </el-date-picker>
                    </el-form-item> -->

                    <el-form-item>
                        <el-button type="info" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                        <el-button type="info" size="small" @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <br>
        <el-row >
            <el-col :span="24">
                <TableProxy 
                    :url="mainurl" 
                    :param="mainparam"
                    :reload="dataTableReload"
                    :bubble="bubble" :page-size="15">
                    <el-table-column label="序号" align="center"  type="index" width="65"></el-table-column>
                    <el-table-column prop="type_text" label="库类型" align="center" ></el-table-column>
                    <el-table-column prop="order_sn" label="订单号" align="center" >
                        <template slot-scope="scope">
                            <a href="javascript:void(0);">{{scope.row.order_sn}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column prop="goods_name" label="商品名称" align="center" ></el-table-column>
                    <el-table-column prop="goods_type" label="商品类型" align="center" ></el-table-column>
                    <el-table-column prop="goods_sum" label="商品数量" align="center" ></el-table-column>
                    <el-table-column prop="goods_version" label="商品型号" align="center" ></el-table-column>
                    <el-table-column prop="goods_batch" label="商品批次" align="center" ></el-table-column>
                    <el-table-column prop="create_time" label="操作时间" align="center" ></el-table-column>
                    <el-table-column prop="user" label="入/出库人" align="center" ></el-table-column>

                    <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="intoStorage">商品入库</el-button>
                        <el-button type="primary" size="small" @click="outStorage">商品出库</el-button>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>
        <br/>
        
        <intoStorage 
            name="intoStorage" 
            :ajax-proxy="ajaxProxy" 
            :goods-type="goods_type" 
            :users = "users"
            @submit-success="handleReload" />
        <outStorage 
            name="outStorage" 
            :ajax-proxy="ajaxProxy" 
            :goods-type="goods_type"  
            :users = "users" 
            @submit-success="handleReload" />
        <order
            name="orderinfo"
        ></order>
    </div>
</template>
      
<script>
    import PageMix from '../../mix/Page';
    import DataProxy from '../../packages/DataProxy';
    // import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    import DepartSelectProxy from '../../packages/DepartSelectProxy';
    import GroupSelectProxy from '../../packages/GroupSelectProxy';
    import DataTable from '../../mix/DataTable';
    import SearchTool from '../../mix/SearchTool';
    import intoStorage from './intoStorage.vue';
    import outStorage from './outStorage.vue';
    import order from './order.vue';
    import InventoryAjaxProxy from '../../ajaxProxy/Inventory'

    import GoodsTypeAjaxProxy from '../../ajaxProxy/GoodsType';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';


export default {
    name: 'InventoryList',
    pageTitle:"库存详情",
    mixins: [PageMix,SearchTool,DataTable],
    components:{
        intoStorage,
        outStorage,
        order
    },
    data () {
        return {
            goods_type:[],


            ajaxProxy:InventoryAjaxProxy,
            mainurl:InventoryAjaxProxy.getUrl(),
            mainparam:"",
            users:[],
            groups:[],
            departments:[],
            total:100,
            dataLoad:false,
            searchForm:{
                goods_name:'',
                goods_batch:'',
                goods_version:"",

            },

            bubble:{
                'cell-click':this.onOrderSn
            }
        }
    },
    methods:{
        dataReload:function(){
          console.log(this.searchForm);
        },
        searchReset:function(){
          //this.$refs.searchForm.resetFields();
        },
        handleDeletes:function(){

        },
        mainTableLoad(data){
            this.toggleTableLoad();
            this.tableData = data.items;
            this.tableData1 = data.items1;
            this.tableData2 = data.items2;
            this.tableData3 = data.items3;
            this.total = data.total;
        },
        currentChange(v){
            this.toggleTableLoad();
            this.mainProxy.setPage(v).load();
        },
        toggleTableLoad(){
            this.dataLoad = !this.dataLoad;
        },
        loadEmployee(data){
            this.users = data.items;
        },
        loadDepartment(data){
            this.departments = data.items;
        },
        loadGroup(data){
            this.groups = data.items;
        },
        onSearchChange(param){
          this.mainparam = JSON.stringify(param);
        },
        intoStorage:function(row){
            this.$modal.show('intoStorage', {model:row});
            },
        outStorage:function(row){
            this.$modal.show('outStorage', {model:row});
        },
        startDateChange:function () {

        },
        // action:function (row) {
        //     if(row['types']=='入库'){
        //         this.$modal.show('outStorage', {model:row});
        //     }
        // },
        endDateChange:function () {

        },
        dataChange:function(data){
            this.tableData.push(data)
            console.log(data)
        },
        onOrderSn(row, column, cell, event){
            if (row.order_sn && row.order_sn.length!=0) {
                // console.log(row.order_sn);
                // this.$modal.show('orderinfo');
                this.$modal.show('orderinfo', {order_sn:row.order_sn});
            }
        }

    },
     created(){
            this.$on('search-tool-change', this.onSearchChange);

            GoodsTypeAjaxProxy.get().then((response)=>{
                this.goods_type = response.data.items;
            });

            let employeeProxy = new EmployeeSelectProxy({}, this.loadEmployee, this);
            this.employeeProxy = employeeProxy;
            this.employeeProxy.load();


     }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .el-form-item {
      margin-bottom: 2px;
  }
</style>
