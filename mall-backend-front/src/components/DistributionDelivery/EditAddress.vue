<template>
    <div>
        <MyDialog title="发 货" :name="name" :width="width" :height="height">
            <el-form :model="addForm" ref="addForm" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户姓名" prop="cus_name" >
                            <el-input v-model="addForm.cus_name" :disabled="true" placeholder="客户姓名"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="客户联系方式" prop="cus_tel">
                            <el-input v-model="addForm.cus_tel" :disabled="true" placeholder="客户联系方式"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="18">
                        <el-form-item label="旧地址" prop="old_address">
                            <el-input v-model="addForm.old_address" type="textarea" placeholder="旧收货地址"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="18">
                        <el-form-item label="新地址" prop="new_address">
                            <el-input v-model="addForm.new_address" type="textarea" placeholder="新收货地址"></el-input>
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
                cus_name:'',
                cus_tel:'',
                old_address:'',
                new_address:'',
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
