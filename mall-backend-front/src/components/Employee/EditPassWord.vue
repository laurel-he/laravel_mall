<template>
    <MyDialog title="修改密码" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
        <el-form ref="editPasswordForm" :label-width="labelWidth" :rules="rules"   :model="editPasswordForm" :label-position="labelPosition">
            <el-form-item label="员工账号" prop="account">
                {{ editPasswordForm.account }}
            </el-form-item>
            <el-form-item label="新密码" prop="password">
                <el-input class="name-input" v-model="editPasswordForm.password"  type="password"  auto-complete="off" ></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="checkPass">
                <el-input class="name-input" type="password" v-model="editPasswordForm.checkPass" auto-complete="off"></el-input>
            </el-form-item>
        </el-form>
        <div slot="dialog-foot" class="dialog-footer">
            <el-button @click="handleClose">取 消</el-button>
            <submit-button 
                @click="formSubmit('editPasswordForm')" 
                :observer="dialogThis">
                保 存
            </submit-button>
        </div>
    </MyDialog>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
export default {
    name: 'editPassWord',
    mixins:[DialogForm],
    data () {
        let validatePass2 = (rule, value, callback) => {
            if (value === '') {
                callback(new Error('请再次输入密码'));
            } else if (value !== this.editPasswordForm.checkPass) {
                callback(new Error('两次输入密码不一致!'));
            } else {
                callback();
            }
        };
        return {
            labelPosition:"right",
            labelWidth:'80px',
            dialogThis:this,
            editPasswordForm:{
                id:"",
                account:"",
                password:"",
                checkPass:""
            },

            rules:{
                password: [
                    { required:true ,  type:'string', min:6, max:20, trigger: 'blur',message:'请输入新密码' }
                ],
                checkPass: [
                    { required:true , validator: validatePass2, trigger: 'blur' }
                ],
            }
        }
    },
    methods:{
        onBeforeOpen(param){
            this.editPasswordForm.id = param.params.model.id;
            this.editPasswordForm.account = param.params.model.account;
        },
        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
        },
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      
