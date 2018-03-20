<template>
    <div>
        <!-- 文本 -->
        <!-- <span v-if="type=='文本'">
            <el-input v-model="formObject.value"></el-input>
        </span> -->
        <!-- 图片 -->
        <!-- <span v-else >
            <el-input v-model="formObject.value"></el-input>
            <el-input type="hidden" v-model="formObject.addon_value"></el-input>
            <el-button>上传</el-button>
        </span> -->

        <el-form-item
            v-for="(item, index) in formObject"
            :label="item.name"
            :key="item.id">   
            <template v-if="item.type != attr.SELECT">
                <el-col :span="10" >
                    <el-input v-model="item.value"></el-input>
                </el-col>
                <el-col :span="1">&nbsp;</el-col>
                <template v-if="item.type== attr.IMG ">
                    <el-col :span="2">
                        <!-- <el-button>上传</el-button> -->
                        <!-- :before-upload="beforeAvatarUpload" -->
                        <el-upload
                            class="avatar-uploader"
                            name="avatar"
                            :data="uplaodParam"
                            :action="url"
                            :show-file-list="false"
                            :on-success="addFormUploadSuccess">
                            <el-button size="small" type="primary" @click="setCurItem(index)">点击上传</el-button>
                        </el-upload>
                        <input type="hidden" v-model="item.addon_value">
                    </el-col>
                    <el-col :span="10">
                        <img :src="formObject[index].fullurl" alt="" width="50" height="50">
                    </el-col>
                </template>
            </template>
            <template v-else>
                <el-col :span="10">
                    <el-select v-model="item.value" >
                        <el-option v-for="attri in item.add_value" :label="attri.value" :key="attri.value" :value="attri.value"></el-option>
                    </el-select>
                </el-col>
            </template>
        </el-form-item>
    </div>
  </template>
  
<script>
    import APP_CONST from  '../../config';


    export default {
        name: 'AttrItem',
        props:{
            type:{
                type: String,
                // default:'文本'
            },
            formObject:{
                required: true,
                type: Array
            }
        },
        data () {
            return {
                attr:APP_CONST.ATTR,
                uplaodParam:{  name:"attr", subdir:'asdf' },
                url: APP_CONST.UPLOAD_URL,
            }
        },
        methods:{
            addFormUploadSuccess(response, file){

                if (response.status==1) {
                    // this.addForm.head = response.data.url;
                    this.formObject[this.cur_item_index].addon_value =  response.data.url;
                    this.formObject[this.cur_item_index].fullurl = response.data.fullurl;
                    // this.uploadImg = response.data.fullurl;
                }
                // console.log(this.cur_item);
            },
            setCurItem(item){
                this.cur_item_index  = item;
            }
        },
        created(){
            console.log(this.formObject);
        }
    }
</script>
  
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
  