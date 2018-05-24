<template>
        <div >
            <MyDialog title="高级查询" :name="name" :width="width" :height="height" >
                <el-form :model="queryForm" ref="queryForm"  :label-width="labelWidth" 　  :label-position="labelPosition">
                        　     
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="部门" prop="department_id">
                                <el-select   v-model="queryForm.department_id" placeholder="部门" @change="onDepartChange" clearable>
                                    <el-option v-for="depart in departments" :value="depart.id" :label="depart.name" :key="depart.id"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="小组" prop="group_id">
                                <el-select   v-model="queryForm.group_id" placeholder="小组" @change="onGroupChange" clearable>
                                    <el-option v-for="group in groups" :value="group.id" :label="group.name" :key="group.id"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="销售员工" prop="user_id">
                                <el-select v-model="queryForm.user_id" placeholder="员工" clearable>
                                    <el-option v-for="user in users" :value="user.id" :label="user.realname" :key="user.id"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="客户姓名" prop="name" >
                                <el-input  class="name-input" v-model="queryForm.name"  auto-complete="off" placeholder="请填写客户姓名"></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="客户类型" prop="type">
                                <el-select v-model="queryForm.type" clearable>
                                    <el-option label="" :key="0" value=""></el-option>
                                    <el-option v-for="(value, key) in cusType" :label="value" :key="key" :value="key"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="手机" prop="phone">
                                <el-input class="name-input" v-model="queryForm.phone" ></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="QQ" prop="qq">
                                <el-input class="name-input" v-model="queryForm.qq" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="微信" prop="weixin">
                                <el-input class="name-input" v-model="queryForm.weixin" ></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="身份证号" prop="id_card">
                                <el-input class="name-input" v-model="queryForm.id_card" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="住址" prop="cus_address">
                                <el-input
                                    type="textarea"
                                    :rows="2"
                                    placeholder="请输入内容"
                                    v-model="queryForm.cus_address">
                                  </el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </el-form>
        
                <div slot="dialog-foot" class="dialog-footer">
                    <el-button @click="handleClose">取 消</el-button>
                    <el-button @click="handleReset">重 置</el-button>
                    <el-button type="primary" @click="handleSubmit">查 询</el-button>

                    <!-- <submit-button
                            @click="formSubmit('queryForm')"
                            :observer="dialogThis">
                        查 询
                    </submit-button> -->
                </div>
    
            </MyDialog>
        </div>
    </template>
    
    <script>
    import DialogForm from '@/mix/DialogForm';
    import DepartSelect from '@/packages/DepartSelectProxy';
    import GroupSelect from '@/packages/GroupSelectProxy';
    import EmployeeSelect from '@/packages/EmployeeSelectProxy';
    
    export default {
        name: 'Advance',
        mixins:[DialogForm],
        props:{
            cusType:{
                type:Object,
                default:function () {
                    return {};
                }
            }
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'100px',
                state7: this.addOpen,
                departments:[],
                groups:[],
                users:[],
                queryForm:{
                    department_id:"",
                    group_id:"",
                    user_id:"",
                    name:"",
                    qq:'',
                    weixin:"",
                    phone:'',
                    type:'',
                    id_card:'',
                    cus_address:'',
                }
            }
        },
    
        methods:{
            handleReset(){
                this.$refs.queryForm.resetFields();
                this.$parent.$emit('search-tool-change', {});
            },
            handleSubmit(){
                this.$parent.$emit('search-tool-change', this.queryForm);
                this.handleClose();
            },
            loadDeparts(data){
                if (data.items) {
                    this.departments = data.items;
                } else {
                    this.departments = data;
                }
            },
            loadGroups(data){
                this.groups = data.items;
            },
            loadUsers(data){
                this.users = data.items;
            },
            /**
             *  local 
             */
             onDepartChange(v){
                this.queryForm.group_id = '';
                this.queryForm.user_id = '';
                if (v.toString().length > 0) {
                    this.groupSelect.setParam({department_id:v,fields:['id','name']});
                    this.groupSelect.load();
                }    
            },
            /**
             *  local
             */
            onGroupChange(v){
                this.queryForm.user_id = '';
                if (v.toString().length > 0) {
                    this.employeeSelect.setParam({group_id:v,fields:['id', 'realname']});
                    this.employeeSelect.load();
                }  
            },
    
        },
        created(){
            this.departSelect = new DepartSelect({type:'0'}, this.loadDeparts, this);
            this.groupSelect  = new GroupSelect(null, this.loadGroups, this);
            this.employeeSelect = new EmployeeSelect(null, this.loadUsers, this);

            this.departSelect.load();
            console.log(this.cusType);
        }
    
    }
    </script>
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
        .name-input{
            max-width: 217px;
        }
    </style>
          
