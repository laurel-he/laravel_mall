<template>
    <div>
        <MyDialog title="修 改" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="editForm" ref="editForm" :rules="rules" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户姓名" prop="cus_name" :disabled="true">
                            {{ model.cus_name}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="购买商品" prop="goods_name">
                            {{ model.goods_name}}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="品种" prop="cate_kind" >
                            {{ model.cate_kind}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="数量" prop="goods_num">
                            {{ model.goods_num}}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="销售人员" prop="sale_name" >
                            {{ model.sale_name}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="购买时间" prop="buy_time">
                            {{ model.buy_time}}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="经理审核时间" prop="manager_check_time" >
                            {{ model.manager_check_time}}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="sku_sn" >
                            <el-input v-model="editForm.sku_sn" placeholder="商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="是否指定快递" prop="set_express">
                            <el-radio class="radio" v-model="editForm.set_express" :label="1">是</el-radio>
                            <el-radio class="radio" v-model="editForm.set_express" :label="2">否</el-radio>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="快递公司" prop="express_name" >
                            <el-input v-model="editForm.express_name" placeholder="快递公司"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="快递单号" prop="express_sn">
                            <el-input v-model="editForm.express_sn" placeholder="快递单号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="收件人" prop="deliver_name" >
                            <el-input v-model="editForm.deliver_name" placeholder="收件人"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="手机" prop="deliver_phone">
                            <el-input v-model="editForm.deliver_phone" placeholder="手机"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="重量" prop="weight" >
                            <el-input v-model="editForm.weight" placeholder="重量"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="快递费" prop="express_fee">
                            <el-input v-model="editForm.express_fee" placeholder="快递费"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="配送费" prop="assign_fee">
                            <el-input v-model="editForm.assign_fee" placeholder="配送费"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="修改时间" prop="edit_time">
                            <el-date-picker
                                    v-model="editForm.edit_time"
                                    type="datetime"
                                    @change="timeChange"
                                    placeholder="选择日期时间">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <!--<el-button type="info" @click="handleClose">保 存</el-button>-->
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
import APP_CONST from '../../config';
import { PHONE_REG } from "@/config/index";
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
            labelWidth:'120px',
            editForm:{
                id:"",
                sku_sn:"",
                set_express:'',
                express_name:"",
                express_id:'',
                express_sn:"",
                deliver_name:"",
                deliver_phone:"",
                weight:"",
                express_fee:"",
                user_id:"",
                user_name:"",
                edit_time:"",
                assign_fee:""
            },
            model:{},
            rules:{
                deliver_phone:[
                    { required: true,message:'请输入联系人电话', pattern:PHONE_REG, trigger:'blur'}
                ],
            },
        }
    },
    methods:{
        timeChange(v){
            this.editForm.edit_time=v;
        },
        getAjaxPromise(model){
         return this.ajaxProxy.update(model.id, model);
        },
        onBeforeOpen(model) {
            this.model =  model.params;
        },
    },
    watch:{
        model:function(val, oldVal){
            this.initObject(val, this.editForm);
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
