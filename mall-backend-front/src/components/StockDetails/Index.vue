<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" >
                    <el-form-item prop="goods_type_id"  >
                        <el-select
                                v-model="searchForm.goods_type_id"
                                size="small"
                                placeholder="商品类型">
                            <el-option v-for="v in types" :label="v.label" :value="v.id" :key="v.id"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="product_id"  >
                        <el-select
                                v-model="searchForm.product_id"
                                size="small"
                                placeholder="商品品类">
                            <el-option v-for="v in productNames" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goods_name">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>

                    <el-form-item prop="searchTime">
                        <el-date-picker
                                v-model="searchForm.searchTime"
                                type="datetime"
                                size="small"
                                placeholder="选择日期时间">
                        </el-date-picker>
                    </el-form-item>

                    <el-form-item prop="department_id"  >
                        <el-select
                                v-model="searchForm.distribution_id"
                                size="small"
                                placeholder="配送中心">
                            <el-option v-for="v in distributors" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goodsShelveNumber" >
                        <el-input v-model="searchForm.goodsShelveNumber" size="small" placeholder="货架编号"></el-input>
                    </el-form-item>

                    <el-form-item prop="storage_id"  >
                        <el-select
                                v-model="searchForm.storage_id"
                                size="small"
                                placeholder="入库人">
                            <el-option v-for="v in storageUsers" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" size="small" @click="searchToolChange('searchForm')" icon="search">查询
                        </el-button>
                        <el-button size="small" type="primary" @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                        <el-table :data="dataList" empty-text="暂无数据" border>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>

                            <el-table-column prop="distribution_name" label="配送中心" width="180" align="center"></el-table-column>

                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>

                            <el-table-column prop="stock_number" label="库存数量" width="180" align="center"></el-table-column>

                            <el-table-column prop="production_in_number" label="生产入库数量" align="center"></el-table-column>

                            <el-table-column prop="back_in_number" label="退货入库数量" align="center"></el-table-column>

                            <el-table-column prop="sale_lock_number" label="销售锁定数" align="center"></el-table-column>

                            <el-table-column prop="send_lock_number" label="发货锁定数" align="center"></el-table-column>

                            <el-table-column prop="exchange_lock_number" label="换货锁定数" align="center"></el-table-column>

                            <el-table-column prop="last_production_in_time" label="最后生产入库时间" align="center"></el-table-column>
                        </el-table>
                </el-tabs>
                <br>
                <div >
                    <!-- <el-button size="small"  type="info" @click="addProduction" >生产入库</el-button> -->
                    <el-button size="small"  type="info" @click="addProduction2" >生产入库</el-button>
                    <el-button size="small" type="info" @click="backProduction">退货登记</el-button>
                    <el-button size="small" type="info" @click="badProduction">坏货登记</el-button>
                    <el-button size="small" type="info" @click="exchangeProduction">换货登记</el-button>
                </div>
            </el-col>
        </el-row>
        <br>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                    <el-tab-pane label="生产入库">
                        <el-table :data="productionListData" empty-text="暂无数据" border>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                            <el-table-column prop="production_in_number" label="入库数量" width="180" align="center"></el-table-column>
                            <el-table-column prop="warehouse_number" label="入库单号" width="180" align="center"></el-table-column>
                            <el-table-column prop="storage_name" label="入库操作人" align="center"></el-table-column>
                            <el-table-column prop="production_in_time" label="入库时间" align="center"></el-table-column>
                            <el-table-column prop="remarks" label="备注" align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="退货入库">
                        <el-table :data="backListData" empty-text="暂无数据" border>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                            <el-table-column prop="goods_number" label="商品编号" width="180" align="center"></el-table-column>
                            <el-table-column prop="back_in_number" label="退货数量" width="180" align="center"></el-table-column>
                            <el-table-column prop="express_number" label="快递单号" width="180" align="center"></el-table-column>
                            <el-table-column prop="customer_name" label="退货客户姓名" width="180" align="center"></el-table-column>
                            <el-table-column prop="customer_qq" label="退货客户QQ" width="180" align="center"></el-table-column>
                            <el-table-column prop="customer_phone" label="退货客户手机号" width="180" align="center"></el-table-column>
                            <el-table-column prop="customer_weixin" label="退货客户微信" width="180" align="center"></el-table-column>
                            <el-table-column prop="back_reason" label="退货原因" width="180" align="center"></el-table-column>
                            <el-table-column prop="sale_name" label="销售人员" width="180" align="center"></el-table-column>
                            <el-table-column prop="storage_name" label="入库操作人" align="center" width="180"></el-table-column>
                            <el-table-column prop="back_in_time" label="退货入库时间" align="center" width="180"></el-table-column>
                            <el-table-column prop="remarks" label="备注" align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="销售锁定">
                        <el-table :data="saleLockListData" empty-text="暂无数据" border>
                            <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                            <el-table-column prop="customer_name" label="收件人姓名"  align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                            <el-table-column prop="sale_number" label="数量"  align="center"></el-table-column>
                            <el-table-column prop="sale_lock_time" label="销售锁定时间" align="center" ></el-table-column>
                            <el-table-column prop="examine_status" label="审核状态" align="center" >
                                <template slot-scope="scope">
                                    <span v-if="scope.row.examine_status==0">未审核</span>
                                    <span v-if="scope.row.examine_status==1">通过</span>
                                    <span v-if="scope.row.examine_status==2">未通过</span>
                                </template>
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="发货锁定">
                        <el-table :data="sendLockListData" empty-text="暂无数据" border>
                            <el-table-column prop="customer_name" label="客户姓名"  align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                            <el-table-column prop="send_number" label="数量"  align="center"></el-table-column>
                            <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="发货在途">
                        <el-table :data="sendInTheWayListData" empty-text="暂无数据" border>
                            <el-table-column prop="customer_name" label="客户姓名"  align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                            <el-table-column prop="send_number" label="数量"  align="center"></el-table-column>
                            <el-table-column prop="send_odd_number" label="发货单号"  align="center"></el-table-column>
                            <el-table-column prop="express_order" label="快递单号"  align="center"></el-table-column>
                            <el-table-column prop="express_company" label="快递公司"  align="center"></el-table-column>
                            <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                            <el-table-column prop="send_time" label="发货时间"  align="center" ></el-table-column>
                            <el-table-column prop="send_name" label="发货人"  align="center"></el-table-column>


                        </el-table>
                    </el-tab-pane>

                    <el-tab-pane label="换货锁定">
                        <el-table :data="exchangeLockListData" empty-text="暂无数据" border>
                            <el-table-column prop="customer_name" label="客户姓名"  align="center"></el-table-column>
                            <el-table-column prop="old_goods_name" label="原商品名称"  align="center"></el-table-column>
                            <el-table-column prop="old_goods_number" label="原数量"  align="center"></el-table-column>
                            <el-table-column prop="new_goods_name" label="更换后商品名称"  align="center"></el-table-column>
                            <el-table-column prop="new_goods_number" label="更换后数量"  align="center"></el-table-column>
                            <el-table-column prop="exchange_reason" label="换货原因"  align="center"></el-table-column>
                            <el-table-column prop="if_in_warehouse" label="退货是否入库"  align="center"></el-table-column>
                            <el-table-column prop="operation_name" label="操作人"  align="center"></el-table-column>
                            <el-table-column prop="operation_time" label="操作时间"  align="center"></el-table-column>


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

        <!-- <add-dialog
                name="addProduction"
                :ajax-proxy="ajaxProxy"
                @submit-success="handleReload">
        </add-dialog> -->
        
        <add-dialog-two
                name="addProductionTwo"
                :ajax-proxy="ajaxProxy"
                :types="types"
                :distributors="distributors"
                @submit-success="handleReload">
        </add-dialog-two>

        <bad-dialog
                name="badProduction"
                :ajax-proxy="ajaxProxy"
                @submit-success="handleReload">
        </bad-dialog>

        <exchange-dialog
            name="exchangeProduction"
            :ajax-proxy="ajaxProxy"
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
    import GetSaleLockData from '../../packages/GetSaleLockData';
    import SelectProxy from  '../../packages/SelectProxy';
    // import Dialog from '../common/Dialog';

    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';

    import DistributionCenterProxy from '../../packages/DistributionCenterSelectProxy';
    import CategorySelectProxy from '../../packages/CategorySelectProxy';

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
                ajaxProxy: ProduceEntryAjaxProxy,
                mainurl:ProduceEntryAjaxProxy,
                mainparam:"",
                dataList:[
                    {   distribution_name:'顺丰',
                        goods_name:'爽肤水 200ml',
                        stock_number:'120',
                        production_in_number:'100',
                        back_in_number:'6',
                        sale_lock_number:'10',
                        send_lock_number:'8',
                        exchange_lock_number :'3',
                        last_production_in_time:'2018-03-10'
                    },
                    {   distribution_name:'圆通',
                        goods_name:'爽肤水 200ml',
                        stock_number:'120',
                        production_in_number:'100',
                        back_in_number:'6',
                        sale_lock_number:'10',
                        send_lock_number:'8',
                        exchange_lock_number :'3',
                        last_production_in_time:'2018-03-10'
                    },
                ],
                productionListData: [
                    {
                        goods_name:'爽肤水',
                        production_in_number:'10',
                        warehouse_number:'123456789',
                        storage_name:'张三',
                        production_in_time:'2018-03-10',
                        remarks:'新加',
                    },{
                        goods_name:'爽肤水',
                        production_in_number:'10',
                        warehouse_number:'123456789',
                        storage_name:'张三',
                        production_in_time:'2018-03-10',
                        remarks:'新加',
                    },
                ],
                backListData: [
                    {
                        goods_name:"爽肤水",
                        goods_number:"6",
                        back_in_number:"5",
                        express_number:"13546234",
                        customer_name:"大佬",
                        customer_qq:"241564554",
                        customer_phone:"13524621458",
                        customer_weixin:"v11344",
                        back_reason:"选错商品",
                        sale_name:"销售二部-猛虎队-李四",
                        storage_name:"张三",
                        back_in_time:"2018-03-10 15:23:40",
                        remarks:"退货"
                    },{
                        goods_name:"爽肤水",
                        goods_number:"6",
                        back_in_number:"5",
                        express_number:"13546234",
                        customer_name:"大佬",
                        customer_qq:"241564554",
                        customer_phone:"13524621458",
                        customer_weixin:"v11344",
                        back_reason:"选错商品",
                        sale_name:"销售二部-猛虎队-李四",
                        storage_name:"张三",
                        back_in_time:"2018-03-10 15:23:40",
                        remarks:"退货"
                    },
                ],
                saleLockListData: [
                    {
                        sale_name:"销售二部-猛虎队-李四",
                        customer_name:'二佬',
                        goods_name:"爽肤水",
                        sale_number:'5',
                        sale_lock_time:"2018-03-10 15:23:40",
                        examine_status:'未审核',
                    }, {
                        sale_name:"销售二部-猛虎队-李四",
                        customer_name:'二佬',
                        goods_name:"爽肤水",
                        sale_number:'5',
                        sale_lock_time:"2018-03-10 15:23:40",
                        examine_status:'未审核',
                    },
                ],
                sendLockListData: [
                    {
                        sale_name:"销售二部-猛虎队-李四",
                        customer_name:'二佬',
                        goods_name:"爽肤水",
                        send_number:'5',
                    }, {
                        sale_name:"销售二部-猛虎队-李四",
                        customer_name:'二佬',
                        goods_name:"爽肤水",
                        send_number:'5',
                    },
                ],
                sendInTheWayListData: [
                    {
                        customer_name:'三佬',
                        goods_name:'爽肤水',
                        send_number:'3',
                        send_odd_number:'1324546',
                        express_order:'465897845465',
                        express_company:'顺丰',
                        sale_name:"销售二部-猛虎队-李四",
                        send_time:"2018-03-10 15:23:40",
                        send_name:'张三'
                    }, {
                        customer_name:'三佬',
                        goods_name:'爽肤水',
                        send_number:'3',
                        send_odd_number:'1324546',
                        express_order:'465897845465',
                        express_company:'顺丰',
                        sale_name:"销售二部-猛虎队-李四",
                        send_time:"2018-03-10 15:23:40",
                        send_name:'张三'
                    },
                ],
                exchangeLockListData: [
                    {
                        customer_name:"四佬",
                        old_goods_name:"爽肤水",
                        old_goods_number:"4",
                        new_goods_name  :"面膜",
                        new_goods_number  :"6",
                        exchange_reason  :"尝试下新商品",
                        if_in_warehouse  :"是",
                        operation_name  :"张三",
                        operation_time  :"2018-03-10 15:23:40",
                    },{
                        customer_name:"四佬",
                        old_goods_name:"爽肤水",
                        old_goods_number:"4",
                        new_goods_name  :"面膜",
                        new_goods_number  :"6",
                        exchange_reason  :"尝试下新商品",
                        if_in_warehouse  :"是",
                        operation_name  :"张三",
                        operation_time  :"2018-03-10 15:23:40",
                    },
                ],
                productNames: [
                    {id:1,name:'面膜 6张'},
                    {id:2,name:'爽肤水 200ml'},
                ],
                storageUsers: [
                    {id:1,name:'张三'},
                    {id:2,name:'李四'},
                ],
                groups: [],
                users: [],
                addDialog: false,
                editDialog: false,
                searchForm: {
                    product_id: "",
                    goods_type_id: '',
                    goods_name: '',
                    storage_id: '',
                    goodsShelveNumber: '',
                    distribution_id: '',
                    searchTime:'',
                },
                currentRow:null,
                tableData1: [],

                //显示隐藏策略
                strategies:null,

                //主表格事件
                bubble:{
                    'current-change': this.onCurrentChange
                },
                types:[],
                distributors:[],
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
            }
        },
        methods: {
            searchToolChange(){
                console.log(this.searchForm);
            } ,
            onCurrentChange(currentRow){
                this.currentRow = currentRow;
            } ,
            doubleClick:function (row) {
                // this.getUsersAjax(row.id);
                this.emSelect.setParam({
                    group_id:row.id,
                    fields:['id','realname', 'mobilephone', 'qq'],
                    with:['roles']
                });
                this.emSelect.load();
                // let categoryProxy = new SelectProxy(this.url+'/'+row.id,this.userLoaded, this,);
                // categoryProxy.load();
            },
            userLoaded(data){
                this.tableData1=data.items;
            }, getAjaxProxy(){
                return  this.ajaxProxy;
            },
            switchHandle:function(index,row){

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
                this.saleLockListData = data.items;
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

        },
        created() {
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
            
            let GetSaleLockDataSelect = new GetSaleLockData({}, this.GetSaleLockDataFun, this);
            GetSaleLockDataSelect.load();

            this.searchForm.department_id = this.user_department_id !=0 ? this.user_department_id :'';
            this.mainparam = JSON.stringify({department_id: this.searchForm.department_id});
            this.$on('search-tool-change', this.onSearchChange);

            // this.strategies = this.$store.getters.getStrategy( this.$options.name );

            this.emSelect = new EmployeeSelectProxy({}, this.loadSubTable, this);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
