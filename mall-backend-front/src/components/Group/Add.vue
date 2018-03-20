<template>
    <div >
        <MyDialog title="添加" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm" :rules="rules" :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="小组名称" prop="name" >
                            <el-input class="name-input" v-model="addForm.name"  auto-complete="off" placeholder="请填写小组名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="所属部门" prop="department_id" >
                            <el-select v-model.number='addForm.department_id' :disabled="strategyAddDepart" @change="onDepartChange">
                                <el-option v-for="department in departments" 
                                :label="department.name" 
                                :value="department.id" 
                                :key="department.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="负责人"  prop="manager_id">
                            <el-select v-model='addForm.manager_id'>
                                <el-option v-for="user in computedusers" :label="user.realname" 
                                :value="user.id" :key="user.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="是否启用" prop="status">
                            <el-radio-group v-model="addForm.status">
                                <el-radio :label="1">启用</el-radio>
                                <el-radio :label="0">禁用</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="remarks">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.remarks" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
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
        props:{
            departments:{
                type: Array,
                default:[]
            },
            strategies:{
                type: Object,
                default:null
            }
            
        },
        // components:{
        //     Dialog
        // },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                computedusers:[], 
                addForm:{
                    name:"",
                    manager_id:"",
                    remarks:"",
                    status:1,
                    department_id:''
                },

                rules:{
                    name:[
                        { required: true, message: '请输入小组名称', trigger: 'blur' }
                    ],  
                    department_id:[
                        { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                    ],
                    remarks:[
                        { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
              ]
                }
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id':'department_id'
            }),
            strategyAddDepart(){
                return this.strategies.add_depart == -1 ;
            },  
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
            setDepartmentId(){
                this.addForm.department_id = this.user_department_id != 0 ? this.user_department_id : "";
                
            },
            onBeforeOpen(){
                if (this.addForm.department_id !=0 && this.addForm.department_id != "") {
                    this.onDepartChange(this.addForm.department_id);
                }
            }
        },
        created(){
            this.employeeSelect = new EmployeeSelectProxy({}, this.loadUsers, this);

            this.setDepartmentId();
            this.$on('submit-success', this.setDepartmentId);
        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

