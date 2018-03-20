<template>
    <div >
        <MyDialog title="入库资料填写" :name="name" :width="width" :height="height">
            <el-form :model="goodsOutForm" ref="goodsOutForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="入库日期" prop="into_time">
                            <el-date-picker v-model="goodsOutForm.into_time" type="datetime" placeholder="选择日期时间" 
                                @change="intoTimeDateChange" :editable="false">
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
                        <el-form-item label="入库人员" prop="sale_name">
                            <el-select  size="small" clearable v-model="goodsOutForm.into_name">
                                <el-option label="张三" value="1"></el-option>
                                <el-option label="李四" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span='12'>
                        <el-form-item  label="有效期" prop="expiry_date">
                          <el-date-picker v-model="goodsOutForm.expiry_date" type="datetime" placeholder="选择有效期" 
                               @change="expiryDateDateChange" :editable="false">
                          </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item  label="生产日期" prop="pdt_time">
                          <el-date-picker v-model="goodsOutForm.pdt_time" type="datetime" placeholder="选择有效期" 
                               @change="pdtTimeDateChange" :editable="false">
                          </el-date-picker>
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
                        <el-form-item  label="价格" prop="pdt_price">
                          <el-input v-model="goodsOutForm.pdt_price" size="small" placeholder="价格"></el-input>  
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
                    into_time:'',
                    pdt_type:'',
                    pdt_name:'',
                    goods_num:'',
                    sale_name:'',
                    expiry_date:'',
                    pdt_time:'',
                    batch_no:'',
                    pdt_price:'',
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
            expiryDateDateChangeDateChange(v){
                this.goodsOutForm.expiry_date = v;
            },
            checkTimeDateChange(v){
                this.goodsOutForm.check_time = v;
            },
            pdtTimeDateChange(v){
                this.goodsOutForm.pdt_time = v;
            }
        },
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

