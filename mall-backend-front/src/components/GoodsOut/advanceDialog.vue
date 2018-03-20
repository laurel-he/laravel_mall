<template>
    <div >
        <MyDialog title="高级查询" :name="name" :width="width" :height="height">
            <el-form :model="advanceSearchForm" ref="advanceSearchForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="产品种类" prop="pdt_type">
                            <el-select size="small" placeholder="产品种类" v-model="advanceSearchForm.pdt_type">
                                <el-option value="1" label="化妆品"></el-option>
                                <el-option value="2" label="保健品"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="产品名称" prop="pdt_name">
                            <el-input v-model="advanceSearchForm.pdt_name" size="small" placeholder="产品名称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span='12'>
                        <el-form-item label="销售时间" prop="sale_time">
                            <el-date-picker size="small" v-model="advanceSearchForm.sale_time"
                                            placeholder="销售时间"
                                            @change="saleTimeDateChange"
                                            :editable="false">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="订单审核时间" prop="check_time">
                            <el-date-picker size="small" v-model="advanceSearchForm.check_time"
                                            placeholder="订单审核时间"
                                            @change="checkTimeDateChange"
                                            :editable="false">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <el-button :observer="dialogThis" @click="formSubmit('advanceSearchForm')" type="primary">确 定</el-button>
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
                advanceSearchForm:{
                    pdt_type:'',
                    pdt_name:'',
                    sale_time:'',
                    check_time:'',
                },

            }
        },

        methods:{
            addFormSubmit:function(){
                console.log(this.advanceSearchForm);
                this.state6=false;
            },
            closeDialog:function(){
                this.state6=false;
            },
            checkTimeDateChange(v){
                this.advanceSearchForm.sale_time = v;
            },
            saleTimeDateChange(v){
                this.advanceSearchForm.sale_time = v;
            },
        },
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

