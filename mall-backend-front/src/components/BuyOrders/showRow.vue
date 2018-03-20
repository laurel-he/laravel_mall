<template>
    <div >
        <MyDialog title="查看" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form ref="rowInfoForm" :model="rowInfoForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="总金额" prop="order_all_money">
                            <el-input v-model="rowInfoForm.order_all_money" size="small" :disabled="true"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item label="应付金额" prop="order_pay_money">
                            <el-input v-model="rowInfoForm.order_pay_money" size="small" :disabled="true"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="购买客户"  prop="cus_id">
                            <el-select v-model='rowInfoForm.cus_id'>
                                <el-option v-for="buy in buyer" :label="buy.name"
                                           :value="buy.id" :key="buy.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item label="成交员工" prop="deal_id">
                            <el-select v-model='rowInfoForm.deal_id' :disabled="true">
                                <el-option v-for="user in users"
                                           :label="user.realname"
                                           :value="user.id"
                                           :key="user.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                </el-row>
                <!--<el-row>-->
                    <!--<el-col :span="12">-->
                        <!--<el-form-item label="订单状态" prop="order_status">-->
                            <!--<el-select v-model='rowInfoForm.order_status' :disabled="true">-->
                                <!--<el-option-->
                                        <!--v-for="order_status in order_statuslist"-->
                                        <!--:label="order_status.status"-->
                                        <!--:value="order_status.status"-->
                                        <!--:key="order_status.id"></el-option>-->
                            <!--</el-select>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                    <!--<el-col :span="12">-->
                        <!--<el-form-item label="发货状态" prop="shipping_status">-->
                            <!--<el-select v-model='rowInfoForm.shipping_status' :disabled="true">-->
                                <!--<el-option-->
                                        <!--v-for="shipping_status in shipping_statuslist"-->
                                        <!--:label="shipping_status.status"-->
                                        <!--:value="shipping_status.status"-->
                                        <!--:key="shipping_status.id"></el-option>-->
                            <!--</el-select>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                <!--</el-row>-->
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">退 出</el-button>
                <!--<submit-button-->
                <!--:observer="dialogThis"-->
                <!--@click="formSubmit('rowInfoForm')" >-->
                <!--保 存-->
                <!--</submit-button>-->
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import SubmitButton from '../../components/common/SubmitButton';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            buyer:{
                type:Array,
                default:[],
            },
            users:{
                type:Array,
                default:[],
            },


        },
        ajaxProxy:{
            required:true,
            type: Object,
            default: null
        },
        data () {
            return {
                order_statuslist:[
                    {id:'0',status:'未付款'},
                    {id:'1',status:'待确认'},
                    {id:'2',status:'已完成'},
                    {id:'3',status:'已关闭'},
                    {id:'4',status:'退款中'},
                ],
                shipping_statuslist:[
                    {id:'0',status:'待发货'},
                    {id:'1',status:'已发货'},
                    {id:'2',status:'已收货'},
                ],
                check_status:[
                    {id:'0', status:'通过'},
                    {id:'1', status:'未通过'},
                    {id:'2', status:'未审核'}
                ],
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'100px',
                rowInfoForm:{
                    order_sn:'',
                    goods_name:'',
                    consignee:'',
                    order_all_money:'',
                    order_pay_money:'',
                    order_status:'',
                    pay_name:'',
                    shipping_status:'',
                    shipping_name:'',
                    order_time:'',
                },

            }
        },

        methods:{
            addFormSubmit:function(){
                console.log(this.rowForm);
                this.state6=false;
            },
            closeDialog:function(){
                this.state6=false;
            },
            pdtTimeDateChange(v){
                this.rowForm.pdt_time = v;
            },
            intoTimeDateChange(v){
                this.rowForm.into_time = v;
            },
            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id, model);
            },
            onOpen(event){
                this.rowInfoForm = event.params.rowData;
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

