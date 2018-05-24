<template>
    <div>
        <MyDialog title="废 单" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm" ref="addForm" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="发货状态" prop="status" >
                            <el-select v-model="addForm.status" size="small" placeholder="发货状态">
                               <el-option :value="0" label="待发"></el-option>
                               <el-option :value="1" label="已发"></el-option>
                               <el-option :value="2" label="废单"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="废单时间" prop="waste_time">
                            <el-date-picker
                                    v-model="addForm.waste_time"
                                    type="datetime"
                                    @change="timeChange"
                                    placeholder="选择日期时间">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="原因" prop="waste_reason">
                            <el-input v-model="addForm.waste_reason" type="textarea" placeholder="原因"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <!--<el-button type="info" @click="handleClose">保 存</el-button>-->
                 <submit-button
                    @click="formSubmit('addForm')"
                    :observer="dialogThis">
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>
<script>
import DialogForm from '../../mix/DialogForm';
import APP_CONST from '../../config';
export default {
    name: 'add-delivery',
    mixins:[DialogForm],
    components: {
        
    },
    props:{

    },
    data(){
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            addForm:{
                id:'',
                status:0,
                waste_reason:'',
                waste_time:'',
            },
            model:{}
        }
    },
    methods:{
        timeChange(v){
            this.addForm.waste_time=v;
        },
        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
        },
        onBeforeOpen(model) {
            this.model =  model.params;
        }
    },
    watch:{
        model:function(val, oldVal){
            this.initObject(val, this.addForm);
        }
    },
    mounted(){

    },
    created(){

    }

}
</script>
<style scoped>

</style>
