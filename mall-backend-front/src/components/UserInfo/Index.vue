<template>
    <div>
        <el-row>
            <el-col :span="12">
                <el-form ref="addForm" :model="addForm" :rules="rules" :label-width="labelWidth" :label-position="labelPosition">
                    <el-row>
						<el-form-item label="登录账号:" prop="account">
							{{ getUser.account }}
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="所属职务:" prop="display_name">
							{{ getUser.roles[0].display_name }}
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="真实姓名:" prop="realname">
							<el-input class="name-input" v-model="addForm.realname" size="small" placeholder="请填写真实姓名">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="固话座机:" prop="telephone">
							<el-input class="name-input" v-model="addForm.telephone" size="small" placeholder="请填写固话座机">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="手机号码:" prop="mobilephone">
							<el-input class="name-input" v-model="addForm.mobilephone" size="small" placeholder="请填写手机号码">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="身份证号:" prop="id_card">
							<el-input class="name-input" v-model="addForm.id_card" size="small" placeholder="请填写身份证号">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="QQ号码:" prop="qq">
							<el-input class="name-input" v-model="addForm.qq" size="small" placeholder="请填写QQ号码">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="QQ昵称:" prop="qq_nickname">
							<el-input class="name-input" v-model="addForm.qq_nickname" size="small" placeholder="请填写QQ昵称">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="微信号码:" prop="weixin">
							<el-input class="name-input" v-model="addForm.weixin" size="small" placeholder="请填写微信号码">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="微信昵称:" prop="weixin_nickname">
							<el-input class="name-input" v-model="addForm.weixin_nickname" size="small" placeholder="请填写微信昵称">
							</el-input>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item label="性别:" prop="sex">
							<el-radio class="radio" v-model="addForm.sex" label="1">男</el-radio>
							<el-radio class="radio" v-model="addForm.sex" label="2">女</el-radio>
						</el-form-item>
					</el-row>
					<el-row>
						<el-col>
							<el-form-item label="家庭住址:" prop="address">
								<el-input
										v-model="addForm.address"
										type="textarea"
										placeholder="请输入家庭住址" :rows="2" style="max-width:300px">
								</el-input>
							</el-form-item>
						</el-col>
					</el-row>
					<el-row>
						<el-form-item label="修改头像">
							<el-upload
								class="avatar-uploader"
								name="avatar"
								:data="headParam"
								:action="url"
								accept="image/gif, image/jpeg,image/jpg,image/png"
								:show-file-list="false"
								:on-success="handleHeadImg"
								:on-error="uploadError"
								:before-upload="beforeAvatarUpload">
								<img v-if="headImg" :src="headImg" class="avatar">
								<i v-else class="el-icon-plus avatar-uploader-icon"></i>
							</el-upload>
						</el-form-item>
					</el-row>
					<el-row>
						<el-form-item style="margin-left:20px;">
							<el-button type="info" size="small" @click="formSubmit('addForm')">立即修改</el-button>
							<el-button type="info" size="small" @click="addFormReset('addForm')">重置</el-button>
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
	import EmployeeAjaxProxy  from '../../ajaxProxy/Employee';
	import APP_CONST from '../../config';
	import { PHONE_REG,QQ_REG } from "@/config/index";
	import { mapGetters } from 'vuex';

    export default {
        name:'UserInfo',
        pageTitle:"个人信息",
        mixins: [PageMix,DialogForm],
        data(){
			let validatePass2 = (rule, value, callback) => {
				if (value === '') {
					callback(new Error('请再次输入密码'));
				} else if (value !== this.addForm.password) {
					callback(new Error('两次输入密码不一致!'));
				} else {
					callback();
				}
			};
            return {
				ajaxProxy: EmployeeAjaxProxy,
				labelPosition:"right",
				labelWidth:'100px',
				url: APP_CONST.UPLOAD_URL,
				headParam:{subdir:'head'},
                headImg:'',
                addForm: {
					realname:'',
					telephone:'',
					mobilephone:'',
					id_card:'',
					qq:'',
					qq_nickname:'',
					weixin:'',
					weixin_nickname:'',
					sex:1,
					address:'',
                    head:'',
				},
				rules:{
					mobilephone:[
                        { required: true, message:'请输入正确的手机号', pattern: PHONE_REG, trigger:'blur'},
                    ],
                    qq:[
                        { required: true, message:'请输入正确格式的QQ号',  pattern: QQ_REG, trigger:'blur'},
                    ],
            	},
				model:null,
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
				// console.log(this.getUser);
				model.id = this.getUser.id;
				console.log(model);
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
						vmthis.headImg = '';
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
			},
			beforeAvatarUpload(file) {
                const isLt2M = file.size / 1024 / 1024 < 2;
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isLt2M;
			},
			uploadError(err, file, fileList){
                this.$message.error('上传出错：' + err.msg);
			},
			handleHeadImg(response, file, fileList){
                this.addForm.head = response.data.url;
                this.headImg = URL.createObjectURL(file.raw);
            },
		},
        created(){
			console.log(this.getUser);
			this.model = this.getUser;

        },
		watch:{
			model:function(val, oldVal){
				for (const key in this.addForm) {
					if (this.addForm.hasOwnProperty(key)) {
						this.addForm[key] = val[key];
					}
					if(key == 'sex'){
						this.addForm[key] = val[key].toString();
					}

					if(key == 'head'){
						this.headImg = val[key];
					}
				}
			}
    	}
    }
</script>

<style scoped>
    .avatar{
        max-width: 200px; 
        max-height: 200px;
    }
    .name-input{
        max-width: 217px;
    }
</style>