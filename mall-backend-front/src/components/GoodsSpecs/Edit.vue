<template>
    <div >
        <MyDialog title="编辑" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm" ref="editForm"  :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="规格名称" prop="name" >
                            <el-input class="name-input" v-model="editForm.name"  auto-complete="off" placeholder="请填写规格名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="展示方式" prop="type">
                            <el-radio-group v-model="editForm.type">
                                <el-radio v-for="(item,index) in showTypes" :key="index" :label="index">{{item}}</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row v-show="editForm.type==3">
                    <el-col :span="12">
                        <el-form-item v-for="(i,index) in editForm.add_value" :label="'选项'+index" :key="index"  :prop="'add_value.' + index + '.value'" >
                                <el-col :span="11">
                                    <el-input v-model="i.value" auto-complete="off" ></el-input>
                                </el-col>
                                <el-col :span="1">&nbsp;</el-col>
                                <el-col :span="10"><el-button @click.prevent="removeItem(i)">删除</el-button></el-col>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-button @click.prevent="addItem()">添加自选</el-button>
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

        </MyDialog>
    </div>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
export default {
    name: 'Edit',
    mixins:[DialogForm],
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            editForm:{
                id:'',
                name:"",
                type:"",
                add_value:[]
            },
            model:null,
            showTypes:{},
        }
    },
    methods:{
        onOpen(param){
        this.model = param.params.model;
        this.model.type = this.model.type.toString();
        this.showTypes = param.params.extra;
        },
        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
        },
        removeItem(item){
            var index = this.editForm.add_value.indexOf(item)
            if (index !== -1) {
                this.editForm.add_value.splice(index, 1)
            }
        },
        addItem(){
            this.editForm.add_value.push({value:""});
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
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      