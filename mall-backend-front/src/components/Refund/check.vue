<template>
    <div >
        <MyDialog title="退款审核" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="checkForm" ref="checkForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="是否通过" prop="check_status">
                            <el-select size="small" placeholder="是否通过" v-model="checkForm.check_status">
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
                        <el-form-item  label="备注"　>
                            <el-input type="textarea"　:rows="2" v-model="checkForm.check_remark"></el-input>
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
    export default {
        name: 'checkDialog',
        mixins:[DialogForm],
        props:{
            
        },
        ajaxProxy:{
            required:true,
            type: Object,
            default: null
        },
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
                    {id:　1, status:'通过'},
                    {id:2, status:'未通过'}
                ],

            }
        },

        methods:{
            
            
            onOpen(param){

                if (param.params.row.check_status != 0) {
                    this.$alert("已经审核,不能再次审核", "警告", {
                        confirmButtonText: '确定',
                        callback: action=>{
                            this.handleClose();
                        }
                    });
                    
                    return false;
                }

            //   console.log(param);
                this.checkForm.id = param.params.row.id;
                this.checkForm.check_status = param.params.row.check_status;
                this.checkForm.check_remark = param.params.row.check_remark;


            },
            getAjaxPromise(model){
                 
                return this.ajaxProxy.update(model.id, model);
            },
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

