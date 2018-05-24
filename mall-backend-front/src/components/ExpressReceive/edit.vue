<template>
    <div >
        <MyDialog title="添加物流揽件" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm"  :label-width="labelWidth"  ref="editForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="express_id" label="物流公司">
                            <el-select v-model="editForm.express_id" size="small" placeholder="物流公司" @change="expressChange">
                                <el-option v-for="v in companys" :value="v.id" :key="v.id" :label="v.company_name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="发货单号" prop="assign_sn" >
                            <el-input class="name-input" v-model="editForm.assign_sn"  auto-complete="off"  placeholder="请填写发货单号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="快递单号" prop="express_sn" >
                            <el-input class="name-input" v-model="editForm.express_sn"  auto-complete="off"  placeholder="请填写快递单号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="发货核对时间" prop="assign_check_time" >
                            <el-date-picker
                                    v-model="editForm.assign_check_time"
                                    type="datetime"
                                    placeholder="选择日期时间"
                                    @change="checkTime">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="核对人"  prop="check_user_name">
                            <el-input class="name-input"  auto-complete="off" v-model="editForm.check_user_name" placeholder="请填写核对人"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="formSubmit('editForm')" >
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
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            companys:{
                type:Array
            }
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'120px',
                computedusers:[],
                editForm:{
                    id:'',
                    express_id: "",
                    express_name: "",
                    assign_sn: "",
                    express_sn: "",
                    assign_check_time: "",
                    check_user_id: '',
                    check_user_name:''
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
                },
                model:{}
            }
        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id,model);
            },
            checkTime(v){
                this.editForm.assign_check_time=v;
            },
            expressChange(v){
                let i =''
                for (i in this.companys){
                    if(this.companys[i]['id'] == v){
                        this.editForm.express_name =this.companys[i]['company_name']
                    }
                }
            },
            onOpen(param){
                this.model = param.params.model;
            },
        },
        watch:{
            model:function(val, oldVal){
                for (const key in this.editForm) {
                    if (this.editForm.hasOwnProperty(key)) {
                        this.editForm[key] = val[key]
                    }
                }

            }
        },
        created(){

        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

