<template>
    <div>
        <MyDialog title="修改编辑" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm" ref="editForm" :rules="rules" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="纸箱类型" prop="carton_name" >
                            <el-input v-model="editForm.carton_name" placeholder="请填写纸箱类型"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="纸箱型号" prop="carton_model" >
                            <el-input v-model="editForm.carton_model" placeholder="请填写纸箱型号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="15">
                        <el-form-item label="纸箱规格"  prop="format">
                            <el-col :span="5">
                                <el-input placeholder="长" v-model="editForm.carton_long"></el-input>
                            </el-col>
                            <el-col class="line" :span="2">-</el-col>
                            <el-col :span="5">
                                <el-input placeholder="宽" v-model="editForm.carton_wide"></el-input>
                            </el-col>
                            <el-col class="line" :span="2">-</el-col>
                            <el-col :span="5">
                                <el-input placeholder="高" v-model="editForm.carton_high"></el-input>
                            </el-col>
                            mm
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="纸箱重量(g)" prop="carton_weight" >
                            <el-input v-model.number="editForm.carton_weight" placeholder="请填写纸箱重量(g)"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="纸箱数量" prop="carton_number">
                            <el-input v-model.number="editForm.carton_number" placeholder="请填写纸箱数量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="14">
                        <el-form-item label="备注" prop="remark">
                            <el-input type="textarea" v-model="editForm.remark" placeholder="请填写备注"></el-input>
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
    name: 'Edit',
    mixins:[DialogForm,FormMix],
    components: {
        
    },
    props:{

    },
    data(){
        var validateFormat = (rule, value, callback) => {
            if (this.editForm.carton_long === '' || this.editForm.carton_wide === '' || this.editForm.carton_high === '') {
                callback(new Error('请输入完整规格'));
            } else {
                callback();
            }
        };
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'120px',
            editForm:{
                id:'',
                carton_name:'',
                carton_model:'',
                carton_long:'',
                carton_wide:'',
                carton_high:'',
                carton_weight:'',
                carton_number:'',
                remark:'',
            },
            rules:{
                carton_name:[
                    { required: true, message: '请输入纸箱类型', trigger: 'blur' }
                ],
                carton_model:[
                    { required: true, message: '请输入纸箱型号', trigger: 'blur' }
                ],
                format: [
                    {required: true, validator: validateFormat, trigger: 'change' }
                ],
                carton_weight:[
                    { required: true, message: '请输入纸箱重量', trigger: 'change',type: 'number'},
                    { type: 'number', message: '必须为数字值'}
                ],
                carton_number:[
                    { required: true, message: '请输入纸箱数量', trigger: 'change',type: 'number' },
                    { type: 'number', message: '必须为数字值'}
                ],

            },
            model:null,
        }
    },
    methods:{
        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
        },
        onOpen(param){
			this.model = param.params.model;
        },
    },
    mounted(){

    },
    created(){

    },
    watch:{
        model:function(val, oldVal){
            for (const key in this.editForm) {
                if (this.editForm.hasOwnProperty(key)) {
                    this.editForm[key] = val[key];
                }
            }
        }
    }

}
</script>
<style scoped>

</style>
