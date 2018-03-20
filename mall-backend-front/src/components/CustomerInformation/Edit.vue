<template>
    <div >
        <MyDialog title="添加客户" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm" ref="editForm"  :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户姓名" prop="name" >
                            <el-input  class="name-input" v-model="editForm.name"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="客户年龄"  prop="age">
                            <el-input  class="name-input" v-model="editForm.age"  auto-complete="off" ></el-input>

                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="QQ号"  prop="qq">
                            <el-input class="name-input" v-model="editForm.qq"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="QQ昵称"  prop="qq_nickname">
                            <el-input class="name-input" v-model="editForm.qq_nickname"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="微信号"  prop="weixin">
                            <el-input class="name-input" v-model="editForm.weixin"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="微信昵称"  prop="weixin_nickname">
                            <el-input class="name-input" v-model="editForm.weixin_nickname"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="手机号"  prop="phone">
                            <el-input class="name-input" v-model="editForm.phone"  auto-complete="off" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="性别" >
                            <el-radio-group v-model="editForm.sex" >
                                <el-radio   :label="1">男</el-radio>
                                <el-radio   :label="2">女</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
    
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        @click="formSubmit('editForm')"
                        :observer="dialogThis">
                    保 存
                </submit-button>
            </div>

        </MyDialog>
    </div>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
export default {
    name: 'Edit',
    mixins:[DialogForm],
    props:{
        ajaxProxy:{
            required:true,
            type: Object,
            default: null
        }
    },
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            editForm:{
                id:'',
                name:"",
                age:"",
                qq:"",
                qq_nickname:"",
                weixin:"",
                weixin_nickname:'',
                sex:'',
                phone:''
            },
            model:''
        }
    },
    methods:{
        onOpen(param){
             //console.log(param);
            this.model = param.params.model;
            this.model.qq = param.params.model.contacts[0].qq;
            this.model.qq_nickname = param.params.model.contacts[0].qq_nickname;
            this.model.weixin = param.params.model.contacts[0].weixin;
            this.model.weixin_nickname = param.params.model.contacts[0].weixin_nickname;
            this.model.phone = param.params.model.contacts[0].phone;
        },

        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
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
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      