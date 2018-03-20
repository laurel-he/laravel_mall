<template>
    <div >
        <MyDialog title="查看" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form ref="rowInfoForm" :model="rowInfoForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="订单号" prop="id">
                            <el-input v-model="rowInfoForm.id" size="small" :disabled="true"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="总金额" prop="order_all_money">
                            <el-input v-model="rowInfoForm.order_all_money" size="small" :disabled="true"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="商品id" prop="order_pay_money">
                            <el-input v-model="rowInfoForm.goods_id" size="small" :disabled="true"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item label="购买客户"  prop="cus_id">
                            <el-select v-model='rowInfoForm.cus_id' :disabled="true">
                                <el-option v-for="buy in buyer" :label="buy.name"
                                           :value="buy.id" :key="buy.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                </el-row>
                <el-row>
                    <template>
                        <el-table :data="tableData" stripe style="width: 100%">
                            <el-table-column prop="goods_name" label="商品名" width="180"></el-table-column>
                            <el-table-column prop="goods_img" label="图片" width="180">
                                <template slot-scope="scope">
                                    <img :src="scope.row.goods_img" width="50" height="50" alt="">
                                </template>
                            </el-table-column>
                            <el-table-column prop="goods_number" label="商品数量" width="180"></el-table-column>
                            <el-table-column prop="goods_price" label="商品价格" width="180"></el-table-column>
                            <el-table-column prop="remark" label="备注" width="180"></el-table-column>
                            <el-table-column    fixed="right" label="操作" align="center">
                                <template slot-scope="scope">
                                    <el-button type="info" size="small" @click="exchange()">换货</el-button>
                                </template>
                            </el-table-column>
                        </el-table>
                        <div v-show="change">
                            <el-button type="primary" @click="exchange()">换 货</el-button>
                        </div>
                    </template>

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

            <div class="exchange" v-show="show">
                <br>
                <el-table
                        border
                        :data="orderData"
                        style="width: 100%">
                    <el-table-column label="序号" type="index" width="80 px"></el-table-column>
                    <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                    <el-table-column prop="price" label="商品单价"></el-table-column>
                    <el-table-column prop="goods_number" label="商品数量">
                    </el-table-column>
                    <el-table-column prop="moneyNotes" label="小 记"></el-table-column>
                    <el-table-column prop="remark" label="备注"></el-table-column>
                    <el-table-column  label="操作" align="center">
                        <template slot-scope="scope">
                            <el-button size="small" type="danger" @click="deleteAddress(scope.row)">删 除</el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <el-form ref="exchangeForm" :model="exchangeForm">
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="商品类型" prop="dev">
                                <el-cascader
                                        v-model="dev"
                                        :options="CategoryList"
                                        change-on-select
                                        @change="categoryChange"
                                ></el-cascader>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="goods_id" label="商品名称">
                                <el-select v-model="addOrderForm.goods_id" @change="getGoods">
                                    <el-option v-for="v in goods" :value="v.id" :key="v.id" :label="v.goods_name"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="goods_number" label="商品数量">
                                <el-input-number size="small" :min="1" v-model="goods_number" ></el-input-number>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="remark" label="备注">
                                <el-input type="textarea" class="name-input"  v-model="remark"  placeholder="备注" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </el-form>
                <el-button @click="addOrder" type="primary" class="right" >添 加</el-button>
            </div>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="handleSubmit" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import SelectProxy from  '../../packages/SelectProxy';
    import OrdergoodsAjaxProxy from '../../ajaxProxy/Ordergoods';
    import GoodsDetailsAjax from '../../ajaxProxy/GoodsDetails';
    import OrderlistAjax from '../../ajaxProxy/Orderlist';
    import DataProxy from '../../packages/DataProxy';

    import APP_CONST from '../../config';
    //    import SubmitButton from '../../components/common/SubmitButton';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            users:{
                type:Array,
                default:[],
            },
            CategoryList:'',
            buyer:{
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
                show:false,
                change:true,
                OrderlistAjax:OrderlistAjax,
                totalMoney:0,
                currentDate: new Date(),
                order_statuslist: [
                    {id: '0', status: '未付款'},
                    {id: '1', status: '待确认'},
                    {id: '2', status: '已完成'},
                    {id: '3', status: '已关闭'},
                    {id: '4', status: '退款中'},
                ],
                shipping_statuslist: [
                    {id: '0', status: '待发货'},
                    {id: '1', status: '已发货'},
                    {id: '2', status: '已收货'},
                ],
                check_status: [
                    {id: '0', status: '通过'},
                    {id: '1', status: '未通过'},
                    {id: '2', status: '未审核'}
                ],
                dialogThis: this,
                labelPosition: "right",
                labelWidth: '100px',
                cateOptions: '',
                rowInfoForm: {
                    goods_name: '',
                    consignee: '',
                    order_all_money: '',
                    order_pay_money: '',
                    order_status: '',
                    pay_name: '',
                    shipping_status: '',
                    shipping_name: '',
                    order_time: '',
                    goods_id: '',
                },
                addOrderForm:{
                    cus_id:'',
                    deal_id:'',
                    deal_name:'',
                    goods_id:'',
                    address_id:"",
                    order_all_money:0,
                    order_pay_money:0,
                    order_goods:[],
                },
                model: null,
                tableData: [],
                dev:[],
                goods:[],
                remark:'',
                goods_number:'',
                orderData:[],
                goodsIds:[],
                exchangeForm:{
                    cus_id:'',
                    deal_id:'',
                    deal_name:'',
                    goods_id:'',
                    address_id:"",
                    order_all_money:0,
                    order_pay_money:0,
                    order_goods:[],
                    exchange:'',
                },
                updatedata:[],



            }
        },

        methods:{
            addFormSubmit:function(){
                this.state6=false;
            },
            closeDialog:function(){
                this.state6=false;
            },
            handleSubmit(){
                this.exchangeForm.id=this.rowInfoForm.id;
                this.exchangeForm.order_goods = this.orderData;
                this.exchangeForm.order_all_money = this.totalMoney;
                this.exchangeForm.order_pay_money = this.totalMoney;
                this.exchangeForm.goods_id = this.rowInfoForm.goods_id;
                this.exchangeForm.exchange_id = this.goodsIds.join(',');
                this.exchangeForm.exchange_check = '0';
                this.exchangeForm.check_status = '0';
                this.exchangeForm.order_status = '5';
                this.exchangeForm.order_goods = this.orderData;
                this.exchangeForm.exchange = 1;
                this.formSubmit('exchangeForm');
            },
            formSubmit(name){
                let model = this[name];
                this.updatedata = model;
                if (this.$refs[name].rules) {
                    this.$refs[name].validate((valid)=>{
                        if (valid) {
                            this.realSubmit(model, name);
                        } else {
                            console.log('error submit!!', name);
                            this.$emit('valid-error', name);
                            return false;
                        }
                    })
                } else {
                    this.realSubmit(model, name);
                }
            },
            realSubmit(model, name){
                let ordergoodsPromise = this.getordergoodsPromise(model);
                let ajaxPromise =  this.getAjaxPromise(model);
                let vmthis = this;
                ordergoodsPromise.then(function(response){
                     vmthis.$emit('submit-success', name);
                    vmthis.$emit('submit-final', name);
                });
                ajaxPromise.then(function(response){
                    vmthis.$message.success('操作成功');
//                    vmthis.$refs[name].resetFields();
                    vmthis.addressList=[];
                    vmthis.orderData=[];
                    vmthis.goodsIds=[];
                    vmthis.addressID='';
                    vmthis.totalMoney=0;
                    vmthis.active=0;
//                    vmthis.$refs[name].resetFields();
                    vmthis.$emit('submit-success', name);
                })
                    .catch(function(error){
                        if(error.response){
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        }else{
                            console.log('Error',error.message);
                        }
                        vmthis.$message.error('出错了');
                    })
                    .then(function(){
                        vmthis.$emit('submit-final', name);
                    });

            },
            addOrder(){

                var j;
                for(j = 0; j < this.goodsInfoData.length; j++) {
                    if(this.goodsInfoData[j]['id']==this.goods_id)
                    {
                        let moneyNotes =parseInt(this.goodsInfoData[j].goods_price) * parseInt(this.goods_number);
                        let addData ={
                            goods_id:this.goods_id,
                            goods_name:this.goodsInfoData[j].goods_name,
                            price:this.goodsInfoData[j].goods_price,
                            goods_number:this.goods_number,
                            remark:this.remark,
                            moneyNotes:moneyNotes,
                            exchange_status:2,
                        };
                        this.totalMoney += moneyNotes;
                        this.orderData.push(addData);
                        this.goodsIds.push(this.goods_id);
//                        this.$refs.addOrderForm.resetFields();
                        this.dev=[];
                        this.remark='';
                        this.goods_number='';
                    }
                }


            },
            onOpen(event){
                this.tableData.splice(0,this.tableData.length);
                this.rowInfoForm = event.params.rowData;
                this.getGoodsDetail();
            },
            categoryChange(cate_id){
                let orderDataProxy = new DataProxy(GoodsDetailsAjax.getUrl(),this.pageSize,this.getOrderData, this);
                this.orderDataProxy = orderDataProxy;
                let cates = {cate_id:cate_id};
                this.orderDataProxy.setExtraParam(cates);
                this.orderDataProxy.load();
            },
            exchange(){
                this.show=true;
                this.change=false;
//                document.getElementsByClassName("exchange").style.display="block";
//                $('.exchange').css('display','block');
            },
            getOrderData(data) {
                this.goods=data.items;
                this.goodsInfoData=data.items;
            },
            deleteAddress(row){
                let index = this.orderData.indexOf(row);
                let goods_id = this.goodsIds.indexOf(row.goods_id);
                let vmThis = this;
                if( index > -1){
                    this.$confirm('确定删除?', '警告',{
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(()=>{
                        this.orderData.splice(index,1);
                        this.goodsIds.splice(goods_id,1);
                        this.totalMoney -= row.moneyNotes;
                        vmThis.$message.success("操作成功");
                    });
                }
            },
            getAjaxPromise(model){
                let data = model;
                delete model.cus_name;
                delete model.buyer;
                delete model.user_name;
                delete model.users;
                let update = model;
//                delete update.exchange;
//                delete update.order_goods;
               return this.ajaxProxy.update(update.id, update);
            },
            getordergoodsPromise(model){
               return this.ajaxProxy.create(model);
            },
            DateChange:function(v){
                this.rowInfoForm.order_time = v;
            },
            initGoodsDetail(data){
                this.cateOptions = data.items;
                this.getGoodsInfo(this.rowInfoForm.goods_id);
            },
            getGoodsDetail(){
                let selectProxy = new SelectProxy(OrdergoodsAjaxProxy.getUrl(),this.initGoodsDetail,this);
                selectProxy.load();
            },
            getGoods(goods_id){
                this.goods_id=goods_id;
            },
            getGoodsInfo(ids){
                var id;
                id = ids.split(',');
                var i = 0,j=0;
                while (i<id.length)
                {
                    for(j=0;j<this.cateOptions.length;j++)
                    {
                        if(this.cateOptions[j].goods_id==id[i]&&this.cateOptions[j].order_id==this.rowInfoForm.id)
                        {
                            let addData ={
                                id:this.cateOptions[j].id,
                                goods_name:this.cateOptions[j].goods_name,
                                goods_number:this.cateOptions[j].goods_number,
                                goods_price:this.cateOptions[j].price,
                                goods_img:this.cateOptions[j].cover_url,
                                remark:this.cateOptions[j].remark,
                            };
                            this.tableData.push(addData);

                        }
                    }

                    i++;
                }
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
    .time {
        font-size: 13px;
        color: #999;
    }

    .bottom {
        margin-top: 13px;
        line-height: 12px;
    }

    .button {
        padding: 0;
        float: right;
    }

    .image {
        width: 100%;
        display: block;
    }

    .clearfix:before,
    .clearfix:after {
        display: table;
        content: "";
    }

    .clearfix:after {
        clear: both
    }
</style>

