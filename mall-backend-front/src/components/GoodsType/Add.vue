<template>
    <div >
        <MyDialog title="添加" :name="name" :width="width" :height="height">
            <el-form :model="addForm" ref="addForm"  :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="类型名称" prop="name" >
                            <el-input class="name-input" v-model="addForm.name"  auto-complete="off" placeholder="请填写类型名称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-form-item label="属性标签" prop="sepc_ids">
                    <el-checkbox-group v-model="addForm.sepc_ids">
                        <el-checkbox v-for="item in specs" :label="item.id"  :key="item.id">{{ item.name }}</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
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
export default {
    name: 'Add',
    mixins:[DialogForm],
    props:{
        specs:{
            type: Array,
            default:function(){
                return [];
            }
        }
    },
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            state7: this.addOpen,
            addForm:{
                name:"",
                sepc_ids:[],
                
            },

        }
    },
    methods:{
        getAjaxPromise(model){
            //console.log(model);
            return this.ajaxProxy.create(model);
        },
        resetSpec(){
            this.addForm.sepc_ids = [];
        }
    },
    created(){
        this.$on('submit-success', this.resetSpec);
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      