<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true" ref="editForm" :model="editForm" :rules="rules" :label-width="labelWidth" :label-position="labelPosition">
                    <el-row>
						<el-form-item label="登录账号:" prop="account">
							{{ getUser.account }}
						</el-form-item>
					</el-row>
					
                    <!-- <el-row>
						<el-form-item label="旧密码:" prop="oldPwd">
							<el-input class="name-input" v-model="editForm.oldPwd" type="password" auto-complete="off"></el-input>
						</el-form-item>
					</el-row> -->
					<el-row>
						<el-form-item label="新密码:" prop="password">
							<el-input class="name-input" v-model="editForm.password" type="password" auto-complete="off"></el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="确认密码:" prop="checkNewPwd">
							<el-input class="name-input" v-model="editForm.checkNewPwd" type="password" auto-complete="off"></el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item style="margin-left:20px;">
							<el-button type="info" size="small" @click="formSubmit('editForm')">立即修改</el-button>
							<el-button type="info" size="small" @click="editFormReset('editForm')">重置</el-button>
						</el-form-item>
					</el-row>
                </el-form>
            </el-col>
        </el-row>

    </div>
</template>

<script>
	import PageMix from '../../mix/Page';
	import DialogForm from '@/mix/Form';
	import EmployeeAjaxProxy  from '@/ajaxProxy/Password';
	import { mapGetters } from 'vuex';

    export default {
        name:'UserSetting',
        pageTitle:"设置密码",
        mixins: [PageMix,DialogForm],
        data(){
			let validatePass2 = (rule, value, callback) => {
				if (value === '') {
					callback(new Error('请再次输入密码'));
				} else if (value !== this.editForm.password) {
					callback(new Error('两次输入密码不一致!'));
				} else {
					callback();
				}
			};
			let validateNewPwd =  (rule, value, callback) => {
				var reg = /^[A-Za-z0-9]{6,20}$/;
				if (value === '') {
					callback(new Error('请输入新登录密码'));
				} else if(!reg.test(value)){
					callback(new Error('密码为6-20位数字字母组合'));
				}else if (value == this.editForm.oldPwd) {
					callback(new Error('不能与旧密码一致!'));
				} else {
					callback();
				}
			};
			let validateOldPwd = (rule, value, callback) => {
				var reg = /^[A-Za-z0-9]{6,20}$/;
				if (value === '') {
					callback(new Error('请输入旧登录密码'));
				}else if (!reg.test(value)) {
					callback(new Error('密码为6-20位数字字母组合'));
				} else {
					callback();
				}
			};
            return {
				ajaxProxy: EmployeeAjaxProxy,
				labelPosition:"right",
            	labelWidth:'100px',
                editForm: {
                    account:'',
					// oldPwd:'',
					password:'',
					checkNewPwd:'',
				},
				rules:{
					// oldPwd:[
					// 	{required:true , validator:validateOldPwd,trigger: 'blur'},
					// ],
					password:[
						{ required:true ,validator:validateNewPwd,trigger: 'blur'},
					],
					checkNewPwd:[
						{required:true , validator:validatePass2,trigger:'blur'},
					],
            	}
            }
		},
		computed:{
			...mapGetters([
				'getUser'
			]),
		},
        methods:{
            editFormReset(name){
                this.$refs[name].resetFields();
			},
			getAjaxPromise(model){
				console.log(this.getUser);
				model.id = this.getUser.id;
				model.account = this.getUser.account;
            	return this.ajaxProxy.update(model.id, model);
			},
			realSubmit(model, name){
				let ajaxPromise =  this.getAjaxPromise(model);
				let vmthis = this;

				ajaxPromise.then(function(response){
					if (response.data.status　==　0) {
						vmthis.$message.error(response.data.msg ? response.data.msg : "操作失败" );
						vmthis.$emit('submit-error', name);
					} else {
						vmthis.$message.success('设置成功,为了不异响使用请退出重新登录！');
						vmthis.$refs[name].resetFields();
						vmthis.$emit('submit-success', name);
						
					}
				}).catch(function(error){
					if (error.response.status && error.response.status == 422) {
						let x = error.response.data;
						let message = [];
						for (const key in x) {
							if (x.hasOwnProperty(key)) {
								const element = x[key];
								message.push(element);
							}
						}
						// console.log(x.toString());
						vmthis.$message.error(message.join());
					} else {
						console.log(error);
						vmthis.$message.error('出错了');
					}
                
            	}).then(function(){
					vmthis.$emit('submit-final', name);
            	});
        	}
        },
        created(){
            
        }
    }
</script>

<style scoped>

</style>