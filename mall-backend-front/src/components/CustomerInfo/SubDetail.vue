<template>
    <!-- 只有销售经理有权 处理这个页面 -->
    <el-row>
        <el-tabs v-model="activeName" type="border-card">
            <el-tab-pane label="跟踪记录" name="First">
                <el-table :data="TrackLogData" border style="width: 100%">
                    <el-table-column prop="cus_name" label="客户姓名" align="center"></el-table-column>
                    <el-table-column prop="user_name" label="录入人姓名" align="center"></el-table-column>
                    <el-table-column prop="content" label="跟踪内容" align="center"></el-table-column>
                    <el-table-column prop="created_at" label="录入时间" align="center"></el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="投诉记录" name="Second">
                <el-table :data="ComplainData" border style="width: 100%">
                    <el-table-column prop="cus_name" label="客户姓名" align="center"></el-table-column>
                    <el-table-column prop="user_name" label="投诉人姓名" align="center"></el-table-column>
                    <el-table-column prop="type" label="投诉类型" align="center">
                        <template slot-scope="scope">
                            {{ setComplainType(scope.row.type) }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="content" label="投诉内容" align="center"></el-table-column>
                    <el-table-column prop="created_at" label="投诉时间" align="center"></el-table-column>
                </el-table>
            </el-tab-pane>
            <el-tab-pane label="购买记录" name="Third">
                       
                    <el-table :data="BuyData" border style="width: 100%">
                        <el-table-column prop="created_at" label="购买时间" align="center"></el-table-column>
                        <el-table-column prop="goods_name" label="商品名称" align="center"></el-table-column>
                        <el-table-column prop="order.status_text" label="状态" align="center">  </el-table-column>
                        <el-table-column prop="order.auditor_time" label="审核时间" align="center"></el-table-column>
                        <el-table-column prop="created_at" label="发货时间" align="center">
                            <template slot-scope="scope">
                                {{ scope.row.assign ? scope.row.assign.out_entrepot_at : '未发货'}}
                            </template>
                        </el-table-column>
                        <el-table-column prop="created_at" label="签收时间" align="center">
                            <template slot-scope="scope">
                                {{ scope.row.assign ? scope.row.assign.sign_at : '未'}}
                            </template>
                        </el-table-column>
                    </el-table>
            </el-tab-pane>

            <el-tab-pane label="退/换货记录" name="Fourth">
               <el-table :data="AfterData" border style="width: 100%">
                   <el-table-column prop="created_at" label="换货时间" align="center"></el-table-column>
                   <el-table-column prop="goods_name" label="商品名称" align="center"></el-table-column>
                   <el-table-column prop="type_text" label="状态" align="center"></el-table-column>
                   <el-table-column prop="type" label="审核状态" align="center">
                       <template slot-scope="scope">
                           {{ check_status_text(scope.row.after_sale.check_status) }}
                       </template>
                   </el-table-column>
                   <!-- <el-table-column prop="created_at" label="发货时间" align="center"></el-table-column>
                   <el-table-column prop="created_at" label="签收时间" align="center"></el-table-column> -->
               </el-table>
       </el-tab-pane>
        </el-tabs>
    </el-row>
</template>
  
<script>
    import CustomerTrackLogProxy from '@/packages/CustomerTrackLogProxy';
    import CustomerComplainProxy from '@/packages/CustomerComplainProxy';
    import OrderGoodsProxy from '@/packages/OrderGoodsSelectProxy';
    import AfterGoodsProxy from '@/packages/AfterGoodsSelectProxy';

    export default {
        name: 'SubDetail',
        props:{
            row:{
                type: Object,
                default:null
            },
            complainType:{
                type: Object,
                default:null
            }
        },
        data () {
            return {
                activeName:'First',
                TrackLogData:[],
                ComplainData:[],
                BuyData:[],
                AfterData:[],
                tabFirst:false,
                tabSecond:false,
                tabThird:false,
                tabFourth:false
            }
        },
       
        methods:{
            setComplainType(type){
                return this.complainType[type];
            },
            handleFirst(row){
                this.customerTrackLogProxy.setParam({
                    cus_id:row.id,
                    business:'theCus'
                }).load();
                this.tabFirst = true;
            },
            handleSecond(row){
                this.customerComplainProxy.setParam({
                    cus_id:row.id,
                    business:'theCus'
                }).load();
                this.tabSecond = true;
            },
            handleThird(row){
                this.orderGoodsProxy.setParam({
                    cus_id:row.id,
                    load:['order', 'assign']
                }).load();
                this.tabThird = true;
            },
            handleFourth(row){
                this.afterGoodsProxy.setParam({
                    cus_id:row.id,
                    appends:['type_text']
                }).load();
                this.tabFourth = true;
            },
            getTrackLog(data){
                this.TrackLogData = data;
            },
            getComplainLog(data){
                this.ComplainData = data;
            },
            getOrderGoods(data){
                this.BuyData = data.items;
            },
            getAfterGoods(data){
                console.log(data);
                this.AfterData = data.items;
            },
            check_status_text(v){
                let a = ["待审核","通过","不通过"];
                return a[v];
            }
        },
        watch:{
            row(val, oldVal){
                this['handle'+ this.activeName].call(this, this.row);
                this.tabFirst = false;
                this.tabSecond = false;
                this.tabThird = false;
                this.tabFourth = false;
            },
            activeName(val,oldVal){
                if (!this['tab'+ val] && this.row !== null) {
                    this['handle'+ val].call(this, this.row);
                }
            },

        },
        created(){
            this.customerTrackLogProxy = new CustomerTrackLogProxy(null,this.getTrackLog,this);
            this.customerComplainProxy = new CustomerComplainProxy(null,this.getComplainLog,this);
            this.orderGoodsProxy = new OrderGoodsProxy(null, this.getOrderGoods, this);
            this.afterGoodsProxy = new AfterGoodsProxy(null, this.getAfterGoods, this);
            
        }
    }
</script>
<style scoped>

</style>
  