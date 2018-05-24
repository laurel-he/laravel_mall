<template>
    <div >
        <MyDialog title="退货登记" :name="name" :width="width" :height="height" >
            <el-form :inline="true"  ref="searchForm" :model="searchForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-form-item prop="express_sn" label="快递号">
                    <el-input v-model="searchForm.express_sn" size="small" placeholder="快递号"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" icon="search" @click="getAfterSale">搜索</el-button>
                </el-form-item>
            </el-form>
            
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="10">
                        <el-form-item label="状态:">
                            {{ after_sale.check_status_text }}
                        </el-form-item> 
                    </el-col>
                    <!-- <el-col :span="12">
                        <el-form-item label="销售员工:">
                            飞机部-大炮队-坦克兵
                        </el-form-item>
                    </el-col> -->
                </el-row>
                <!-- <el-row>
                    <el-col :span="10">
                        <el-form-item label="下单时间:">
                            2018-03-19 17:02:39
                        </el-form-item>
                    </el-col>
                    <el-col :span="6">
                        <el-form-item label="收件人:">
                            老铁
                        </el-form-item> 
                    </el-col>
                    <el-col :span="8">
                        <el-form-item label="收件人号码:">
                            13888888888
                        </el-form-item>
                    </el-col>
                </el-row> -->
                <!-- <el-row>
                    <el-col>
                        <el-form-item label="收件地址:">
                            太平洋中心地带水面下200米深。
                        </el-form-item> 
                    </el-col>
                </el-row> -->
                <h5>待退货的商品</h5>
                <el-table :data="after_sale.goods" @current-change="onCurrentChange" highlight-current-row border  max-height="160">
                    <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                    <el-table-column prop="sku_sn" label="商品编号"></el-table-column>
                    <el-table-column prop="goods_num" label="数量"></el-table-column>
                    <el-table-column prop="goods_status_text" label="状态">
                        <template slot-scope="scope">
                            <span v-if="scope.row.goods_status == 0">完好</span>
                            <span v-else-if="scope.row.goods_status == 1">损坏</span>
                        </template>
                    </el-table-column>
                </el-table>
                <br>
                <div >
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="商品名称" prop="goods_name" >
                                    {{ currentRow.goods_name }}
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="商品编号" prop="sku_sn" >
                                        {{ currentRow.sku_sn }}
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="商品数量" prop="num" >
                                    <el-input-number v-model="currentRow.goods_num" size="small" :min="1" placeholder="商品数量"></el-input-number>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="货物状态" prop="goods_status" >
                                    <el-select v-model="currentRow.goods_status" size="small" placeholder="货物状态">
                                        <el-option label="完好" value="0"></el-option>
                                        <el-option label="损坏" value="1"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>
                </div>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer" style="margin-top:-20px;">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="beforeSubmit" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>

    import DialogForm from '../../mix/DialogForm';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    import AfterSaleAjaxProxy from '@/ajaxProxy/AfterSale';
    import ReturnRecordAjaxProxy from '@/ajaxProxy/ReturnRecord';

    import { mapGetters } from 'vuex';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        // props:{
        //
        // },
        // components:{
        //     Dialog
        // },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'90px',
                computedusers:[],
                searchForm:{
                    express_sn:'',
                    load:['goods'],
                    appends:['check_status_text']
                },
                addForm:{
                    order_id:"",
                    goods:[],
                    user_id:"",
                    user_name:"",
                    after_sale_id:"",
                    express_sn:"",
                },

                after_sale:{},
                currentRow:{} 
            }
        },
        computed:{
            ...mapGetters([
                'getUser',
            ]),

        },
        methods:{
            getAjaxPromise(model){
                return ReturnRecordAjaxProxy.create(model);
            },
            loadUsers(data){
                this.computedusers = data.items;
            },
            onDepartChange(v){
                this.employeeSelect.setParam({department_id:v, role:'group-captain', group_candidate:1})
                this.employeeSelect.load();
                this.addForm.manager_id = "";
            },
            setEntyAt(v){
                this.addForm.entry_at = v;
            },
            handelAdd(){
                let data = Object.assign({},this.addForm);
                if(data.goods_name && data.sku_sn && data.num && data.goods_status){
                    data.goods_status = '完好';
                    this.childrenData2.push(data);
                    this.$refs.addForm.resetFields(); 
                }
            },
            handleFormDel(row){
                let index = this.childrenData2.indexOf(row);
                if( index > -1){
                    this.childrenData2.splice(index,1);
                }
            },

            getAfterSale(){
                this.addForm.express_sn = this.searchForm.express_sn;
                AfterSaleAjaxProxy.get(this.searchForm).then(response=>{
                    // console.log(response.data);
                    if (response.data.items.length > 0) {
                        this.after_sale = response.data.items[0];
                    }
                    
                });
            },
            onCurrentChange(currentRow){
                this.currentRow = currentRow;
            },
            beforeSubmit(){
                this.addForm.user_id = this.getUser.id;
                this.addForm.user_name = this.getUser.realname;
                this.addForm.order_id = this.after_sale.order_id;
                this.addForm.goods = this.after_sale.goods;
                this.addForm.after_sale_id = this.after_sale.id;
                this.formSubmit('addForm');
            }
        },
        created(){
            this.employeeSelect = new EmployeeSelectProxy({}, this.loadUsers, this);
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
    .el-form-item {
        margin-bottom: 0;
    }
</style>

