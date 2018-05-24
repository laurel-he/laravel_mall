<template>
    <div class="login">
        <div id="lg">
            <!--<span class="span"> <h1 class="h1"></h1></span>-->
            <div id="insert">
                <span><h2 class="h2">管理系统</h2></span>
                <el-row type="flex" justify="center">
                        <el-form ref="loginForm" label-position='top' label-width="80px" :model="loginForm" @keyup.enter.native="login" >
                            <el-form-item label="账号" prop="account">
                                <el-input v-model="loginForm.account" ></el-input>
                            </el-form-item>
                            <el-form-item label="密码" prop="password">
                                <el-input type="password" v-model="loginForm.password" ></el-input>
                            </el-form-item>
                            <el-form-item >
                                <el-button class="but" type="primary" @click="login" :loading="logining">登 录</el-button>
                                <!--<el-button @click="resetForm">重 置</el-button>-->
                            </el-form-item>
                        </el-form>
                </el-row>
            </div>
        </div>

    </div>
  </template>
  
<script>
    import { mapMutations } from 'vuex';
    import loginAjaxProxy from '../ajaxProxy/Login';

    export default {
        name: 'Login',
        data () {
            return {
                loginForm:{
                    account:"",
                    password:"",
                },
                logining:false,
            }
        },
        methods:{
            ...mapMutations({
                'loginUser':'login'
            }),

            login(){
                let vmThis = this;
                this.logining = true;
                loginAjaxProxy.login(vmThis.loginForm).then(function(response){
                    let data = response.data;
                   
                    if (data.status == 0) {
                        // throw new Error(data.msg);
                        vmThis.$message.error(data.msg);
                        vmThis.logining = false;
                        return ;
                    }
                    // console.log(data.data);
                    vmThis.loginUser(data.data)
                    vmThis.logining = false;
                }).catch(function(data){
                    vmThis.$message.error('出错了');
                    vmThis.logining = false;
                })
                
            },
            resetForm(){
                this.$refs.loginForm.resetFields();
            },
        
        }

    }
</script>
  
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.login{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background-color:  #0090E6;
    background-image: url("/images/loginbackground2.png");
    /* background-size: 100% 100%; */
    background-position: center;
    background-repeat: no-repeat;
}
#lg{
    width: 889px;
    height:667px;
    /*background-color: #0090E6;*/
    padding-top: 20px;
    margin:50px auto;

}
.h1{
    margin:10px auto;
    text-align:center;
    color: #0090F2;
}
.h2{
    margin:10px auto;
    text-align:center;
    color: #0090F2;
}
#insert{
    width: 400px;
    height:400px;
    background-color: white;
    margin:30px auto;
    padding-top: 20px;
    border-radius: 5px;
}
.but{
    width: 192px;
    margin-top: 30px;
}
</style>
  