<template>
    <div >
        <MyDialog title="设置职能" :name="name" :width="width" :height="height">
            <el-form ref="setRolesForm" :model="setRolesForm" :label-width="labelWidth"  :label-position="labelPosition">
                <el-form-item label="职能">
                    <el-select v-model="setRolesForm.role_ids">
                        <el-option v-for="role in roleList" :key="role.id" :label="role.name" :value="role.id"></el-option>
                    </el-select>
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
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            roleList:[
                {id:1,name:'总经半'},
                {id:2,name:'部门经理'},
                {id:3,name:'主管'},
            ],
            setRolesForm:{
                role_ids:""
            },

        }
    },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      