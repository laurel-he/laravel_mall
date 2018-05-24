<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-tabs v-model="activeName" type="border-card">
                    <!--  订单客户信息 -->
                    <el-tab-pane label="订单客户信息" name="First">
                        <el-table :data="usertableData"    border    empty-text="请双击订单显示信息">
                            <el-table-column prop="name" label="客户姓名" align="center">
                            </el-table-column>
        
                            <el-table-column prop="sex_text" label="客户性别" align="center">
                            </el-table-column>
        
                            <el-table-column prop="contact.phone" label="客户电话" align="center">
                            </el-table-column>
        
                            <el-table-column prop="contact.qq" label="客户qq" align="center">
                            </el-table-column>
        
                            <el-table-column prop="contact.qq_nickname" label="qq昵称" width="180" align="center">
                            </el-table-column>
        
                            <el-table-column prop="contact.weixin" label="客户微信" align="center">
                            </el-table-column>
        
                            <el-table-column prop="contact.weixin_nickname" label="微信昵称" align="center">
                            </el-table-column>
        
                        </el-table>
                    </el-tab-pane>
                    <!-- /订单客户信息 -->
                    <!--  订单商品信息 -->
                    <el-tab-pane label="订单商品信息" name="Second">
                        <el-table :data="goodstableData"    border   empty-text="暂无数据">
        
                            <el-table-column prop="goods_name" label="商品名称" align="center">
                            </el-table-column>
                            <el-table-column prop="price" label="商品价格" align="center">
                            </el-table-column>
        
                            <el-table-column prop="goods_number" label="商品数量" width="180" align="center">
                            </el-table-column>
                            <el-table-column prop="remark" label="备注" width="180" align="center">
                            </el-table-column>
        
                        </el-table>
                    </el-tab-pane>
                    <!--  / 订单商品信息 -->
                    <!--  订单收货地址 -->
                    <el-tab-pane label="订单收货地址" name="Third">
                        <el-table :data="addresstableData"   highlight-current-row border  empty-text="请点击客户显示订单收货地址">
                            <el-table-column prop="address" label="收货地址" align="center">
                            </el-table-column>
                            <el-table-column prop="name" label="收货人姓名" align="center">
                            </el-table-column>
                            <el-table-column prop="phone" label="收货人电话" align="center">
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>
                    <!--  / 订单收货地址 -->
                    <!-- 订单操作记录  -->
                    <el-tab-pane label="订单操作记录" name="Fourth">
                        <el-table :data="manageData" empty-text="暂无数据" border style="width: 100%">
                            <!-- <el-table-column prop="order_id" label="订单id" align="center">
                            </el-table-column> -->
                            <el-table-column prop="order_action" label="操作动作" align="center">
                            </el-table-column>
                            <el-table-column prop="manager" label="操作员" align="center">
                            </el-table-column>
                            <el-table-column prop="remark" label="操作备注" align="center">
                            </el-table-column>
                            <el-table-column prop="time" label="操作时间" align="center">
                            </el-table-column>
        
                        </el-table>
                    </el-tab-pane>
                    <!-- /订单操作记录 -->
                    <!-- 订单发货信息 -->
                    <el-tab-pane label="订单发货信息" name="Fifth">
                        <el-table :data="assignData" empty-text="暂无数据" border style="width: 100%">
                            <el-table-column prop="user_name" label="发货人员" align="center">
                            </el-table-column>
                            <el-table-column prop="express_name" label="快递公司" align="center">
                            </el-table-column>
                            <el-table-column prop="express_fee" label="快递费用" align="center">
                            </el-table-column>
                            <el-table-column prop="deliver_name" label="收件人员" align="center">
                            </el-table-column>
                            <el-table-column prop="out_entrepot_at" label="发货时间" align="center">
                            </el-table-column>
                        </el-table>
                    </el-tab-pane>
                    <!-- /订单发货信息 -->
                </el-tabs>
            </el-col>
        </el-row>
    </div>
</template>
  
<script>
    import CustomerSelectAjaxProxy from '@/packages/CustomerSelectProxy';
    import OrderGoodsAjaxProxy from "@/packages/OrderGoodsAjaxProxy";
    import OrderAddressAjaxProxy from "@/packages/OrderAddressAjaxProxy";
    import OrderAssignAjaxProxy from "@/packages/OrderAssignAjaxProxy";
    import OrderOperateAjaxProxy from "@/packages/OrderOperateSelectProxy";

    export default {
        name: 'SubDetail',
        props:{
            row :{
                type: Object,
                default:null
            }
        },
        data () {
            return {
                usertableData: [],
                goodstableData:[],
                addresstableData:[],
                manageData:[],
                assignData:[],
                activeName:'First',
                order_id:0,

                tabFirst:false,
                tabSecond:false,
                tabThird:false,
                tabFourth:false,
                tabFifth:false,
            }
        },
        methods:{
            loadCustomer(data){
                data.items[0].contact = data.items[0].contacts[0];
                this.usertableData = data.items;
            },
            getOrderGoods(data){
                // console.log(data);
                this.goodstableData = data.items;
            },
            getOrderAddress(data){
                // console.log(data);
                this.addresstableData = data.items;
            },
            getOrderAssign(data){
                // console.log(data);
                this.assignData = data.items;
            },
            getOrderOperate(data){
                this.manageData = data.items;
            },
            handleFirst(row){
                this.customerProxy.setParam({
                    fields:['*'],
                    id:row.cus_id,   
                    with:['contacts']
                }).load();
                this.tabFirst = true;
            },
            handleSecond(row){
                // console.log('second');
                this.OrderGoodsProxy.setParam({
                    order_id:row.id,
                }).load();
                this.tabSecond = true;
            },
            handleThird(row){
                // console.log('third');
                this.OrderAddressProxy.setParam({
                    order_id:row.id,
                }).load();
                this.tabThird = true;
            },
            handleFourth(row){
                // console.log("fourth");
                this.orderOperateProxy.setParam({
                    order_id:row.id
                }).load();
                this.tabFourth = true;
            },
            handleFifth(row){
                // console.log('fifth');
                this.OrderAssignProxy.setParam({
                    order_id:row.id,
                }).load();
                this.tabFifth = true;
            },
        },
        watch:{
            row:function(val, oldVal) {

                this['handle'+ this.activeName].call(this, this.row);
                this.tabFirst = false;
                this.tabSecond = false;
                this.tabThird = false;
                this.tabFourth = false;
                this.tabFifth = false;
            },
            activeName:function(val, olvVal){
                // console.log(this.activeName);
                if (!this['tab'+ val] && this.row !== null) {
                    this['handle'+ val].call(this, this.row);
                }
            }

        },

        created(){
            this.customerProxy = new CustomerSelectAjaxProxy({fields:["*"]}, this.loadCustomer, this);
            this.OrderGoodsProxy = new OrderGoodsAjaxProxy({fields:["*"]},    this.getOrderGoods,this);
            this.OrderAddressProxy = new OrderAddressAjaxProxy({fields:["*"]},    this.getOrderAddress,this);
            this.OrderAssignProxy = new OrderAssignAjaxProxy({fields:["*"]},    this.getOrderAssign,this);
            this.orderOperateProxy = new OrderOperateAjaxProxy({fields:['*']}, this.getOrderOperate, this);
        }
    }
</script>
  
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
  