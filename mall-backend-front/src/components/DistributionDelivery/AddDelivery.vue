<template>
    <div>
        <MyDialog title="发 货" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm" ref="addForm" :rules="rules" :label-width="labelWidth"  :label-position="labelPosition">
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
                            <el-input v-model="addForm.sku_sn" placeholder="商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="是否指定快递" prop="set_express">
                            <el-radio-group v-model="addForm.set_express">
                                <el-radio class="radio"  :label="1" >是</el-radio>
                                <el-radio class="radio"  :label="2" >否</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="快递公司" prop="express_id" >
                            <el-select v-model="addForm.express_id" @change="expressIdChange">
                                <el-option v-for="company in companies" :key="company.id" :label="company.company_name" :value="company.id"></el-option>
                            </el-select>
                            <!-- <el-input v-model="addForm.express_name" placeholder="快递公司"></el-input> -->
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="快递单号" prop="express_sn">
                            <el-input v-model="addForm.express_sn" placeholder="快递单号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="收件人" prop="deliver_name" >
                            <el-input v-model="addForm.deliver_name" placeholder="收件人"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="手机" prop="deliver_phone">
                            <el-input v-model="addForm.deliver_phone" placeholder="手机"></el-input>
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
                            <el-input v-model="addForm.express_fee" placeholder="0.00"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="配送费" prop="assign_fee">
                            <el-input v-model="addForm.assign_fee" placeholder="0.00"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="发货时间" prop="send_time">
                            <el-date-picker
                                    v-model="addForm.send_time"
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
                <!-- <el-button type="info" @click="handleClose">保 存</el-button> -->
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
import { mapGetters, mapMutations } from 'vuex';
import { PHONE_REG,PRICE_REG } from "@/config/index";
import ExpressCompanySelectProxy from "@/packages/ExpressCompanySelectProxy";



export default {
    name: 'add-delivery',
    mixins:[DialogForm],
    computed:{
        ...mapGetters([
            'getUser'
        ])
    },
    data(){
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'120px',
            addForm:{
                id:"",
                sku_sn:"",
                set_express:0,
                express_name:"",
                express_id:'',
                express_sn:"",
                deliver_name:"",
                deliver_phone:"",
                weight:"",
                express_fee:"0.00",
                user_id:"",
                user_name:"",
                assign_fee:"0.00",
                send_time:"",
                status:""
            },
            model:{},
            rules:{
                deliver_phone:[
                    { required: true,message:'请输入联系人电话', pattern:PHONE_REG, trigger:'blur'}
                ],
                express_fee:[
                    { required:true, message:'请输入快递费', pattern:PRICE_REG, trigger:'blur'},
                ],
                assign_fee:[
                    { required:true, message:'请输入配送费', pattern:PRICE_REG, trigger:'blur'},
                ],
            },

            companies:[]
        }
    },
    methods:{
        timeChange(v){
            this.addForm.send_time=v;
        },
        getAjaxPromise(model){
            if (model.status==0) {
                model.status = 1;
            }
            return this.ajaxProxy.update(model.id, model);
        },
        onBeforeOpen(model) {
            this.model =  model.params;
            this.model.user_id=this.getUser.id;
            this.model.user_name=this.getUser.realname;

            this.companyProxy.load();
        },
        loadCompany(data){
            this.companies = data.items;
        },
        expressIdChange(v){
            this.addForm.express_name = this.companies.find(element=>{
                return element.id == v
            }).company_name;
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
        this.companyProxy =  new ExpressCompanySelectProxy({field:['id','company_name']}, this.loadCompany, this);
    }

}
</script>
<style scoped>

</style>
