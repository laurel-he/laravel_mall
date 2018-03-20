<template>
    <div >
        <MyDialog title="货架状态" :name="name" :width="width" :height="height" >
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="status_id"  label="货架状态">
                            <el-select
                                    v-model="addForm.status_id"

                                    placeholder="货架状态">
                                <el-option v-for="v in status" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="修改人" prop="change_name" >
                            <el-input class="name-input" v-model="addForm.change_name"  auto-complete="off" placeholder="请填写商品名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="修改时间" prop="change_time" >
                            <el-date-picker
                                    v-model="addForm.change_time"
                                    type="datetime"
                                    size="small"
                                    placeholder="选择日期时间">
                            </el-date-picker>
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
                labelWidth:'80px',
                computedusers:[],
                text:'满',
                number:21354,
                allNumber:50,
                putNumber:20,
                status: [
                    {id:1,name:'满'},
                    {id:2,name:'空'},
                    {id:3,name:'坏'},
                ],
                productNames: [
                    {id:1,name:'面膜 6张'},
                    {id:2,name:'爽肤水 200ml'},
                ],
                storageUsers: [
                    {id:1,name:'张三'},
                    {id:2,name:'李四'},
                ],
                departments:[
                    {id:1,name:'面膜'},
                    {id:2,name:'爽肤水'},
                ],
                distributors: [
                    {id:1,name:'顺丰'},
                    {id:2,name:'圆通'},
                ],
                addForm:{
                    status_id: "",
                    change_name: "",
                    change_time: "",
                    remarks:''
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
</style>

