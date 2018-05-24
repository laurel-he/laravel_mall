<template>
    <div >
        <MyDialog title="货架状态" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="shelves_status"  label="货架状态">
                            <el-select
                                    v-model="addForm.shelves_status"
                                    placeholder="货架状态">
                                <el-option v-for="v in status" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="修改人" prop="change_user" >
                            <el-input class="name-input" v-model="addForm.change_user"  auto-complete="off" placeholder="请填写商品名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="修改时间" prop="change_time" >
                            <el-date-picker
                                    v-model="change_time"
                                    type="datetime"
                                    size="small"
                                    @change='timeChange'
                                    placeholder="选择日期时间">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="change_remark">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.change_remark" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="beforeFormSubmit('addForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        // props:{
        //
        // },
        // components:{
        //     Dialog
        // },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                computedusers:[],
                status: [
                    {id:1,name:'满'},
                    {id:0,name:'空'},
                    {id:2,name:'坏'},
                ],
                addForm:{
                    id:'',
                    shelves_status: "",
                    change_user: "",
                    change_time: "",
                    change_remark:''
                },
                model:'',
                change_time:'',
                rules:{
                    name:[
                        { required: true, message: '请输入小组名称', trigger: 'blur' }
                    ],  
                    department_id:[
                        { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                    ],
                    remarks:[
                        { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
              ]
                }
            }
        },
        computed:{

        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id,model);
            },
            onBeforeOpen(model) {
                this.model =  model.params.model;
            },
            timeChange(v) {
                this.addForm.change_time=v;
            },
            beforeFormSubmit(name) {
                this.formSubmit(name);
                let data ={shelves_id:this.model.id};
                let that = this;
                this.ajaxProxy.get(data).then(function(response){
                    that.$emit('add-submit',response.data)
                })
            },
        },
        watch:{
            model:function(val, oldVal){
                this.initObject(val, this.addForm);
            }
        },
        created(){


        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

