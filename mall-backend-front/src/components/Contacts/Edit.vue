<template>
    <div >
        <MyDialog title="编辑联系人" :name="name" :width="width" :height="height"  @before-open="onOpen">
            <el-form :model="editForm"  ref="editForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">

                <el-row>
                    <el-col :span="12">
                        <el-form-item label="姓名" prop="name" >
                            <el-input class="name-input" size="small" placeholder="联系人姓名" v-model.number="editForm.name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="关系" prop="relationship_id" >
                            <el-select v-model="editForm.relationship_id" placeholder="请选择与本人关系">
                                <el-option v-for="v in relationshipList" :label="v.name" :value="v.id" :key="v.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="QQ" prop="qq" >
                            <el-input class="name-input" size="small" placeholder="联系人QQ" v-model.number="editForm.qq"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="微信号" prop="weixin" >
                            <el-input class="name-input" size="small" placeholder="联系人微信" v-model.number="editForm.weixin"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="手机号" prop="phone" >
                            <el-input class="name-input" size="small" placeholder="联系人手机" v-model.number="editForm.phone"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        @click="formSubmit('editForm')"
                        :observer="dialogThis">
                    保 存
                </submit-button>
            </div>

        </MyDialog>    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import DataProxy from '../../packages/DataProxy';
    export default {
        name: 'edit',
        mixins:[DialogForm],
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                relationshipList :[
                    {id:'1',name:'父子(女)'},
                    {id:'2',name:'母子(女)'},
                    {id:'3',name:'兄弟(姐妹)'},
                    {id:'4',name:'朋友'},
                    {id:'5',name:'其他'},
                ],
                editForm:{
                    id:'',
                    user_id:'',
                    name:"",
                    relationship_id:"",
                    qq:"",
                    phone:"",
                    weixin:"",
                },
                rules:{
                    title:[
                        { required: true, message: '请输入公告标题', trigger: 'change'},
                    ],
                    type_id:[
                        { required: true, message: '请选择公告类型', trigger: 'blur',type: 'number',},
                    ],
                    content:[
                        {required: true, message: '请输入公告内容', trigger: 'blur'},
                    ],
                },
                model:''
            }
        },
        methods:{
            onOpen(param){
                this.model = param.params.model;
            },
            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id, model);
            },

        },
        watch:{

            model:function(val, oldVal){
                for (const key in this.editForm) {
                    if (this.editForm.hasOwnProperty(key)) {
                        this.editForm[key] = val[key]
                    }
                }
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
      