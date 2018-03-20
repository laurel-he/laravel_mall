<template>
    <div >
        <MyDialog title="添加" :name="name" :width="width" :height="height" >
            <el-form :model="addForm" :rules="rules" :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="标题" prop="title" >
                            <el-input class="name-input" v-model="addForm.title"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                    
                </el-row>
                
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="图片"  prop="image">
                            <el-upload
                                    class="avatar-uploader"
                                    :action="url"
                                    :show-file-list="false"
                                    :on-success="addFormUploadSuccess"
                                    :before-upload="beforeAvatarUpload">
                                <img v-if="imageUrl" :src="imageUrl" class="avatar">
                                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            </el-upload>
                        </el-form-item>
                    </el-col>
                    
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="内容"  prop="body">
                            <quill-editor v-model="addForm.body"
                                ref="myQuillEditor"
                                :options="editorOption"
                                @blur="onEditorBlur($event)"
                                @focus="onEditorFocus($event)"
                                @ready="onEditorReady($event)"
                                @change="onEditorChange($event)">
                            </quill-editor>
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
    import APP_CONST from '../../config';
    import { quillRedefine } from 'vue-quill-editor-upload';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        components:{
            quillRedefine,
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                imageUrl:"",
                
                url:APP_CONST.UPLOAD_URL,
                // uplaodParam:{  name:"avater", subdir:'asdf' },
                uploadImg:"",
                
                addForm:{
                    title:"",
                    // user_id:"",
                    body:"",
                    image:""
                },

                rules:{
                    // name:[
                    //     { required: true, message: '请输入小组名称', trigger: 'blur' }
                    // ],  
                    // department_id:[
                    //     { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                    // ]
                },

                editorOption:{},
            }
        },

        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            } ,
            addFormUploadSuccess(response, file){
                // this.addForm.head = URL.createObjectURL(file.raw);
                if (response.status==1) {
                    this.addForm.image = response.data.fullurl;
                    this.uploadImg = response.data.fullurl;
                }
                
            },
            // handleAvatarSuccess(res, file) {
            //     this.head = URL.createObjectURL(file.raw);
            // },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
            },

            //---------编辑器
            onEditorBlur(quill) {
                //console.log('editor blur!', quill);
            },
            onEditorFocus(quill) {
                //console.log('editor focus!', quill);
                
            },
            onEditorReady(quill) {
                //console.log('editor ready!', quill);
            },
            onEditorChange({ quill, html, text }) {
                //console.log('editor change!', quill.getContents(), html, text);
                this.addForm.body = html;
                //console.log(quill.getContents());
            }
        },
        created(){
            this.editorOption = quillRedefine(APP_CONST.editor_option);
        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

