<template>
    <div >
        <MyDialog title="设置人事专员" :name="name" :width="width" :height="height">
            <!--<el-form ref="hrForm"  :model="hrForm" v-model="hrForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">-->
                <!--<el-row>-->
                    <!--<el-col :span="12">-->
                        <!--<el-form-item label="单位名" prop="name" >-->
                            <!--<el-input class="name-input" v-model="addForm.name"  auto-complete="off" placeholder="请填写单位名称"></el-input>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                    <!--<el-col :span="12">-->
                        <!--<el-form-item label="类型"  prop="type">-->
                            <!--<el-select  v-model="addForm.type"  placeholder="请选择类型"  >-->
                                <!--<el-option  v-for='(item,key) in typeList' :label="item" :value="key" :key="key"></el-option>-->
                            <!--</el-select>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                <!--</el-row>-->

                <!--<el-row>-->
                    <!--<el-col :span="12">-->
                        <!--<el-form-item label="部门经理"  prop="contact">-->
                            <!--<el-select v-model='addForm.manager_id'>-->
                                <!--<el-option v-for="user in computedusers" :label="user.realname"-->
                                           <!--:value="user.user_id" :key="user.user_id">-->
                                <!--</el-option>-->
                            <!--</el-select>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                    <!--<el-col :span="12">-->
                        <!--<el-form-item label="是否启用" prop="status">-->
                            <!--<el-radio-group v-model="addForm.status">-->
                                <!--<el-radio :label="1">启用</el-radio>-->
                                <!--<el-radio :label="0">禁用</el-radio>-->
                            <!--</el-radio-group>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                <!--</el-row>-->
                <!--<el-row>-->
                    <!--<el-col :span="24">-->
                        <!--<el-form-item label="备注"  prop="remark">-->
                            <!--<el-input type="textarea"  auto-complete="off" v-model="addForm.remarks" placeholder="请填写备注"></el-input>-->
                        <!--</el-form-item>-->
                    <!--</el-col>-->
                <!--</el-row>-->
            <!--</el-form>-->
            <el-form ref="hrForm"  :model="hrForm" v-model="hrForm" :label-width="dialogLabelWidth">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="备选人事" prop="user_ids">
                            <el-select v-model="hrForm.user_ids" multiple >
                                <el-option v-for="user in dehrs" :key="user.user_id" :label="user.realname" :value="user.user_id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <!--<el-form-item>-->
                    <!--<el-button type="primary">取 消</el-button>-->
                    <!--<el-button type="primary"   >确 定</el-button>-->
                    <!--<el-button type="primary" >修改中</el-button>-->
                <!--</el-form-item>-->
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
import DataProxy from '../../packages/DataProxy';

export default {
    name: 'SetHr',
    mixins:[DialogForm],
    data () {
        return {
            dialogThis:this,
            dialogLabelWidth:'80px',
            hr:[{user_id:'1',realname:'李清'}],
            dehrs:[{user_id:'1',realname:'李清'}],
            labelPosition:"right",
            labelWidth:'80px',
            hrForm:{
                id:null,
                user_ids:[]
            },

        }
    },
    methods:{
        getAjaxPromise(model){
             console.log(model);
            //return this.ajaxProxy.create(model);
        },

    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      