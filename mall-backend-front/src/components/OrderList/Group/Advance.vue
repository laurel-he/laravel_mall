<template>
        <MyDialog title="高级查询" :name="name" :width="width" :height="height">
            <el-form :model="queryForm"  ref="queryForm"  :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <!-- <el-col :span="12">
                        <el-form-item prop="group_id" label="小组">
                            <el-select v-model="queryForm.group_id" placeholder="请选择小组"   @change="groupChange">
                                <el-option v-for="item in groups" :key="item.id" :label="item.name" :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col> -->
                    <el-col :span="12">
                            <el-form-item prop="deal_id" label="员工">
                                <el-select v-model="queryForm.deal_id" placeholder="请选择员工" >
                                    <el-option v-for="item in users" :key="item.id" :label="item.realname" :value="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                </el-row>
               
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="consignee" label="收货人">
                            <el-input  v-model="queryForm.consignee" class="name-input" placeholder="请输入收货人名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="phone" label="收货手机">
                            <el-input  v-model="queryForm.phone" class="name-input" placeholder="请输入收货人手机"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="sn" label="订单编号">
                            <el-input  v-model="queryForm.sn" class="name-input" placeholder="请输入订单编号"></el-input>
                        </el-form-item> 
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="status" label="订单状态">
                            <el-select v-model="queryForm.status">
                                <el-option
                                    v-for="order_status in order_statuslist"
                                    :label="order_status.status"
                                    :value="order_status.id"
                                    :key="order_status.id"></el-option>
                            </el-select>
                        </el-form-item> 
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="status" label="货物状态">
                            <el-select v-model="queryForm.product_status">
                                <el-option
                                    v-for="shipping_status in shipping_statuslist"
                                    :label="shipping_status.status"
                                    :value="shipping_status.id"
                                    :key="shipping_status.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="range" label="购买时间区间">
                            <el-date-picker
                                v-model="range"
                                type="daterange"
                                placeholder="选择日期范围"
                                @change="rangeChange">
                            </el-date-picker>
                        </el-form-item> 
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <el-button @click="handleReset">重 置</el-button>
                <el-button @click="handleSubmit" type="info">查 询</el-button>
            </div>
        </MyDialog>
    </template>
    
<script>
    import DialogForm from '@/mix/DialogForm';
    // import DepartmentSelectProxy from '@/packages/DepartSelectProxy';
    import GroupSelectProxy from '@/packages/GroupSelectProxy';
    import EmployeeSelectProxy from '@/packages/EmployeeSelectProxy';

    import status from '../status';
    export default {
        name: 'advance',
        mixins:[DialogForm,status],
        props:{
            users:{

            }
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                
                // groups:[],
                // users:[],
                range:"",
                
                queryForm:{
                    phone:'',
                    start:'',
                    goods_name:'',
                    consignee:'',
                    sn:'',
                    end:'',
                    condition:'',
                    range:"",

                    // hyf 添加
                    status:"", //订单状态 
                    product_status:"", //货物状态
                   
                    appends:['status_text','product_status_text','after_sale_status_text'],
                    group_id:'',
                    department_id:'',
                    deal_id:'',
                },
            }
        },
        methods:{
            handleReset(){
                this.$refs.queryForm.resetFields();
                this.$parent.$emit('search-tool-change', {});
            },
            getDepartment(data){
                this.department = data;
            },
            getGroup(data){
                this.group = data.items;
            },
            getUsers(data){
                this.users = data.items;
            },
            depChange(department_id){
                this.queryForm.group_id = '';
                this.queryForm.deal_id = '';
                this.GroupProxy.setParam({
                    department_id:department_id,
                }).load();
            },
            groupChange(group_id){
                let vmThis = this;
                vmThis.searchForm.deal_id = '';
                this.EmployeeProxy.setParam({
                    department_id:vmThis.queryForm.department_id,
                    group_id:group_id,
                    fields:['id','realname','group_id','department_id']
                }).load();
            },
            handleSubmit(){
                this.$parent.$emit('search-tool-change', this.queryForm);
                this.handleClose();
            },
            rangeChange(v){
                if (v) {
                    let ar = v.split(" - ");
                    this.queryForm.start = ar[0] + " 00:00:00";
                    this.queryForm.end = ar[1] + " 23:59:59";
                } else {
                    this.queryForm.start = "";
                    this.queryForm.end = "";
                }
            },
            
        },
        created(){
           

            // this.GroupProxy = new GroupSelectProxy({fields:["*"]},this.getGroup,this);
            // this.EmployeeProxy = new EmployeeSelectProxy({ fields:["*"]},this.getUsers,this);
        }
    }
</script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
        .name-input{
            max-width: 217px;
        }
    </style>
    