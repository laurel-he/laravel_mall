<template>
        <div >
            <MyDialog title="查看商品" :name="name" :width="width" :height="height" @before-open="onOpen">
                <el-form :model="editForm" ref="editForm" :label-width="labelWidth"  :label-position="labelPosition">
                    <el-tabs v-model="activeName" @tab-click="handleClick">
                        <el-tab-pane label="基本信息" name="first">
                            <el-row>
                                <el-col :span="12">
                                    <el-form-item label="商品名称" prop="goods_name" >
                                        <el-input class="name-input" v-model="editForm.goods_name"  auto-complete="off" placeholder="请填写商品名称"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="12">
                                    <el-form-item label="商品分类" prop="cate_id">
                                        <el-cascader
                                            expand-trigger="hover"
                                            :options="cateOptions"
                                            v-model="editForm.cate_id"
                                            @change="handleCateChange"
                                            filterable change-on-select clearable
                                            placeholder="选择商品分类" size="small" style="line-height:28px;">
                                        </el-cascader>
                                    </el-form-item>
                                </el-col>
                            </el-row>
    
                            <el-row>
                                    <el-col :span="12">
                                        <el-form-item label="副标题" prop="subtitle" >
                                            <el-input class="name-input" v-model="editForm.subtitle"  auto-complete="off" placeholder="请填写商品名称"></el-input>
                                        </el-form-item>
                                    </el-col>
                                    <el-col :span="12">
                                        <el-form-item label="简介" prop="brief">
                                            <el-input type="textarea" v-model="editForm.brief"></el-input>
                                        </el-form-item>
                                    </el-col>
                                </el-row>
                    
                            <el-row>
                                <el-col :span="12">
                                    <el-form-item label="商品价格"  prop="goods_price">
                                        <el-input class="name-input" v-model="editForm.goods_price"  auto-complete="off" placeholder="请填写商品价格"></el-input>
                                    </el-form-item>
                                </el-col>
                                <el-col :span="12">
                                    <el-form-item label="是否上架"  prop="status">
                                        <el-radio-group v-model="editForm.status">
                                            <el-radio :label="1">是</el-radio>
                                            <el-radio :label="2">否</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="12">
                                    <el-form-item label="商品货号"  prop="goods_number">
                                        <el-input class="name-input" v-model="editForm.goods_number"  auto-complete="off" placeholder="请填写商品货号"></el-input>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col :span="12">
                                    <el-form-item label="商品单位"  prop="unit_type">
                                        <el-select v-model='editForm.unit_type'>
                                            <el-option v-for="(item,index) in UnitTypes" :label="item"
                                                        :value="index" :key="index">
                                            </el-option>
                                        </el-select>
                                    </el-form-item>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col>
                                    <div v-html="editForm.description"></div>
                                </el-col>
                            </el-row>
                        </el-tab-pane>
    
                        
    
                        <el-tab-pane label="商品图片" name="third">
    
                            <el-upload
                                ref="upload"
                                name="avatar"
                                :auto-upload="false"
                                :action="uploadUrl"
                                list-type="picture-card"
                                :file-list="fileList"
                                accept="image/gif, image/jpeg,image/jpg,image/png">
                                <i class="el-icon-plus"></i>
                            </el-upload>
                            <el-dialog v-model="dialogVisible" size="tiny">
                                <img width="100%" :src="dialogImageUrl" alt="">
                            </el-dialog>
                            
                        </el-tab-pane>
                    </el-tabs>
                </el-form>
        
                <div slot="dialog-foot" class="dialog-footer">
                    <el-button @click="handleClose">取 消</el-button>
                    
                </div>
    
            </MyDialog>
        </div>
    </template>
    
    <script>
    import DialogForm from '../../../mix/DialogForm';
    import AttrItem from '../../common/AttrFormItem';
    import APP_CONST from '../../../config';
    import { quillRedefine } from 'vue-quill-editor-upload';
    import localMix from '../mix';
    
    
    export default {
        name: 'Edit',
        mixins:[DialogForm,localMix],
        components: {
            AttrItem,
            quillRedefine,
        },
        props:{
            cateOptions:{
                type:Array,
                default:[]
            },
            uploadUrl:{
                type:String,
                default:'',
            },
    
        },
        data () {
            return {
                dialogImageUrl:'',
                dialogVisible: false,
                activeName:'first',
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                UnitTypes:{},
                editForm:{
                    subtitle:"",
                    brief:"",
                    goods_name:'',
                    cate_id:[],
                    goods_price:'',
                    status:'',
                    goods_number:'',
                    unit_type:'',
                    description:'',
                    img_path:[],
                    del_imgs:[],
                    cover_url:'',
                    id:'',
                    imgs:[],
                    category:[],
                    skus:[],
    
                },
                attrForm:{
                    value:"",
                    addon_value:""
                },
                editContent:'',
                editorOption:{},
                ctrlNum:0,
                urlDomain:'',
                fileList:[],
                cover_url:'',
                model:null,
    
            }
        },
        methods:{
            onOpen(param){
                this.fileList = [];
                
                let id = param.params.id;
                // this.model = param.params.model;
                this.UnitTypes = param.params.extra;
                // this.fileList = param.params.fileList;
                // this.urlDomain = param.params.urlDomain;
    
                this.ajaxProxy.find(id).then((data)=>{
                    let row = data.data;
                    row.del_imgs = [];
                    row.img_path = [];
                    row.cate_id = [];
                    for (let index = 0; index < row.category.length; index++) {
                        row.cate_id.push(row.category[index].id);
                    }
                    for (let index = 0; index < row.imgs.length; index++) {
                        this.fileList.push({name:row.imgs[index].url, url:row.imgs[index].full_url});  
                    }
    
                
    
    
                    this.model = row;
                })
    
    
            },
            handleClick(tab, event) {
                //console.log(tab, event);
            },
            handleCateChange(v){
                this.editForm.cate_id = v; 
            },
            handleRemove(file, fileList) {
                if(this.fileList.length !=0){
                    let delUrl;
                    let delUrlArr;
                    delUrlArr = file.url.split('/');
                    delUrl = '/'+delUrlArr[delUrlArr.length-2]+'/'+delUrlArr[delUrlArr.length-1];
                    this.editForm.del_imgs.push(delUrl);
                }
                console.log(this.editForm);
    
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            submitUpload() {
                this.$refs.upload.submit();
            },
            
    
            
    
            //---------提交请求
            getAjaxPromise(model){
                //console.log(model);
                return this.ajaxProxy.update(model.id, model);
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
                this.editContent = html;
                //console.log(quill.getContents());
            }
    
        },
        computed: {
            editor() {
                return this.$refs.myQuillEditor.quill;
            }
        },
        created(){
            this.editorOption = quillRedefine(APP_CONST.editor_option);
            //console.log(this.editorOption);
        },
        watch:{
            model:function(val, oldVal){
                for (const key in this.editForm) {
                    if (this.editForm.hasOwnProperty(key)) {
                        this.editForm[key] = val[key];
                        this.editContent = this.editForm.description;
                        if(key == 'unit_type'){
                             this.editForm[key] = this.editForm[key].toString();
                        }
                    }
                }
            }
        }
    
    
    
    }
    </script>
    
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
    .name-input{
        max-width: 217px;
    }
    .ql-toolbar.ql-snow + .ql-container.ql-snow {
        border-top: 0px;
        min-height: 300px;
    }

    .quill-editor .ql-container {
        height: 300px !important;
    }
    .v-modal {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        background: #000;
    }
</style>
          