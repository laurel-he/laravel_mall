<template>
    <div >
        <MyDialog title="编辑" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm" ref="editForm"  :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="类型名称" prop="name" >
                            <el-input class="name-input" v-model="editForm.name"  auto-complete="off" placeholder="请填写类型名称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-form-item label="属性标签" prop="sepc_ids">
                    <el-checkbox-group v-model="editForm.sepc_ids">
                        <el-checkbox v-for="item in specs" :label="item.id"  :key="item.id">{{ item.name }}</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
            </el-form>
    
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button 
                    @click="formSubmit('editForm')"
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
    name: 'Edit',
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

            editForm:{
                id:'',
                name:"",
                sepc_ids:[],
                specs:[],
            },
            model:null,
        }
    },
    methods:{
      onOpen(param){
        this.editForm.id = param.params.model.id;
        this.editForm.name = param.params.model.name;
        for (let i = 0; i < param.params.model.specs.length; i++) {
            this.editForm.sepc_ids.push(param.params.model.specs[i].id);
        }
        console.log(this.editForm);
      },
      getAjaxPromise(model){
          return this.ajaxProxy.update(model.id, model);
      },
    },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      