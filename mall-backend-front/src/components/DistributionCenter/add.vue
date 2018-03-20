<template>
    <div >
        <MyDialog title="添加配送中心" :name="name" :width="width" :height="height" >
            <el-form :model="addForm"  :label-width="labelWidth" :rules="rules" ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="名称" prop="name" >
                            <el-input class="name-input" v-model="addForm.name"  auto-complete="off"  placeholder="请填写配送中心名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="英文简称" prop="eng_name" >
                            <el-input class="name-input" v-model="addForm.eng_name"  auto-complete="off"  placeholder="请填写英文简称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="联系人" prop="contact" >
                            <el-input class="name-input" v-model="addForm.contact"  auto-complete="off"  placeholder="请填写联系人"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="联系电话" prop="contact_phone" >
                            <el-input class="name-input" v-model="addForm.contact_phone"  auto-complete="off"  placeholder="请填写联系人电话"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="地址"  prop="address">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.address" placeholder="请填配送中心地址"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="comment">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.comment" placeholder="请填写备注"></el-input>
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
                types: [
                    {id:1,name:'面膜'},
                    {id:2,name:'爽肤水'},
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
                    name: "",
                    eng_name: "",
                    contact: "",
                    contact_phone: "",
                    address: '',
                    comment:''
                },

                rules:{
                    name:[
                        { required: true, message: '请输入配送中心名称', trigger: 'blur' }
                    ],
                    eng_name:[
                        { required: true, message:'请输入英文简称', trigger: 'blur', },
                        {  min: 1, max: 3, message: '长度不能超过3个字符', trigger: 'blur'  }
                    ],
                    contact:[
                        { required: true,message:'请输入联系人', type: 'string', trigger:'blur'}
                    ],
                    contact_phone:[
                        { required: true,message:'请输入联系人电话', type: 'string', trigger:'blur'}
                    ],
                    address:[
                        { required: true, message:'请输入地址', type: 'string', trigger:'blur'}
                    ],
                }
            }
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

