<template>
    <div>
        <MyDialog title="发起退货" :name="name" :width="width" :height="height" @before-open="onOpen" @before-close="onBeforeClose">
            <el-form ref="rowInfoForm" :model="rowInfoForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-steps :space="250" :active="active" finish-status="success" :center="true" :align-center="true">
                    <el-step title="选择退货的商品"></el-step>
                    <el-step title="填写快递号"></el-step>
                </el-steps>

                <div v-show="active==0">
                    <h5>订单信息</h5>
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="订单号" prop="id">
                                {{ model.order_sn }}
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="总金额" prop="order_all_money">
                                {{ model.order_all_money }} 元
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="订单状态" prop="status">
                                {{　model.status_text }}
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <h5>勾选要退货的商品</h5>
                    <el-row>
                        <el-col :span="24">
                            <el-table :data="goods" @selection-change="handleSelectionChange">
                                <el-table-column type="selection" width="55"></el-table-column>
                                <el-table-column label="商品名称" prop="goods_name"></el-table-column>
                                <el-table-column label="商品编号" prop="sku_sn" width="120"></el-table-column>
                                <el-table-column label="数量" prop="goods_number" width="160">
                                    <template slot-scope="scope">
                                        <el-input-number size="small" :min="1" :controls="false" :max="scope.row.goods_number" 
                                            v-model="scope.row.goods_num" @change="numberChange">
                                        </el-input-number>
                                    </template>
                                </el-table-column>
                                <el-table-column label="单价" prop="price" width="100"></el-table-column>
                            </el-table>
                        </el-col>
                    </el-row>
                    <el-row type="flex" justify="end">
                        <el-col :span="7" >
                            <label >
                                退款金额：
                            </label>
                            {{ rowInfoForm.refund }}
                        </el-col>
                    </el-row>
                </div>

                <div v-show="active==1">
                    <h5>备注与快递号</h5>
                    <el-row>
                        <el-col :span="16">
                            <el-form-item label="备注" prop="remark">
                                <el-input type="textarea" :rows="2" v-model="rowInfoForm.remark" 
                                    placeholder="请输入内容" size="small">
                                </el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
    
                    <el-row>
                        <el-col :span="16">
                            <el-form-item v-for="(items,index) in rowInfoForm.express" :label="'快递号'+(index+1)" :key="index" :prop="'express.'+index+'.value'">
                                <el-col :span="10"><el-input placeholder="快递号" size="small" v-model="items.express_sn"></el-input></el-col>
                                <el-col :span="1">&nbsp;</el-col>
                                <el-col :span="5"><el-button v-if="index!==0" size="small" @click.prevent="removeExpress(items)">删除</el-button></el-col>
                            </el-form-item>
                            <el-form-item>
                                <el-button size="small" type="info" icon="plus" @click="addExpress">添加快递号</el-button>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </div>
            </el-form>

            <div slot="dialog-foot" class="dialog-footer">
                <el-row type="flex" justify="space-between">
                    <el-col :span="12" class="button_step">
                        <el-button v-if="active>0"  @click="prev" class="pull-left">上一步</el-button>
                        <el-button v-if="active==0" @click="next" class="pull-left">下一步</el-button>
                    </el-col>
                    <el-col :span="12">
                        <el-button @click="handleClose">取 消</el-button>
                        <submit-button v-show="active==1" :observer="dialogThis" @click="beforeSubmit">
                            保 存
                        </submit-button>
                    </el-col>
                </el-row>
                

                
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import OrderGoodsAjaxProxy from '@/ajaxProxy/Ordergoods';
    import AfterSaleAjaxProxy from '@/ajaxProxy/AfterSale';

    import { mapGetters } from 'vuex';
    export default {
        name: 'ReturnGoods',
        mixins: [DialogForm],
        props: {
            ajaxProxy: {
                required: true,
                type: Object,
                default: null
            }
        },
        data() {
            return {
                
                dialogThis: this,
                labelPosition: "right",
                labelWidth: '70px',
                rowInfoForm: {
                    cus_id:"",
                    order_id: "",
                    user_id:'',
                    user_name:'',
                    group_id:'',
                    department_id:'',
                    type:0,
                    remark:'',
                    goods: [],
                    refund:"",
                    express:[
                        {express_sn:''}
                    ],
                    entrepot_id:''
                },
                goods:[],
                model: {},
                multipleSelection:[],
                active:0,

            }
        },
        computed:{
            ...mapGetters([
                'getUser'
            ]),
        },
        methods: {
            onOpen(param) {
                this.model = param.params;
                OrderGoodsAjaxProxy.get({order_id: this.model.id}).then((response)=>{
                    response.data.items.forEach(element => {
                        element.goods_num = parseInt(element.goods_number);
                        element.type  = 0;
                    });
                    this.goods = response.data.items;
                });
                this.rowInfoForm.order_id = this.model.id;
                this.rowInfoForm.entrepot_id = this.model.entrepot_id;
                this.rowInfoForm.user_id = this.getUser.id;
                this.rowInfoForm.user_name = this.getUser.realname;
                this.rowInfoForm.group_id = this.getUser.group_id;
                this.rowInfoForm.department_id = this.getUser.department_id;
                this.rowInfoForm.cus_id  = this.model.cus_id;
            },
            onBeforeClose(){
                this.multipleSelection = [];
                this.active = 0;
            },
            getAjaxPromise(model) {
                return AfterSaleAjaxProxy.create(model);
            },

            handleSelectionChange(v){
                this.multipleSelection = v;
            },
            next(){
                this.active ++ ;
            },
            prev(){
                if (this.active > 1) {
                    this.active --;
                } else {
                    this.active = 0;
                } 
            },
            del(index){
                this.multipleSelection.splice(index,1);
            },
            numberChange(){
                this.$nextTick(function(){
                    this.sumPrice();
                });
            },
            sumPrice(){
                if (this.multipleSelection.length > 0) {
                    let goods_price = this.multipleSelection.map(element=>{
                        return element.goods_num * parseFloat(element.price);
                    });
                    
                    this.rowInfoForm.refund = goods_price.reduce((ac, cu)=>{
                        return ac+cu;
                    }).toFixed(2);
                } else {
                    this.rowInfoForm.refund = '0.00';
                }  
            },
            addExpress(){
                this.rowInfoForm.express.push({ express_sn: '' });
            },
            removeExpress(item){
                var index = this.rowInfoForm.express.indexOf(item);
                if (index !== -1) {
                    this.rowInfoForm.express.splice(index, 1);
                }
            },
            beforeSubmit(){
                this.rowInfoForm.goods = this.multipleSelection;
                

                this.formSubmit('rowInfoForm');
            }
        },
        watch: {
            // model: function (val, oldVal) {
            //     for (const key in this.rowInfoForm) {
            //         if (this.rowInfoForm.hasOwnProperty(key)) {
            //             // console.log(key);
            //             this.rowInfoForm[key] = val[key]
            //         }
            //     }
            // },

            multipleSelection:function(val, oldVal){
               
                this.sumPrice();
            }
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .button_step {
        text-align: left;
    }
</style>
