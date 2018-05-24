<template>
        <div>
            <MyDialog title="添加" :name="name" :width="width" :height="height">
                <el-form :model="addForm"  ref="addForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="部门" prop="department_id">
                                <el-select clearable  placeholder="请选择部门名"  v-model="departmentInput" @change="onDepartChange">
                                    <el-option v-for="(v,index) in departments"
                                        :label="v.name" 
                                        :value="index"
                                        :key="v.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <!-- <el-col :span="12">
                            <el-form-item label="小组" prop="group_id" >
                                <el-select size="small" placeholder="请选择小组"  v-model="groupInput" @change="onGroupChange">
                                        <el-option v-for="(v,index) in groups"
                                            :label="v.name" 
                                            :value="index"
                                            :key="v.id">
                                            {{ v.name }}
                                        </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col> -->
                        <el-col :span="12">
                            <el-form-item label="金额" prop="money" >
                                <el-input class="name-input"  placeholder="输入金额" v-model.number="addForm.money"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row>
                        <!-- <el-col :span="12">
                            <el-form-item label="员工" prop="user_id" >
                                <el-select size="small" placeholder="请选择员工"  v-model="userInput" @change="onUserChange">
                                    <el-option v-for="(v,index) in users"
                                        :label="v.realname"
                                        :value="index"
                                        :key="v.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col> -->

                        
                    </el-row>
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="充值方式" prop="charge_type" >
                                <el-select   placeholder="请选择充值方式"  v-model="addForm.charge_type" >
                                    <el-option v-for="(v,index) in chargeTypes"
                                        :label="v.name"
                                        :value="v.id"
                                        :key="index">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="充值时间" prop="charge_time" >
                                <el-date-picker
                                        v-model="addForm.charge_time"
                                        type="date"
                                         placeholder="选择充值时间"
                                        :picker-options="pickerOptions"
                                        :editable="false"
                                        @change="timeChange">
                                </el-date-picker>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="备注" prop="remark" >
                                <el-input type="textarea" :rows="2" v-model="addForm.remark"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </el-form>
        
                <div slot="dialog-foot" class="dialog-footer">
                    <el-button @click="handleClose">取 消</el-button>
                    <submit-button
                            @click="formSubmit('addForm')"
                            :observer="dialogThis">
                        保 存
                    </submit-button>
                </div>
    
            </MyDialog>
        </div>
    </template>
    
    <script>
    import DialogForm from '../../mix/DialogForm';
    import DataProxy from '../../packages/DataProxy';
    import getUsersByGid from '../../ajaxProxy/getUsersByGid';
    import getGroupsByPid from '../../ajaxProxy/getGroupsByPid';
    import DepartSelectProxy from '../../packages/DepartSelectProxy';
    import GroupSelectProxy from '../../packages/GroupSelectProxy';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';

    import { mapGetters } from 'vuex';
    
    export default {
        name: 'Add',
        mixins:[DialogForm,getGroupsByPid,getUsersByGid],
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                departments:[],
                groups:[],
                users:[],
                chargeTypes:[
                    {id:1,name:'微信'},
                    {id:2,name:'支付宝'},
                    {id:3,name:'银行转账'},
                    ],
                departmentInput:'',
                groupInput:'',
                userInput:'',
                addForm:{
                    department_id:"",
                    // group_id:"",
                    // user_id:"",
                    department_name:"",
                    group_name:"",
                    charge_type:'',
                    charge_time:"",
                    realname:"",
                    money:"",
                    creator_id:"",
                    creator:"",
                    remark:"",
                    charge_department:""
                },
                rules:{
                    money:[
                        { required: true, message:'金额未输入或输入的格式不正确', pattern:/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/ , trigger:'blur',min:0 }
                    ],
                    remark:[
                        { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                    ]
                },
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() > Date.now() ;
                    }
                },
            }
        },
        computed:{
            ...mapGetters({
                'creator_id':'user_id',
                'creator':'realname',
                'departName':'departName'
            })
        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            timeChange(v){
                this.addForm.charge_time=v;
            },
            loadDepartment(data){
                this.departments = data.items;
            },
            onDepartChange(index){
                this.groups=[];
                this.users=[];
                this.addForm.department_id=this.departments[index].id;
                this.addForm.department_name=this.departments[index].name;
                this.addForm.group_id='';
                this.addForm.user_id='';
                this.getGroupsAjax(this.departments[index].id);

            },
            onGroupChange(index){
                this.users=[];
                this.addForm.user_id='';
                this.addForm.group_id=this.groups[index].id;
                this.addForm.group_name=this.groups[index].name;
                this.getUsersAjax(this.groups[index].id);
            },
            onUserChange(index){
                this.addForm.user_id=this.users[index].id;
                this.addForm.realname=this.users[index].realname;
            }
            
        },
        created(){
            let departProxy = new DepartSelectProxy(null, this.loadDepartment, this);
            this.departProxy = departProxy;
            this.departProxy.load();

            this.addForm.creator_id = this.creator_id;
            this.addForm.creator = this.creator;
            
        }
    }
    </script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
        .name-input{
            max-width: 217px;
        }
    </style>
          