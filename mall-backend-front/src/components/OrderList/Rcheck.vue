<template>
    <div >
        <MyDialog title="退/换货审核" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="checkForm" ref="checkForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="是否通过" prop="check_status">
                            <el-select size="small" placeholder="是否通过" v-model="checkForm.check_status">
                                <el-option :value="0" hidden> 请选择</el-option>
                                <el-option
                                        v-for="check in c_status"
                                        :label="check.status"
                                        :value="check.id"
                                        :key="check.id"></el-option>
                          </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="备注">
                            <el-input type="textarea" :rows="2" v-model="checkForm.check_remark"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="formSubmit('checkForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import AfterSaleAjaxProxy from '@/ajaxProxy/AfterSale';
    export default {
        name: 'checkDialog',
        mixins:[DialogForm],

        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'100px',
                checkForm:{
                    id:"",
                    check_status:"",
                    check_remark:""
                },
               
                c_status:[
                    {id:1, status:'通过'},
                    {id:2, status:'未通过'}
                ],
                afterRow:null

            }
        },

        methods:{
            
            
            onOpen(param){
                let after_sale_status = param.params.row.after_sale_status;
                // console.log(after_sale_status); // 10 20
                if (!(after_sale_status == 10 || after_sale_status ==20)) {
                    this.$alert("已经审核,不能再次审核", "警告", {
                        confirmButtonText: '确定',
                        callback: action=>{
                            this.handleClose();
                        }
                    });
                    
                    return false;
                } 
                let type = after_sale_status == 10 ? 0 : 1; 
                AfterSaleAjaxProxy.get({order_id:param.params.row.id, type:type}).then((response)=>{
                    this.afterRow = response.data.items[0];
                    this.checkForm.id = this.afterRow.id;
                    this.checkForm.check_status = this.afterRow.check_status;
                    this.checkForm.check_remark = this.afterRow.check_remark;

                })


            //   console.log(param);
                // this.checkForm.id = param.params.row.id;
                // this.checkForm.check_status = param.params.row.check_status;
                // this.checkForm.check_remark = param.params.row.check_remark;


            },
            getAjaxPromise(model){
                 
                return AfterSaleAjaxProxy.update(model.id, model);
            },
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

