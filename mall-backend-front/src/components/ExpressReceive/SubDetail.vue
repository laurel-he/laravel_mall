<template>
    <div>
        <el-row>
            <el-col :span="24">
                    <el-tabs type="border-card">
                        <el-tab-pane label="客户信息">
                            <el-table :data="tableData" border >
                                <el-table-column  prop="deliver_name"  label="收件人姓名"  width="180"></el-table-column>
                                <el-table-column  prop="deliver_phone"  label="收件人手机"  width="180"></el-table-column>
                                <el-table-column  prop="deliver_address"  label="地址"> </el-table-column>
                            </el-table>
                        </el-tab-pane>
                        <el-tab-pane label="商品信息">
                            <el-table :data="tableData" border >
                                <el-table-column  prop="goods_name"  label="名称"  width="180"></el-table-column>
                                <el-table-column  prop="sku_sn"  label="编号"  width="180"></el-table-column>
                                <el-table-column  prop="goods_num"  label="数量"> </el-table-column>
                            </el-table>
                        </el-tab-pane>
                        <el-tab-pane label="销售信息">
                            <el-table :data="orderRow" border >
                                <el-table-column  prop="dep_group_realname"  label="部门-小组-员工"  width="180"></el-table-column>  
                            </el-table>
                        </el-tab-pane>
                        <el-tab-pane label="发货物流">
                            <el-table :data="tableData" border >
                                <el-table-column  prop="user_name"  label="发货人"  width="180"></el-table-column>
                                <el-table-column  prop="out_entrepot_at"  label="发货时间"  width="180"></el-table-column>
                                <el-table-column  prop="assign_fee"  label="配送费"  width="180"></el-table-column>
                                <el-table-column  prop="express_fee"  label="快递费"  width="180"></el-table-column>
                            </el-table>
                        </el-tab-pane>
                    </el-tabs>
            </el-col>    
        </el-row>
    </div>
</template>

<script>

import AssignSelectProxy from "@/packages/AssignSelectProxy";
import OrderListSelectProxy from "@/packages/OrderSelectProxy";

export default {
    name: 'SubDetail',
    props:{
        row:{
            type:Object,
            default:null
        }
    },
    data () {
        return {
        
            tableData:[],
            express_sn:"",
            order_id:"",
            orderRow:[]
        }
    },
    methods:{
        setAssign(express_sn){
            this.assignProxy.setParam({'express_sn': express_sn}).load()
        },
        setOrder(order_id){
            this.OrderListProxy.setParam({id:order_id, fields:['dep_group_realname','group_id','department_id']}).load();
        },
        loadAssign(data){
            this.tableData = data.items;
            this.order_id = this.tableData[0].order_id;
        },
        loadOrder(data){
            this.orderRow = data.items;
        }
    },
    watch:{
        row(val, oldVal){
            this.express_sn = val.express_sn; 
        },
        express_sn(val, oldVal){
            this.setAssign(val);
        },
        order_id(val, oldVal){
       
            this.setOrder(val);
        }
    },
    created(){
        this.assignProxy = new AssignSelectProxy({}, this.loadAssign, this);
        this.OrderListProxy = new OrderListSelectProxy({}, this.loadOrder, this);
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
  