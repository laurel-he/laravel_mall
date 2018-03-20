<template>
    <MyDialog title="商品出库" :name="name" :width="width" :height="height">
        <el-form :model="outForm" :inline="true" class="demo-form-inline" ref="outForm">
            <el-row>
                <el-col :span="12">
                    <el-form-item label="商品类型">
                        <el-select clearable v-model="outForm.goods_type" placeholder="请选择商品类型"  @change="onTypeChange">
                            <el-option v-for="type in goodsType" :label="type.name" :value="type.name" :key="type.id"></el-option>
                        </el-select>
                    </el-form-item>
                    
                </el-col>
                <el-col :span="12">
                    <el-form-item label="商品名称">
                       
                        <el-select v-model="outForm.ventory_id" >
                            <el-option v-for="goods in goodsList" :value="goods.id" :key="goods.id" :label="goods.goods_name">
                                {{ goods.goods_name }} - {{ goods.goods_version }} - {{ goods.goods_batch }}
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="12">
                    <el-form-item label="商品数量">
                        <el-input-number v-model="outForm.goods_sum" :min="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="出库时间">
                        <el-date-picker
                                v-model="outForm.create_time"
                                type="date"
                                format="yyyy-MM-dd"
                                @change="getTime"
                                placeholder="选择日期时间">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="12">
                    <el-form-item label="出库人">
                        <el-select v-model="outForm.user_id" placeholder="请选择出库人">
                                <el-option v-for="user in users" :label="user.realname" :value="user.id" :key="user.id"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="订单编号">
                        <el-select
                            clearable
                            filterable
                            remote
                            :remote-method="remoteMethod"
                            :loading="loading"
                            v-model="outForm.order_sn">
                            <el-option v-for="order in order_sns" :value="order.order_sn" :label="order.order_sn" :key="order.id"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>


        </el-form>
        <div slot="dialog-foot" class="dialog-footer">
            <el-button @click="handleClose">取 消</el-button>
            <!-- <el-button :observer="dialogThis" @click="addStorage" type="primary">确 定</el-button> -->
            <submit-button
                    :observer="dialogThis"
                    @click="formSubmit('outForm')" >
                    确 定
                </submit-button>
        </div>
    </MyDialog>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import InventorySelectProxy from '../../packages/InventorySelectProxy';
    import OrderSelectProxy from '../../packages/OrderSelectProxy';

    export default {
        name:'outStorage',
        mixins:[DialogForm],
        props:{
            goodsType:{
                type: Array,
                default:[]
            },
            users:{
                type:Array,
                default:function(){
                    return [];
                }
            }
        },
        data(){
            return{
                loading:false,
                dialogThis:this,
                outForm:{

                    type:"2",
                    goods_type:'',
                    goods_name:"",
                    goods_sum:"",
                    ventory_id:"",
                    user_id:"",
                    order_sn:"",
                    create_time:"",
                    
                },
                

                goodsList:[],
                order_sns:[]
            }
        },
        methods:{
            getTime:function (val) {
                this.outForm.create_time = val
            },
            loadInventory(data){
                this.goodsList = data.items;
            },
            onTypeChange(v){
                this.inventorySelect.setParam({id:v});
                this.inventorySelect.load();
            },
            remoteMethod(query){
                if (query !== '') {
                    this.loading = true;
                    this.orderSelect.setParam({sn:query});

                    let p = this.orderSelect.load();
                    p.then(()=>{
                        this.loading = false;
                    })
                }
            },
            loadOrder(data){
                this.order_sns = data.items;
            },
            getAjaxPromise (model){
                return this.ajaxProxy.create(model);
            }
        },
       
        created(){
            let inventorySelect =  new InventorySelectProxy({}, this.loadInventory, this);
            this.inventorySelect = inventorySelect;
            // this.inventorySelect.load();

            let orderSelect = new OrderSelectProxy({}, this.loadOrder, this);
            this.orderSelect = orderSelect;
        }
    }
</script>

<style>
</style>