<template>
    <div>
        <MyDialog title="修 改" :name="name" :width="width" :height="height">
            <el-form :model="addForm" ref="addForm" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户姓名" prop="cus_name" >
                            <el-input v-model="addForm.cus_name" :disabled="true" placeholder="客户姓名"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="购买商品" prop="goods_name">
                            <el-input v-model="addForm.goods_name" :disabled="true" placeholder="购买商品"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="品种" prop="category" >
                            <el-input v-model="addForm.category" :disabled="true" placeholder="品种"></el-input>
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
                        <el-form-item label="销售人员" prop="sale_name" >
                            <el-input v-model="addForm.sale_name" :disabled="true" placeholder="销售人员"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="购买时间" prop="buy_time">
                            <el-input v-model="addForm.buy_time" :disabled="true" placeholder="购买时间"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="经理审核时间" prop="manager_check_time" >
                            <el-input v-model="addForm.manager_check_time" :disabled="true" placeholder="经理审核时间"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="goods_num" >
                            <el-input v-model="addForm.goods_num" placeholder="商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="是否指定快递" prop="select_express">
                            <el-input v-model="addForm.select_express" placeholder="是否指定快递"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="快递公司" prop="express_company" >
                            <el-input v-model="addForm.express_company" placeholder="快递公司"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="快递单号" prop="express_num">
                            <el-input v-model="addForm.express_num" placeholder="快递单号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="收件人" prop="receive_name" >
                            <el-input v-model="addForm.receive_name" placeholder="收件人"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="手机" prop="receive_tel">
                            <el-input v-model="addForm.receive_tel" placeholder="手机"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="重量" prop="weight" >
                            <el-input v-model="addForm.weight" placeholder="重量"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="快递费" prop="express_fee">
                            <el-input v-model="addForm.express_fee" placeholder="快递费"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="配送费" prop="send_fee">
                            <el-input v-model="addForm.send_fee" placeholder="配送费"></el-input>
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
    name: 'handle-edit',
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
                goods_name:'',
                category:'',
                num:'',
                sale_name:'',
                buy_time:'',
                manager_check_time:'',
                goods_num:'',
                select_express:'',
                express_company:'',
                express_num:'',
                receive_name:'',
                receive_tel:'',
                weight:'',
                express_fee:'',
                send_fee:'',
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
