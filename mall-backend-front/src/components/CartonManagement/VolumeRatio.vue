<template>
    <div>
        <MyDialog title="设置商品与纸箱比例" :name="name" :width="width" :height="height" @before-open="onOpen" @before-close="onClose">
            <el-form :model="editForm" ref="editForm" :label-width="labelWidth" :rules="rules" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="长宽高比例" prop="frame_ratio" >
                            <el-input v-model="editForm.frame_ratio" placeholder="请填写长宽高比例"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="体积比例" prop="volume_ratio" >
                            <el-input v-model="editForm.volume_ratio" placeholder="请填写体积比例"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

            </el-form>

            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="formSubmit('editForm')">
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
            labelWidth:'110px',
            editForm:{
                id:'',
                frame_ratio:'',
                volume_ratio:'',

            },
            rules:{
                // frame_ratio:[
                //     { required: true, message: '请输入纸箱类型', trigger: 'blur' }
                // ],
                // volume_ratio:[
                //     { required: true, message: '请输入纸箱型号', trigger: 'blur' }
                // ],
            },
            model:''
        }
    },
    methods:{
        getAjaxPromise(model){
            if(model.id){
                return this.ajaxProxy.update(model.id, model);
            }else{
                return this.ajaxProxy.create(model);
            }

        },
        onOpen(param){
            this.model = param.params.model;
        },
        onClose(){
            this.$emit('onClose');
        },
    },
    watch:{
        model:function(val, oldVal){
            for (const key in this.editForm) {
                if (this.editForm.hasOwnProperty(key)) {
                    this.editForm[key] = val[key];
                }
            }
        }
    },


}
</script>
<style scoped>

</style>
