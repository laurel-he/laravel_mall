<template>
    <div >
        <MyDialog title="出库资料填写" :name="name" :width="width" :height="height">
            <el-form :model="goodsOutForm" ref="goodsOutForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="出库日期" prop="out_time">
                            <el-date-picker v-model="goodsOutForm.datetime" type="datetime" placeholder="选择日期时间" 
                                @change="outTimeDateChange" :editable="false">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item  label="种类" prop="pdt_type">
                          <el-select size="small" placeholder="产品种类" v-model="goodsOutForm.pdt_type">
                              <el-option value="1" label="化妆品"></el-option>
                              <el-option value="2" label="保健品"></el-option>
                          </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="产品名称" prop="pdt_name">
                            <el-input v-model="goodsOutForm.pdt_name" size="small" placeholder="产品名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="数量" prop="goods_num">
                            <el-input-number v-model="goodsOutForm.goods_num" @change="goodsNumChange" :min="1" :max="1000">
                            </el-input-number>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="销售人员" prop="sale_name">
                            <el-select  size="small" clearable v-model="goodsOutForm.sale_name">
                                <el-option label="张三" value="1"></el-option>
                                <el-option label="李四" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item  label="销售日期" prop="sale_time">
                          <el-date-picker v-model="goodsOutForm.sale_time" type="datetime" placeholder="选择日期时间" 
                               @change="saleTimeDateChange" :editable="false">
                          </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="订单审核员" prop="check_name">
                            <el-select  size="small" clearable v-model="goodsOutForm.check_name">
                                <el-option label="特朗普" value="1"></el-option>
                                <el-option label="普京" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item  label="审核日期" prop="check_time">
                          <el-date-picker v-model="goodsOutForm.check_time" type="datetime" placeholder="选择日期时间" 
                               @change="checkTimeDateChange" :editable="false">
                          </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item  label="出库人" prop="out_name">
                          <el-select size="small" placeholder="出库人" v-model="goodsOutForm.out_name">
                              <el-option value="1" label="魑"></el-option>
                              <el-option value="2" label="魅"></el-option>
                              <el-option value="3" label="魍"></el-option>
                          </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item  label="选择物流" prop="express">
                          <el-select size="small" placeholder="选择物流" v-model="goodsOutForm.express">
                              <el-option value="1" label="申通"></el-option>
                              <el-option value="2" label="顺丰"></el-option>
                              <el-option value="3" label="韵达"></el-option>
                          </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item  label="批次" prop="batch_no">
                          <el-select size="small" placeholder="批次" v-model="goodsOutForm.batch_no">
                              <el-option value="1" label="20171215"></el-option>
                              <el-option value="2" label="20171216"></el-option>
                              <el-option value="3" label="20171217"></el-option>
                          </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item  label="快递单号" prop="express_num">
                          <el-input v-model="goodsOutForm.express_num" size="small" placeholder="快递单号"></el-input>  
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <el-button :observer="dialogThis" @click="formSubmit('goodsOutForm')" type="primary">确 定</el-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'100px',
                goodsOutForm:{
                    datetime:'',
                    pdt_type:'',
                    pdt_name:'',
                    goods_num:'',
                    sale_name:'',
                    sale_time:'',
                    check_name:'',
                    check_time:'',
                    express:'',
                    out_name:'',
                    batch_no:'',
                    express_num:'',
                },

            }
        },

        methods:{
            outformSubmit:function(){
                console.log(this.goodsOutForm);
                this.status=false;
            },
            closeDialog:function(){
                this.status=false;
            },
            outTimeDateChange(v){
                this.goodsOutForm.out_time = v;
            },
            goodsNumChange(v){
                this.goodsOutForm.goods_num = v;
            },
            saleTimeDateChange(v){
                this.goodsOutForm.sale_time = v;
            },
            checkTimeDateChange(v){
                this.goodsOutForm.check_time = v;
            }
        },
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

