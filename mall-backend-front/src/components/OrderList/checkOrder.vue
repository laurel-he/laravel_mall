<template>
    <div >
        <MyDialog title="审核" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="checkForm" ref="checkForm" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item  label="是否通过" prop="status">
                            <el-select size="small" placeholder="是否通过" v-model="checkForm.status">
                                <el-option
                                    v-for="check in c_status"
                                    :label="check.status"
                                    :value="check.id"
                                    :key="check.id">
                                </el-option>
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
    import { mapGetters } from 'vuex';
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
                    status:'',

                },
                
                c_status:[
                    {id:'1', status:'通过'},
                    {id:'6', status:'未通过'}
                ],

            }
        },
        computed:{
            ...mapGetters({
                'auditor_id':'user_id',
                'auditor_name':'realname'
            })
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
            onOpen(param){
                console.log(param);
                this.checkForm.id = param.params.row.id;
                // this.checkForm.status = event.params.row.status;
            },
            getAjaxPromise(model){
                delete model.cus_name;
                delete model.user_name;
                return this.ajaxProxy.updateCheckStatus(model.id, model);
            },
        },
        created(){
            //需要检测 reset 会不会 把下面的置空
            this.checkForm.auditor_id = this.user_id;
            this.checkForm.auditor_name = this.realname;
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

