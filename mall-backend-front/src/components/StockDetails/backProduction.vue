<template>
    <div >
        <MyDialog title="退货登记" :name="name" :width="width" :height="height" >
            <el-form :inline="true"  ref="searchForm" :model="searchForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-form-item prop="express_num" label="快递号">
                    <el-input v-model="searchForm.express_num" size="small" placeholder="快递号"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" size="small" icon="search">搜索
                    </el-button>
                </el-form-item>
            </el-form>
            
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="10">
                        <el-form-item label="订单号:">
                            1008611111
                        </el-form-item> 
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="销售员工:">
                            飞机部-大炮队-坦克兵
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
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
                </el-row>
                <el-row>
                    <el-col>
                        <el-form-item label="收件地址:">
                            太平洋中心地带水面下200米深。
                        </el-form-item> 
                    </el-col>
                </el-row>
                
                <el-table :data="childrenData1" border style="width: 100%" max-height="160">
                    <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                    <el-table-column prop="sku_sn" label="商品编号"></el-table-column>
                    <el-table-column prop="num" label="数量"></el-table-column>
                    <el-table-column prop="status" label="状态"></el-table-column>
                </el-table>
                <br>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品名称" prop="goods_name" >
                            <el-input v-model="addForm.goods_name" size="small" auto-complete="off" placeholder="请填写商品名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="sku_sn" >
                            <el-input v-model="addForm.sku_sn" size="small" auto-complete="off" placeholder="请填写商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品数量" prop="num" >
                            <el-input-number v-model="addForm.num" size="small" :min="1" placeholder="商品数量"></el-input-number>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="货物状态" prop="goods_status" >
                            <el-select v-model="addForm.goods_status" size="small" placeholder="货物状态">
                                <el-option label="完好" value="1"></el-option>
                                <el-option label="损坏" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="入库人" prop="user_id" >
                            <el-select v-model="addForm.user_id" size="small" placeholder="入库人">
                                <el-option label="阿三" value="1"></el-option>
                                <el-option label="阿四" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="entry_at" label="入库时间">
                            <el-date-picker
                              v-model="addForm.entry_at"
                              type="datetime"
                              size="small"
                              placeholder="入库时间" @change="setEntyAt">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="12">
                        <el-form-item label="备注" prop="remark">
                            <el-input type="textarea" size="small" auto-complete="off" v-model="addForm.remark" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <div style="text-align:center;margin:5px;">
                            <el-button type="info" @click="handelAdd">添加</el-button>
                        </div>
                    </el-col>
                </el-row>
                
                <el-table :data="childrenData2" border style="width: 100%;margin-top:5px;" max-height="140">
                    <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                    <el-table-column prop="sku_sn" label="商品编号"></el-table-column>
                    <el-table-column prop="num" label="数量"></el-table-column>
                    <el-table-column prop="goods_status" label="状态"></el-table-column>
                    <el-table-column label="操作">
                        <template slot-scope="scope">
                            <el-button type="danger" size="small" @click="handleFormDel(scope.row)">删除</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer" style="margin-top:-20px;">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="formSubmit('addForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>

    import DialogForm from '../../mix/DialogForm';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
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
                    express_num:'',
                },
                addForm:{
                    goods_name:'',
                    sku_sn:'',
                    num:'',
                    goods_status:'',
                    user_id:'',
                    entry_at:'',
                    remark:'',
                },
                childrenData1:[
                    {goods_name:'雄兽玩',sku_sn:201803191533,num:10,status:'退货',},
                    {goods_name:'雄兽玩',sku_sn:201803191533,num:10,status:'退货',},
                    {goods_name:'雄兽玩',sku_sn:201803191533,num:10,status:'退货',},
                    {goods_name:'雄兽玩',sku_sn:201803191533,num:10,status:'退货',},
                    {goods_name:'雄兽玩',sku_sn:201803191533,num:10,status:'退货',},
                ],
                childrenData2:[],
                // rules:{
                //     name:[
                //         { required: true, message: '请输入小组名称', trigger: 'blur' }
                //     ],
                //     department_id:[
                //         { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                //     ],
                //     remarks:[
                //         { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                //     ]
                // },
                
            }
        },
        computed:{
            ...mapGetters([
                'getUser',
            ]),

        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
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

