<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" ref="searchForm" :model="searchForm">
                <el-form-item prop="value7" >
                    <el-date-picker
                            v-model="searchForm.value7"
                            type="daterange"
                            size="small"
                            placeholder="选择日期"
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



                <!--<el-form-item prop="id">-->
                <!--<el-input size="small" v-model="searchForm.id" placeholder="请输入订单编号"></el-input>-->
                <!--</el-form-item>-->
                
                <el-form-item >
                    <el-button type="info" size="small" icon="search"  @click="searchToolChange('searchForm')">查询</el-button>
                    <el-tooltip content="清空搜索条件" placement="bottom-start" style="margin-left:10px;">
                        <el-button  size="small" @click="searchToolReset('searchForm')" type="warning">重置</el-button>
                    </el-tooltip>
                    <!-- <el-tooltip content="点击刷新当前页面" placement="right" style="margin-left:10px;">
                        <el-button  size="small" @click="refresh" type="danger" >刷新</el-button>
                    </el-tooltip> -->
                </el-form-item>

            </el-form>
        </el-row>

        <el-row>
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload"   :page-size="15">
                    <el-table-column type="selection" align="center" width="50"></el-table-column>
                    <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                    <!--<el-table-column prop="id" label="订单号" width="200" align="center">-->
                    <!--</el-table-column>-->
                    <el-table-column prop="order.order_all_money" label="总金额" align="center" width="100">
                    </el-table-column>
                    <el-table-column prop="order.order_pay_money" label="应付金额" align="center" width="100">
                    </el-table-column>
                    <el-table-column prop="order.cus_name" label="购买顾客" align="center" width="80">
                    </el-table-column>
                    <el-table-column prop="user_name" label="申请退货员工" align="center" width="80">
                    </el-table-column>

                    <!-- <el-table-column prop="order.status_text" label="订单状态" align="center">
                    </el-table-column>
                    <el-table-column prop="order.product_status_text" label="货物状态" align="center" width="100">
                        
                    </el-table-column>
                    <el-table-column prop="order.after_sale_status" label="售后状态" align="center" width="100">
                    </el-table-column> -->

                    <el-table-column prop="type_text" label="申请类型"　width="100"></el-table-column>
                    <el-table-column prop="check_status_text" label="审核状态"></el-table-column>
                    <el-table-column prop="check_remark" label="审核备注" :show-overflow-tooltip="true"></el-table-column>
                    <el-table-column prop="created_at" label="申请时间" align="center">
                    </el-table-column>
                    <el-table-column v-if="showOperator" label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="warning" size="small" @click="handleCheck(scope.row)">审核</el-button>
                            <!-- <el-button type="warning" size="small" @click="exchangeC(scope.row)">审核</el-button> -->
                            <!--<el-button type="danger" @click="handleDelete(scope.row.id)" size="small">删除</el-button>-->
                        </template>
                    </el-table-column>

                </TableProxy>
            </el-col>
        </el-row>


        <checkDialog name="check" :ajax-proxy="orderBasicAjaxProxy"/>
        <exchangeCheckDialog name="exchangeCheck" :ajax-proxy="orderBasicAjaxProxy"/>
    </div>

</template>

<script>
    import addDialog from "./Add.vue";
    import DataTable from '../../mix/DataTable';
    import PageMix from '../../mix/Page';
    import config from '../../mix/Delete';
    import DataProxy from '../../packages/DataProxy';
    import SelectProxy from  '../../packages/SelectProxy';
    import OrderlistAjaxProxy from '../../ajaxProxy/OrderBasic';
    import AfterSaleAjaxProxy from '@/ajaxProxy/AfterSale';
    import UsersSelectProxy from '../../packages/UsersSelectProxy';
    import BuyerAjaxProxy from '../../ajaxProxy/Buyer';
    import OrdergoodsAjaxProxy from '../../ajaxProxy/Ordergoods';
    import DeliveryAddressAjaxProxy from '../../ajaxProxy/DeliveryAddress';
    import Tree from '../../ajaxProxy/Tree';
    import Users from '../../ajaxProxy/Users';
    import TableProxy from '../common/TableProxy';
    import OrderBasic from '../../ajaxProxy/OrderBasic';
    import SearchTool from "../../mix/SearchTool";

    import checkDialog from "./check";
    import exchangeCheckDialog from "./exchangeCheck";
    export default {
        name: 'Refund',
        pageTitle:"退换货",
        mixins: [PageMix,SearchTool,DataTable,config,OrderlistAjaxProxy],
        components:{
            checkDialog,exchangeCheckDialog
        },
        data () {
            return {
                ajaxProxy:AfterSaleAjaxProxy,
                orderBasicAjaxProxy:AfterSaleAjaxProxy,
                mainurl:AfterSaleAjaxProxy,
                mainparam:"",
                strategies:{},
                searchForm:{
                    start:'',
                    goods_name:'',
                    consignee:'',
                    id:'',
                    sale_name:'',
                    end:'',
                    condition:'',
                    department:'1',
                    type:'',
                    deliver:'',

                    load:['order'],
                    appends:['type_text','check_status_text']

                },
                tabindex:'0',
                currentPage4:1,
                tableData: '',
                usertableData:'',
                addresstableData: '',
                goodstableData:'',
                CategoryList:'',
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
        computed:{
            showOperator(){
                return this.strategies.operator != 0;
            },
        },
        methods:{
            handleCheck(row){
                this.$modal.show('check',{row:row});
            },
            
            startDateChange(v){
                
            },
            refund(id)
            {
                let refundProxy = new SelectProxy(OrderlistAjaxProxy.getUrl(), this.loadtest, this);
                refundProxy.setExtraParam({refund_id:id}).load();

            },
            getAjaxProxy(){
                return  this.ajaxProxy;
            },


            onSearchChange(param){
                this.mainparam = JSON.stringify(param);
            },
            searchReset:function(){
                this.$refs['searchForm'].resetFields();
                this.typeName = '请选择排名方式';
                this.toggleTableLoad();
            },
            
            

        },
        created(){

            this.mainparam = JSON.stringify(this.searchForm);

            this.$on('search-tool-change', this.onSearchChange);
             

            this.strategies = this.$store.getters.getStrategy( this.$options.name );
            console.log(this.strategies);


        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
