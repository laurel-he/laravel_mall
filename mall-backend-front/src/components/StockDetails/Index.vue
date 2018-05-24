<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" >
                    <el-form-item prop="entrepot_id" class="form-item-unique">
                            <el-select
                                    clearable
                                    v-model="searchForm.entrepot_id"
                                    size="small"
                                    placeholder="配送中心">
                                <el-option v-for="v in distributors" :label="v.name"
                                            :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    <el-form-item prop="cate_type_id" class="form-item-unique">
                        <el-select
                                v-model="searchForm.cate_type_id"
                                size="small"
                                placeholder="商品类型"
                                @change="typeChange">
                            <el-option v-for="v in types" :label="v.label" :value="v.id" :key="v.id"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="cate_kind_id" class="form-item-unique">
                        <el-select
                                v-model="searchForm.cate_kind_id"
                                size="small"
                                placeholder="商品品类">
                            <el-option v-for="v in cate_kinds" :label="v.label"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goods_name" class="form-item-unique">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>

                    <el-form-item prop="searchTime">
                        <el-date-picker
                                v-model="searchForm.searchTime"
                                type="daterange"
                                size="small"
                                placeholder="选择日期时间"
                                @change="timeChange">
                        </el-date-picker>
                    </el-form-item>

                    

                    <!-- <el-form-item prop="goodsShelveNumber" >
                        <el-input v-model="searchForm.goodsShelveNumber" size="small" placeholder="货架编号"></el-input>
                    </el-form-item> -->

                    <!-- <el-form-item prop="storage_id"  >
                        <el-select
                                v-model="searchForm.storage_id"
                                size="small"
                                placeholder="入库人">
                            <el-option v-for="v in storageUsers" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item> -->

                    <el-form-item>
                        <el-button type="primary" size="small" @click="searchToolChange('searchForm')" icon="search">查询
                        </el-button>
                        <el-button size="small" type="primary" @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row>
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :bubble="bubble"  :page-size="20" >
                    <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                    <el-table-column prop="entrepot.name" label="配送中心" width="180" align="center"></el-table-column>
                    <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                    <el-table-column prop="entrepot_count" label="库存数量" width="180" align="center"></el-table-column>
                    <el-table-column prop="entrepot_in" label="生产入库数量" align="center"></el-table-column>
                    <el-table-column prop="return_num" label="退货入库数量" align="center"></el-table-column>
                    <el-table-column prop="order_lock" label="销售锁定数" align="center"></el-table-column>
                    <el-table-column prop="assign_lock" label="发货锁定数" align="center"></el-table-column>
                    <el-table-column prop="exchange_lock" label="换货锁定数" align="center"></el-table-column>
                    <el-table-column prop="entry_at" label="最后生产入库时间" align="center"></el-table-column>
                    <div slot="buttonbar">
                        <el-button size="small"  type="info" @click="addProduction2" >生产入库</el-button>
                        <el-button size="small" type="info" @click="backProduction">退货登记</el-button>
                        <el-button size="small" type="info" @click="badProduction">坏货登记</el-button>
                        <el-button size="small" type="info" @click="exchangeProduction">换货登记</el-button>
                        
                    </div> 
                </TableProxy>
               
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col :span="24">
                <el-tabs v-model="activeName" type="border-card">
                    <el-tab-pane label="生产入库" name="First">
                        <el-table :data="productionListData" empty-text="暂无数据" border>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                            <el-table-column prop="num" label="入库数量" width="180" align="center"></el-table-column>
                            <el-table-column prop="produce_entry.entry_sn" label="入库单号" width="180" align="center"></el-table-column>
                            <el-table-column prop="produce_entry.user_name" label="入库操作人" align="center"></el-table-column>
                            <el-table-column prop="produce_entry.entry_at" label="入库时间" align="center"></el-table-column>
                            <el-table-column prop="produce_entry.comment" label="备注" align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="退货入库" name="Second">
                        <el-table :data="backListData" empty-text="还未实现" border>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                            <el-table-column prop="sku_sn" label="商品编号" width="180" align="center"></el-table-column>
                            <el-table-column prop="goods_num" label="退货数量" width="180" align="center"></el-table-column>
                            <el-table-column prop="express_sn" label="快递单号" width="180" align="center"></el-table-column>
                            <el-table-column prop="cus_name" label="退货客户姓名" width="180" align="center"></el-table-column>
                            <el-table-column prop="cus_qq" label="退货客户QQ" width="180" align="center"></el-table-column>
                            <el-table-column prop="cus_phone" label="退货客户手机号" width="180" align="center"></el-table-column>
                            <el-table-column prop="cus_weixin" label="退货客户微信" width="180" align="center"></el-table-column>
                            <el-table-column prop="reason" label="退货原因" width="180" align="center"></el-table-column>
                            <el-table-column prop="sale_name" label="销售人员" width="180" align="center"></el-table-column>
                            <el-table-column prop="user_name" label="入库操作人" align="center" width="180"></el-table-column>
                            <el-table-column prop="return_at" label="退货入库时间" align="center" width="180"></el-table-column>
                            <el-table-column prop="remark" label="备注" align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="销售锁定" name="Third">
                        <el-table :data="saleLockListData" empty-text="暂无数据" border>
                            <el-table-column prop="order.dep_group_realname" label="销售人员"  align="center"></el-table-column>
                            <el-table-column prop="order.cus_name" label="客户姓名"  align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                            <el-table-column prop="goods_number" label="数量"  align="center"></el-table-column>
                            <el-table-column prop="created_at" label="销售锁定时间" align="center" ></el-table-column>
                            <el-table-column prop="order.status_text" label="审核状态" align="center" >
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="发货锁定" name="Fourth">
                        <el-table :data="sendLockListData" empty-text="暂无数据" border>
                            <el-table-column prop="deliver_name" label="收件人姓名"  align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                            <el-table-column prop="goods_num" label="数量"  align="center"></el-table-column>
                            <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="发货在途" name="Fifth">
                        <el-table :data="sendInTheWayListData" empty-text="暂无数据" border>
                            <el-table-column prop="deliver_name" label="收件人姓名"  align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                            <el-table-column prop="goods_num" label="数量"  align="center"></el-table-column>
                            <el-table-column prop="assign_sn" label="发货单号"  align="center"></el-table-column>
                            <el-table-column prop="express_sn" label="快递单号"  align="center"></el-table-column>
                            <el-table-column prop="express_name" label="快递公司"  align="center"></el-table-column>
                            <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                            <el-table-column prop="out_entrepot_at" label="发货时间"  align="center" ></el-table-column>
                            <el-table-column prop="user_name" label="发货人"  align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="换货锁定" name="Sixth">
                        <el-table :data="exchangeLockListData" empty-text="暂无数据" border>
                            <el-table-column prop="cus_name" label="客户姓名"  align="center"></el-table-column>
                            <el-table-column prop="before_goods_name" label="原商品名称"  align="center"></el-table-column>
                            <el-table-column prop="before_goods_num" label="原商品数量"  align="center"></el-table-column>
                            <el-table-column prop="after_goods_name" label="换后商品名称"  align="center"></el-table-column>
                            <el-table-column prop="after_goods_num" label="换后数量"  align="center"></el-table-column>
                            <el-table-column prop="exchange_reason" label="换货原因"  align="center"></el-table-column>
                            <el-table-column prop="in_inventory" label="退货是否入库"  align="center">
                                <template slot-scope="scope">
                                    {{setInInventory(scope.row.in_inventory)}}
                                </template>
                            </el-table-column>
                            <el-table-column prop="user_name" label="操作人"  align="center"></el-table-column>
                            <el-table-column prop="exchange_at" label="操作时间"  align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>
                </el-tabs>

            </el-col>
        </el-row>




        <back-dialog
                name="backProduction"
                :ajax-proxy="ajaxProxy"
                @submit-success="handleReload">
        </back-dialog>

        
        <add-dialog-two
                name="addProductionTwo"
                :ajax-proxy="producEntryAjajx"
                :types="types"
                :distributors="distributors"
                @submit-success="handleReload">
        </add-dialog-two>

        <bad-dialog
                name="badProduction"
                :ajax-proxy="ajaxProxy"
                :types="types"
                :distributors="distributors"
                @submit-success="handleReload">
        </bad-dialog>

        <exchange-dialog
            name="exchangeProduction"
            :ajax-proxy="ajaxProxy"
            :distributors="distributors"
            :types="types"
            @submit-success="handleReload">
        </exchange-dialog>

    </div>
</template>

<script>
    import addDialog from './addProduction.vue';
    import addDialogTwo from './addProductionTwo.vue';
    import backDialog from './backProduction.vue';
    import badDialog from './badProduction.vue';
    import exchangeDialog from './exchangeProduction.vue';
    import PageMix from '../../mix/Page';
    import getUsersByGid from '../../ajaxProxy/getUsersByGid';
    import DepartSelectProxy from '../../packages/DepartSelectProxy';
    import GroupSelectProxy from '../../packages/GroupSelectProxy';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import ProduceEntryAjaxProxy from '../../ajaxProxy/ProduceEntry';
    import InventoryDetailAjaxProxy from '../../ajaxProxy/InventoryDetail';
    import GetSaleLockData from '../../packages/GetSaleLockData';
    import SelectProxy from  '../../packages/SelectProxy';

    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';

    import DistributionCenterProxy from '../../packages/DistributionCenterSelectProxy';
    import CategorySelectProxy from '../../packages/CategorySelectProxy';
    import EntryProductSelectProxy from '../../packages/EntryProductSelectProxy';
    import OrderGoodsSelectProxy from '../../packages/OrderGoodsSelectProxy';
    import AssignSelectProxy from '../../packages/AssignSelectProxy';
    import ReturnRecordSelectProxy from '@/packages/ReturnRecordSelectProxy';
    import InventoryExchangeSelectProxy from '@/packages/InventoryExchangeSelectProxy';
    
    import { mapGetters } from 'vuex';

    export default {
        name: 'StockDetails',
        pageTitle: "库存明细",
        mixins: [PageMix, SearchTool,DataTable,getUsersByGid],
        components: {
            addDialog,
            addDialogTwo,
            backDialog,
            badDialog,
            exchangeDialog,
        },
        data() {
            return {
                ajaxProxy: InventoryDetailAjaxProxy,
                mainurl:InventoryDetailAjaxProxy,
                producEntryAjajx:ProduceEntryAjaxProxy,
                mainparam:"",
                cate_kinds:[],
                productionListData: [],
                backListData: [],
                saleLockListData: [],
                sendLockListData: [],
                sendInTheWayListData: [],
                exchangeLockListData: [],
                
                groups: [],
                users: [],
                addDialog: false,
                editDialog: false,
                searchForm: {
                    entrepot_id: "",
                    cate_type_id: '',
                    cate_kind_id: '',
                    goods_name:"",
                    searchTime:'',

                    start: "",
                    end: "",
                },
                currentRow:null,
                tableData1: [],

                //显示隐藏策略
                strategies:null,
                activeName:"First",

                //主表格事件
                bubble:null,
                types:[],
                distributors:[],
                InInventory:[
                    '是',
                    '否'
                ],
                tabFirst : false,
                tabSecond : false,
                tabThird : false,
                tabFourth: false,
                tabFifth: false,
                tabSixth: false
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id':'department_id'
            }),
        },
        watch:{
            addDialog(val, oldVal){
                console.log('index addDialog', val);
            },
            activeName(val, oldVal) {
                if(!this['tab'+val] && this.currentRow !== null){
                    this['tab'+val+"Handel"].call(this, this.currentRow);
                }
            },
            currentRow(val, oldVal){
                this['tab'+this.activeName+"Handel"].call(this, this.currentRow);
                this.tabFirst  = false;
                this.tabSecond = false;
                this.tabThird  = false;
                this.tabFourth = false;
                this.tabFifth  = false;
                this.tabSixht  = false;
            }
        },
        methods: {
            setInInventory(v){
                let res = this.InInventory[v-1];
                return res;
            },
            searchToolChange(){
                this.mainparam = JSON.stringify(this.searchForm);
            },
            onCurrentChange(currentRow){
                this.currentRow = currentRow;
            },
            // showRow:function (row) {
            //     //console.log(row);
            // },
            userLoaded(data){
                this.tableData1=data.items;
            }, 
            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            
            depTypeChange: function (v) {
                this.searchForm.type = v;
                this.depTypeName = this.typeList[v];
            },
            openEdit: function (row) {
                // this.currentRow = row;
                this.$modal.show('edit', {model:row});
            },

            loadDepartment(data) {

            },
            loadGroup(data) {
                this.groups = data.items;
            },
            onSearchChange(param) {
                if (this.searchForm.searchTime.length!=2) {
                    param.start = "";
                    param.end = "";
                }
                this.mainparam = JSON.stringify(param);
            },

            an(){
                this.$modal.show('abc');
            },
            addProduction(){
                this.$modal.show('addProduction');
            },
            addProduction2(){
                this.$modal.show('addProductionTwo');
            },
            exchangeProduction(){
                this.$modal.show('exchangeProduction');
            },
            badProduction(){
                this.$modal.show('badProduction');
            },
            backProduction(){
                this.$modal.show('backProduction');
            },
            getCurrentRow(){
                return this.currentRow;
            },
            loadSubTable(data){
                this.users = data.items;
            },
            GetSaleLockDataFun(data){
                //this.saleLockListData = data.items;
            },
            displayRoleName(roles){
                let cate = [];
                for (let index = 0; index < roles.length; index++) {
                    cate.push(roles[index].display_name);
                }
                return cate.join(" 、");
            },
            getDistributionCenter(data){
                this.distributors = data.items;
            },
            getTypes(data){
                this.types = data.items;
            },
            typeChange(v){
                this.searchForm.cate_kind_id = '';
                for (let index = 0; index < this.types.length; index++) {
                    const element = this.types[index];
                    if (element.id == v) {
                        this.cate_kinds = element.children;
                    }
                }
            },
            timeChange(v){
                if (v && v.length > 1) {
                    let d = v.split(" - ");
                    this.searchForm.start = d[0]+ " 00:00:00";
                    this.searchForm.end = d[1]+ " 23:59:59";
                }
            },
            tabFirstHandel(row){
                this.entryProductProxy.setParam({
                    entrepot_id:row.entrepot_id,
                    sku_sn:row.sku_sn,
                    start:this.searchForm.start,
                    end:this.searchForm.end
                }).load();
                this.tabFirst = true;
            },
            tabSecondHandel(row){
                this.returnRecord.setParam({
                    entrepot_id:row.entrepot_id,
                    sku_sn:row.sku_sn,
                    start:this.searchForm.start,
                    end:this.searchForm.end
                }).load();
                this.tabSecond = true;
            },
            tabThirdHandel (row){
                // console.log('handel');
                this.OrderGoodsProxy.setParam({
                    entrepot_id:row.entrepot_id,
                    sku_sn:row.sku_sn,
                    start:this.searchForm.start,
                    end:this.searchForm.end,
                    load:['order']
                }).load();
                this.tabThird = true;
            },
            tabFourthHandel(row){
                //后端start end 日期没加上
                this.assignProxy.setParam({
                    entrepot_id:row.entrepot_id,
                    sku_sn:row.sku_sn,
                    start:this.searchForm.start,
                    end:this.searchForm.end,
                    status:0
                }).load();
                this.tabFourth = true;
            },
            tabFifthHandel(row){
                this.assignProxy.setParam({
                    entrepot_id:row.entrepot_id,
                    sku_sn:row.sku_sn,
                    start:this.searchForm.start,
                    end:this.searchForm.end,
                    status:1
                }).load();
                this.tabFifth = true;
            },
            tabSixthHandel(row){
                this.InventoryExchangeProxy.setParam({
                    entrepot_id:row.entrepot_id,
                    sku_sn:row.sku_sn,
                    start:this.searchForm.start,
                    end:this.searchForm.end}).load();
                this.tabSixth = true;
            },
            loadProduct(data){
                this.productionListData = data.items;
            },
            loadOrderGoods(data){
                this.saleLockListData = data.items;
            },
            loadAssin(data){
                this.sendLockListData = data.items;
            },
            loadReturn(data){
                this.backListData = data.items;
            },
            loadExchange(data){
                this.exchangeLockListData = data.items;
            },

        },
        created() {
            console.log(11);
            console.log(this);
            console.log(22);
            let o = {};
            o['row-dblclick'] = this.onCurrentChange;
            this.bubble = o;

            //todo 这里应该改成打开弹窗get()一次
            let departProxy = new DepartSelectProxy(null, this.loadDepartment, this);
            this.departProxy = departProxy;
            this.departProxy.load();
            //获取商品类型数据
            let CategorySelect = new CategorySelectProxy({}, this.getTypes, this);
            CategorySelect.load();
            //获取配送中心数据
            let DistributionCenterSelect = new DistributionCenterProxy({}, this.getDistributionCenter, this);
            DistributionCenterSelect.load();
            
            //获取销售锁定展示数据
            // let GetSaleLockDataSelect = new GetSaleLockData({}, this.GetSaleLockDataFun, this);
            // GetSaleLockDataSelect.load();

            this.searchForm.department_id = this.user_department_id !=0 ? this.user_department_id :'';
            this.mainparam = JSON.stringify({department_id: this.searchForm.department_id});
            this.$on('search-tool-change', this.onSearchChange);

            // this.strategies = this.$store.getters.getStrategy( this.$options.name );

            // this.emSelect = new EmployeeSelectProxy({}, this.loadSubTable, this);

            this.entryProductProxy = new EntryProductSelectProxy({}, this.loadProduct, this);
            this.OrderGoodsProxy   = new OrderGoodsSelectProxy({}, this.loadOrderGoods, this);
            this.assignProxy   = new AssignSelectProxy({}, this.loadAssin, this);
            this.returnRecord  = new ReturnRecordSelectProxy({}, this.loadReturn, this);
            this.InventoryExchangeProxy  = new InventoryExchangeSelectProxy({}, this.loadExchange, this);




            
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .form-item-unique{
        width: 140px !important;
    }
</style>
