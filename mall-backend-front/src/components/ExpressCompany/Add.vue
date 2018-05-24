<template>
    <div>
        <MyDialog title="添加" :name="name" :width="width" :height="height">
            <el-form :model="addForm" ref="addForm" :label-width="labelWidth" :rules="rules" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="物流名称" prop="company_name" >
                            <el-input v-model="addForm.company_name" placeholder="请填写物流名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="编号前缀" prop="eng" >
                            <el-input v-model="addForm.eng" placeholder=""></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="联系人" prop="contact_name">
                            <el-input v-model="addForm.contact_name" placeholder="请填写联系人"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="联系方式" prop="contact_tel" >
                            <el-input v-model="addForm.contact_tel" placeholder="请填写联系电话"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="14">
                        <el-form-item label="备注" prop="remark">
                            <el-input type="textarea" v-model="addForm.remark" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="formSubmit('addForm')">
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>
<script>
import DialogForm from '../../mix/DialogForm';
import FormMix from '../../mix/Form';
import APP_CONST from '../../config';
import DialogMix from '../../mix/Dialog';
import { mapGetters } from 'vuex';
import { PHONE_REG } from "@/config/index";
export default {
    name: 'Add',
    mixins:[DialogForm,FormMix],
    components: {
        
    },
    props:{

    },
    data(){
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            addForm:{
                company_name:'',
                contact_name:'',
                contact_tel:'',
                remark:'',
            },
            rules:{
                company_name:[
                    { required: true, message: '请输入物流公司名称', trigger: 'blur' }
                ],
                // contact_name:[
                //     { required: true, message:'请输入物流公司联系人', trigger: 'blur', },
                // ],
                // contact_tel:[
                //     { required: true,message:'请输入联系人电话', pattern:PHONE_REG, trigger:'blur'}
                // ],
                eng:[
                    { required: true, message:'必填,两个英文字母', pattern:/^[a-zA-Z]{2}$/, trigger:'blur'},
                ]

            }
        }
    },
    methods:{
        getAjaxPromise(model){
            return this.ajaxProxy.create(model);
        },
        // formSubmit(){
        //     console.log(this.addForm)
        // }
    },


}
</script>
<style scoped>

</style>
