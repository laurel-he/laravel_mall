<template>
    <MyDialog title="商品出库-订单(测试数据)" :name="name" :width="width" :height="height" @before-open="onOpen">
        <el-form>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="销售人员">
                        于    
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="订单审核人员">
                        于    
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="12">
                    <el-form-item label="销售时间">
                        2018-01-02     
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="审核时间">
                        2018-01-02  12:00:00      
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col>
                    <el-form-item label="选择的物流">
                        顺风 快递号：212123123
                    </el-form-item>   
                </el-col>
            </el-row>
        </el-form>  
        <!-- 出库人 -->
        <div slot="dialog-foot" class="dialog-footer">
            <el-button @click="handleClose">关闭</el-button> 
        </div>
    </MyDialog>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import InventorySelectProxy from '../../packages/InventorySelectProxy';
    import OrderSelectProxy from '../../packages/OrderlistSelectProxy';

    export default {
        name:'order',
        mixins:[DialogForm],
        data(){
            return{

                outForm:{
    
                },
                
                order_sn:''

            }
        },
        methods:{
            loadOrder(data){
                this.orderinfo = data.items[0];
            },
            onOpen(param){
                this.order_sn = param.params.order_sn;
            }
        },
        watch:{
            order_sn:function(val, oldVal){
                this.orderSelect.setParam({order_sn:val});
                this.orderSelect.load();
            }
        },
        created(){
            let orderSelect = new OrderSelectProxy({order_sn:this.order_sn}, this.loadOrder, this);
            this.orderSelect = orderSelect;
            this.orderSelect.load();
        }
    }
</script>

<style>
</style>