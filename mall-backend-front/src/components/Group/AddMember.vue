<template>
    <div>
        <MyDialog title="添加小组成员" :name="name" :width="width" :height="height" @before-open="onBeforeOpen" @opened="onOpen">
           <el-form :model="setMemberForm" ref="setMemberForm" :label-position="labelPosition">
                <el-form-item prop="id" label="小组">
                   {{ group_name }}
                </el-form-item>
                <el-form-item label="未分配" prop="ids">
                    <el-checkbox-group 
                        v-model="setMemberForm.ids">
                        <el-checkbox v-for="user in unsign" :label="user.id" :key="user.id" >{{user.realname}}</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>

                <el-form-item label="已分配" prop="ids">
                    <el-checkbox-group 
                        v-model="setMemberForm.ids">
                        <el-checkbox v-for="user in sign" :label="user.id" :key="user.id" >{{user.realname}} -{{user.group_name}}</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
           </el-form>
           <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="formSubmit('setMemberForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    import EmployeeAjaxProxy from '../../ajaxProxy/Employee';
    import LocalMix from './mix';
    import { mapGetters } from 'vuex';

    export default {
        name: 'addMember',
        mixins:[DialogForm, LocalMix],
        data () {
            return {
                labelPosition:'top',
                dialogThis:this,
                group_name:"",
                setMemberForm:{
                    group_id:"",
                    ids:[]
                },

                sign:[],
                unsign:[]
            }
        },
        methods:{
            loadUsers(data){
                // console.log(data);
                let re = this.groupManager(data.items);
                this.sign = re.sign,
                this.unsign  = re.unsign;
            },
            onBeforeOpen(){
                this.currentRow = this.$parent.getCurrentRow()
                if (this.currentRow) {
                    this.employeeSelect.setParam({
                        role:'group-member', 
                        with:['group'], 
                        department_id:this.currentRow.department_id,
                        fields:['id','realname','group_id'],
                        not:{group_id:this.currentRow.id}
                    });
                    this.employeeSelect.load();   

                    this.group_name = this.currentRow.name;
                    this.setMemberForm.group_id = this.currentRow.id;
                }
                
            },

            onOpen(){
                if (!this.currentRow) {
                    this.$message.error("请选择一个小组");
                    this.handleClose();
                }
            },

            //EmployeeAjaxProxy
            getAjaxPromise(model){
                return EmployeeAjaxProxy.updates(model);
            }

        },
        created(){
            
            this.employeeSelect = new EmployeeSelectProxy({}, this.loadUsers, this);
        }
    }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
  </style>
  