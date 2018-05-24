<template>
    <div >
        <MyDialog title="查看" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form ref="rowInfoForm" :model="rowInfoForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="订单号" prop="id">
                            {{ model.order_sn }}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="总金额" prop="order_all_money">
                            {{ model.order_all_money }}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="应付金额" prop="order_pay_money">
                            <el-input v-model="rowInfoForm.order_pay_money" size="small"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item label="购买客户"  prop="cus_id">
                            {{ model.cus_name }}
                        </el-form-item>
                    </el-col>

                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="成交员工" prop="deal_name">
                                {{ model.deal_name }}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="发货状态" prop="product_status">
                            <el-select v-model='rowInfoForm.product_status' :disabled="true">
                                <el-option
                                        v-for="shipping_status in shipping_statuslist"
                                        :label="shipping_status.status"
                                        :value="shipping_status.id"
                                        :key="shipping_status.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="订单状态" prop="status">
                            <el-select v-model='rowInfoForm.status' clearable>
                                <el-option
                                        v-for="order_status in order_statuslist"
                                        :label="order_status.status"
                                        :value="order_status.id"
                                        :key="order_status.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <!-- <el-col :span='12'>
                        <el-form-item label="配送方式" prop="shipping_name">
                            <el-input v-model="rowInfoForm.shipping_name" size="small" :disabled="true"></el-input>
                        </el-form-item>
                    </el-col> -->
                </el-row>
                <!--<el-row>-->
                <!--<el-col :span="12">-->
                    <!--<el-form-item label="审核状态" prop="order_status">-->
                        <!--<el-select v-model='rowInfoForm.check_status'>-->
                            <!--<el-option-->
                                    <!--v-for="order_status in check_status"-->
                                    <!--:label="order_status.status"-->
                                    <!--:value="order_status.id"-->
                                    <!--:key="order_status.id"-->
                                    <!--&gt;</el-option>-->
                        <!--</el-select>-->
                    <!--</el-form-item>-->
                <!--</el-col>-->
                <!--</el-row>-->
            </el-form>

            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="formSubmit('rowInfoForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import status from './status';
    export default {
        name: 'addDialog',
        mixins:[DialogForm,status],
        props:{

        },
        ajaxProxy:{
            required:true,
            type: Object,
            default: null
        },
        data () {
            return {
                // order_statuslist:[
                //     {id:0,status:'待审核'},
                //     {id:1,status:'审核通过'},
                //     {id:2,status:'待充值'},
                //     {id:3,status:'配货中'},
                //     {id:4,status:'订单完成'},
                //     {id:5,status:'订单取消'},
                //     {id:6,status:'审核未通过'},
                // ],
                // shipping_statuslist:[
                //     {id:0,status:'未处理'},
                //     {id:1,status:'配货中'},
                //     {id:2,status:'已发货'},
                //     {id:3,status:'已签收'},
                // ],
                check_status:[
                    {id:'0', status:'通过'},
                    {id:'1', status:'未通过'},
                    {id:'2', status:'未审核'}
                ],
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'100px',
                rowInfoForm:{
                    goods_name:'',
                    consignee:'',
                    order_all_money:'',
                    order_pay_money:'',
                    order_status:'',
                    pay_name:'',
                    shipping_status:'',
                    shipping_name:'',
                    order_time:'',
                    id:""
                },
                model:{}

            }
        },

        methods:{
            addFormSubmit:function(){
                this.state6=false;
            },
            closeDialog:function(){
                this.state6=false;
            },

            onOpen(event){
            //   this.rowInfoForm = event.params.rowData;
                this.model = event.params.rowData;
            },
            getAjaxPromise(model){
                delete model.cus_name;
                delete model.buyer;
                delete model.user_name;
                delete model.users;
                return this.ajaxProxy.update(model.id, model);
            },
            DateChange:function(v){
                this.rowInfoForm.order_time = v;
            },
        },
        watch:{

            model:function(val, oldVal){
//                console.log(val);
                for (const key in this.rowInfoForm) {
                    if (this.rowInfoForm.hasOwnProperty(key)) {
                        console.log(key);
                        this.rowInfoForm[key] = val[key]
                    }
                }
            }
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

