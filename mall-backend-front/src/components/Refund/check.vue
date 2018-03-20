<template>
    <div >
        <MyDialog title="退款审核" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="checkForm" ref="checkForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="是否通过">
                            <el-select size="small" placeholder="是否通过" v-model="checkForm.refund_check">
                                <el-option
                                        v-for="check in c_status"
                                        :label="check.status"
                                        :value="check.id"
                                        :key="check.id"></el-option>
                          </el-select>
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
                },
                order_statuslist:[
                    {id:'0',status:'未付款'},
                    {id:'1',status:'待确认'},
                    {id:'2',status:'已完成'},
                    {id:'3',status:'已关闭'},
                    {id:'4',status:'退款中'},
                ],
                shipping_statuslist:[
                    {id:'0',status:'待发货'},
                    {id:'1',status:'已发货'},
                    {id:'2',status:'已收货'},
                ],
                c_status:[
                    {id:'1', status:'通过'},
                    {id:'2', status:'未通过'}
                ],

            }
        },

        methods:{
            addFormSubmit:function(){
                console.log(this.checkForm);
                this.state6=false;
            },
            closeDialog:function(){
                this.state6=false;
            },
            pdtTimeDateChange(v){
                this.checkForm.pdt_time = v;
            },
            intoTimeDateChange(v){
                this.checkForm.into_time = v;
            },
            onOpen(event){
              this.checkForm = event.params.row;
            },
            getAjaxPromise(model){
                delete model.cus_name;
                delete model.user_name;
                return this.ajaxProxy.update(model.id, model);
            },
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

