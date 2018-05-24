<template>
    <div >
        <MyDialog  title="添加员工" :name='name'  :width="width" :height="height">
            <el-form 
                ref="addForm"  
                :rules='rules'
                :model="addForm" 
                :label-width="labelWidth"  
                :label-position="labelPosition">
                <el-tabs  type="card" v-model="activeName">
                    <el-tab-pane label="账号" name="first">
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="登录账号" prop="account">
                                    <el-input class="name-input" v-model="addForm.account"  auto-complete="off"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                
                                <el-form-item label="员工姓名" prop="realname">
                                        <el-input class="name-input" v-model="addForm.realname" auto-complete="off"></el-input>
                                    </el-form-item>
                            </el-col>
                            
                            
                        </el-row>
                        <el-row >
                            <el-col :span="12">
                                <el-form-item label="密码">
                                    <el-input class="name-input" type="password" v-model="addForm.password" auto-complete="off"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="所属团队" prop="group_id" >
                                    <el-select v-model="addForm.group_id" placeholder="团队小组">
                                        <el-option label="请选择" :value="0"></el-option>
                                        <el-option
                                                v-for="group in groups"
                                                :label="group.name"
                                                :value="group.id"
                                                :key="group.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>

                        <!-- <el-row>
                            <el-col :span="12">
                                <el-form-item label="所属部门" prop="department_id">
                                    <el-select  v-model="addForm.department_id" placeholder="部门" @change="departmentChange">
                                        <el-option label="请选择" :value="0"></el-option>
                                        <el-option v-for="department in departments"
                                                    :label="department.name"
                                                    :value="department.id"
                                                    :key="department.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                               
                            </el-col>
                        </el-row> -->

                        <el-row>
                            <el-col :span="24">
                                <el-form-item label="员工职能">
                                    <el-radio-group
                                        v-model="addForm.role_ids">
                                        <el-radio v-for="role in roles"  :label="role.id" :key="role.id">
                                            {{role.display_name}}
                                        </el-radio>
                                    </el-radio-group>
                                </el-form-item>
                                <el-alert
                                    title="如果要给员工添加多个职能时（身兼多职的情况），请联系管理员"
                                    type="warning"
                                    :closable="false">
                                </el-alert>
                            </el-col>
                        </el-row>
                    </el-tab-pane>
                    <el-tab-pane label="其它信息" name="second">
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="头像">
                                    <el-upload
                                        class="avatar-uploader"
                                        name="avatar"
                                        :data="uplaodParam"
                                        :action="url"
                                        :show-file-list="false"
                                        :on-success="addFormUploadSuccess"
                                        :before-upload="beforeAvatarUpload">
                                        <img v-if="uploadImg" :src="uploadImg" class="avatar">
                                        <el-button size="small" type="primary">点击上传</el-button>
                                    </el-upload>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="性别">
                                    <el-radio-group v-model="addForm.sex" >
                                        <el-radio class="radio"  :label="1">男</el-radio>
                                        <el-radio class="radio"  :label="2">女</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </el-col>
                        </el-row>

                        <el-row>
                            <el-col :span="12">

                                <el-form-item label="手机" prop="mobilephone">
                                    <el-input class="name-input" v-model="addForm.mobilephone"  auto-complete="off"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="固话座机" prop="telephone">
                                    <el-input class="name-input" v-model="addForm.telephone" auto-complet="off"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>

                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="QQ号" prop="qq">
                                    <el-input class="name-input" v-model="addForm.qq" auto-complete="off"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="QQ昵称">
                                    <el-input class="name-input" v-model="addForm.qq_nickname" auto-complet="off"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="微信号" prop="weixin">
                                    <el-input class="name-input" v-model="addForm.weixin" auto-complete="off"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="微信昵称">
                                    <el-input class="name-input" v-model="addForm.weixin_nickname" auto-complet="off"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="身份证号" prop="id_card">
                                    <el-input class="name-input" v-model="addForm.id_card" auto-complet="off"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>

                        <el-form-item label="住址">
                            <el-input
                                    v-model="addForm.address"
                                    type="textarea"
                                    placeholder="请输入内容">
                            </el-input>
                        </el-form-item>
                    </el-tab-pane>
                    <el-tab-pane label="身份证照" name="third">
                        <el-row>
                            <el-col :span="24">
                                <el-form-item label="手持身份证照">
                                    <el-upload
                                        class="avatar-uploader"
                                        name="avatar"
                                        :data="carParam"
                                        :action="url"
                                        accept="image/gif, image/jpeg,image/jpg,image/png"
                                        :show-file-list="false"
                                        :on-success="handleCardImg"
                                        :on-error="uploadError"
                                        :before-upload="beforeAvatarUpload">
                                        <img v-if="cardImg" :src="cardImg" class="avatar show-img">
                                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                    </el-upload>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <el-form-item label="身份证正面照">
                                    <el-upload
                                        class="avatar-uploader"
                                        name="avatar"
                                        :data="carParam"
                                        :action="url"
                                        accept="image/gif, image/jpeg,image/jpg,image/png"
                                        :show-file-list="false"
                                        :on-success="handleCardFront"
                                        :on-error="uploadError"
                                        :before-upload="beforeAvatarUpload">
                                        <img v-if="cardFront" :src="cardFront" class="avatar show-img">
                                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                    </el-upload>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="24">
                                <el-form-item label="身份证反面照">
                                    <el-upload
                                        class="avatar-uploader"
                                        name="avatar"
                                        :data="carParam"
                                        :action="url"
                                        accept="image/gif, image/jpeg,image/jpg,image/png"
                                        :show-file-list="false"
                                        :on-success="handleCardBack"
                                        :on-error="uploadError"
                                        :before-upload="beforeAvatarUpload">
                                        <img v-if="cardBack" :src="cardBack" class="avatar show-img">
                                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                                    </el-upload>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-tab-pane>
                </el-tabs>
            </el-form>
            <div slot="dialog-foot" >
                <el-button @click="handleClose()">取 消</el-button>
                <SubmitButton
                    @click="formSubmit('addForm')" 
                    :observer="dialogThis" ></SubmitButton>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../../mix/DialogForm';
    import getGroupsByPid from '../../../ajaxProxy/getGroupsByPid';
    import { mapGetters } from 'vuex';
    
    import APP_CONST from '../../../config';

    import { PHONE_REG,QQ_REG } from '@/config/index';
    export default {
        name: 'addDialog',
        mixins:[DialogForm,getGroupsByPid],
        props:{
            groups:{
                type: Array,
                default:[]
            },

        },
        computed:{
            ...mapGetters({
            // 映射 `this.creator` 为 `store.getters.user_id`
            // 映射 `this.creator_name` 为 `store.getters.realname`
                creator: 'user_id',
                creator_name:"realname",
                'user_department_id':'department_id',
                roles: 'assignable',
            })
        },
        data () {
            return {
                dialogThis: this,
                labelPosition:"right",
                labelWidth:'80px',
                url: APP_CONST.UPLOAD_URL,
                uplaodParam:{  name:"avater", subdir:'asdf' },
                uploadImg:"",
                activeName:'first',
                carParam:{subdir:'IDCar'},
                cardImg:'',
                cardFront:'',
                cardBack:'',
                addForm:{
                    head:"",
                    account:"",
                    password:"123456",
                    role_ids:"",
                    group_id:0,
                    department_id:0,
                    sex:1,
                    telephone:"",
                    mobilephone:"",
                    realname:"",
                    address:"",
                    qq:"",
                    qq_nickname:"",
                    weixin:"",
                    weixin_nickname:"",
                    id_card:"",
                    card_img:'',
                    card_front:'',
                    card_back:'',
                    // location:'成都市',
                    // ip:'192.168.0.1',
                    // create_name:"系统管理员",
                    // lg_time:"2017-12-28",
                    // out_time:"2017-12-28",


                },
                rules:{
                    account:[
                        { required: true, message:"账号必填", type:'string'}
                    ],
                    mobilephone:[
                        { required: true, message:'请输入正确的手机号', pattern: PHONE_REG, trigger:'blur'},
                    ],
                    qq:[
                        { required: true, message:'请输入正确格式的QQ号',  pattern: QQ_REG, trigger:'blur'},
                    ],
                }

            }
        },

        methods:{
            departmentChange(v){
                this.groups=[];
                // this.addForm.group_id='';
                this.getGroupsAjax(v);
            },
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            addFormUploadSuccess(response, file){
                if (response.status==1) {
                    this.addForm.head = response.data.url;
                    this.uploadImg = response.data.fullurl;
                }
            },
            beforeAvatarUpload(file) {
                // const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                // if (!isJPG) {
                //     this.$message.error('上传头像图片只能是 JPG 格式!');
                // }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isLt2M;
            },
            
            resetUploadImg (){
                this.uploadImg = "";
            },
            resetAddFormField(){
                this.addForm.department_id = this.user_department_id;
                this.addForm.creator = this.creator;
                this.addForm.creator_name = this.creator_name;
                this.addForm.roles = "";
            },
            handleCardImg(response, file, fileList){
                this.addForm.card_img = response.data.url;
                this.cardImg = URL.createObjectURL(file.raw);
            },
            handleCardFront(response, file, fileLis){
                this.addForm.card_front = response.data.url;
                this.cardFront = URL.createObjectURL(file.raw);
            },
            handleCardBack(response, file, fileLis){
                this.addForm.card_back = response.data.url;
                this.cardBack = URL.createObjectURL(file.raw);
            },
            uploadError(err, file, fileList){
                this.$message.error('上传出错：' + err.msg);
            },
            beforeAvatarUpload(file) {
                const isLt2M = file.size / 1024 / 1024 < 2;
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isLt2M;
            },
        },
        created(){
            this.resetAddFormField();
            this.$on('submit-final', this.resetUploadImg);
            this.$on('submit-final', this.resetAddFormField);
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    @import "../style/index.css";
    .avatar{
        max-width: 200px; 
        max-height: 200px;
    }
    .name-input{
        max-width: 217px;
    }
</style>

