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
                    <el-col :span="12">
                        <el-form-item label="购买商品类型" prop="goods_type" >
                            <el-input v-model="addForm.goods_type" :disabled="true" placeholder="购买商品类型"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="数量" prop="num">
                            <el-input v-model="addForm.num" :disabled="true" placeholder="数量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="沟通明细" prop="contact_content">
                            <el-input v-model="addForm.contact_content" type="textarea" placeholder="沟通明细"></el-input>
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
                goods_type:'',
                num:'',
                contact_content:'',
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
