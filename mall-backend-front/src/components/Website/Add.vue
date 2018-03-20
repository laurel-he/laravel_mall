<template>
    <div >
        <MyDialog title="添加联系人" :name="name" :width="width" :height="height">
            <el-form :model="addForm"  ref="addForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">

                <el-row>
                    <el-col :span="12">
                        <el-form-item label="具体网址" prop="webUrl" >
                            <el-input class="name-input" size="small" placeholder="具体网址" v-model.number="addForm.webUrl"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="网址描述" prop="describe" >
                            <el-input type="textarea"  size="small" placeholder="网址描述" v-model.number="addForm.describe"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注" prop="remark" >
                            <el-input type="textarea" size="small" placeholder="备注" v-model.number="addForm.remark"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        @click="formSubmit('addForm')"
                        :observer="dialogThis">
                    保 存
                </submit-button>
            </div>

        </MyDialog>    </div>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
import DataProxy from '../../packages/DataProxy';
import { mapGetters, mapMutations } from 'vuex';

export default {
    name: 'Add',
    mixins:[DialogForm],
    computed:{
        ...mapGetters([
            'getUser'
        ])
    },
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
            addForm:{
                webUrl:"",
                describe:"",
                remark:"",
            },
            rules:{
                title:[
                    { required: true, message: '请输入公告标题', trigger: 'change'},
                ],
                type_id:[
                    { required: true, message: '请选择公告类型', trigger: 'blur'},
                ],
                content:[
                    {required: true, message: '请输入公告内容', trigger: 'blur'},
                ],
            },
        }
    },
    methods:{
        getAjaxPromise(model){
            model['user_id'] = this.getUser.id;
            return this.ajaxProxy.create(model);
        },
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
      