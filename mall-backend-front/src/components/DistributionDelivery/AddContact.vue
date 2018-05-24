<template>
    <div>
        <MyDialog title="沟 通" :name="name" :width="width" :height="height"  @before-open="onBeforeOpen">
            <el-form :model="addForm" ref="addForm" :label-width="labelWidth"  :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户姓名" prop="cus_name" >
                            {{ model.cus_name}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="客户联系方式" prop="deliver_phone">
                            {{ model.deliver_phone}}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="购买商品类型" prop="category" >
                            {{ model.category}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="数量" prop="goods_num">
                            {{ model.goods_num}}
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="12">
                        <el-form-item label="沟通时间" prop="communicate_time">
                            <el-date-picker
                                    v-model="addForm.communicate_time"
                                    type="datetime"
                                    @change="timeChange"
                                    placeholder="选择日期时间">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="沟通明细" prop="contact_content">
                            <el-input v-model="addForm.contact_content" type="textarea" placeholder="沟通明细"></el-input>
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
        </MyDialog>
    </div>
</template>
<script>
import DialogForm from '../../mix/DialogForm';
import APP_CONST from '../../config';
import { mapGetters, mapMutations } from 'vuex';
export default {
    name: 'add-delivery',
    mixins:[DialogForm],
    computed:{
        ...mapGetters([
            'getUser',
            'departName',
            'getUserRoles'
        ])
    },
    components: {
        
    },
    props:{

    },
    data(){
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'120px',
            addForm:{
                contact_content:'',
                communicate_time:'',
                cus_name:'',
                user_id:'',
                user_name:'',
                assign_id:''
            },
            model:{}
        }
    },
    methods:{
        getAjaxPromise(model){
            this.addForm.assign_id = this.model.id;
            this.addForm.cus_name = this.model.cus_name;
            this.addForm.user_id = this.getUser.id;
            this.addForm.user_name = this.getUser.realname;
            return this.ajaxProxy.update(model.id, model);
        },
        timeChange(v){
           this.addForm.communicate_time=v;
        },

        onBeforeOpen(model) {
            this.model =  model.params;
        }
    },
    // watch:{
    //     model:function(val, oldVal){
    //         this.initObject(val, this.addForm);
    //     }
    // },
    mounted(){

    },
    created(){

    }

}
</script>
<style scoped>

</style>
