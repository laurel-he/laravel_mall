<template>
    <div>
        <MyDialog title="废 单" :name="name" :width="width" :height="height">
            <el-form :model="addForm" ref="addForm" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="作废状态" prop="drop_satus" >
                            <el-select v-model="addForm.drop_satus" size="small" placeholder="作废状态">
                                <el-option label="正常" value="1"></el-option>
                                <el-option label="作废" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="原因" prop="reson">
                            <el-input v-model="addForm.reson" type="textarea" placeholder="原因"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <el-button type="info" @click="handleClose">保 存</el-button>
                <!-- <submit-button 
                    @click="beforeFormSubmit('addForm')"
                    :observer="dialogThis">
                    保 存
                </submit-button> -->
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
                drop_satus:'',
                reson:'',
            },
        }
    },
    methods:{
        getAjaxPromise(model){
            //return this.ajaxProxy.create(model);
        },
    },
    mounted(){

    },
    created(){

    }

}
</script>
<style scoped>

</style>
