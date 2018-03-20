<template>
    <MyDialog title="离职接收" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
        <el-row>
            <el-col :span="24">
                <TableProxy 
                    :url="mainurl"
                    :param="mainparam"
                    :page-size="10"
                    :bubble="bubble">
                    <el-table-column type="selection" width="55"></el-table-column>
                    <el-table-column label="姓名" prop="realname"></el-table-column>
                    <el-table-column label="登录账号" prop="account"></el-table-column>
                    <el-table-column label="原部门"  prop="department.name"></el-table-column>
                    <el-table-column label="原小组"  prop="group.name"></el-table-column>
                    <el-table-column label="离职日期"  prop="deleted_at" width="180"></el-table-column>
                </TableProxy>
            </el-col>
        </el-row>
        <el-form :model="quitForm" ref="quitForm">
            <el-form-item label="选中员工" prop="user_ids">
                <span v-for="user in multipleSelection" :key="user.id">{{ user.realname }} </span>
            </el-form-item>
            <el-form-item>
                将上面选中的员工客户由下面的员工接收
            </el-form-item>
            <el-form-item label="接收员工" prop="to_id">
                <el-cascader class="cas-width" size="small" :options="options" @change="targeChange" v-model="target">
                </el-cascader>
            </el-form-item>
        </el-form>
        <div slot="dialog-foot" class="dialog-footer">
            <el-button @click="handleClose">取 消</el-button>
            <submit-button
                    @click="formSubmit('quitForm')"
                    :observer="dialogThis">
                保 存
            </submit-button>
        </div>
    </MyDialog>
</template>

<script>
    import DataTable from '../../mix/DataTable';
    import FormMix from '../../mix/Form';
    import DialogMix from '../../mix/Dialog';
    import EmployeeAjax from '../../ajaxProxy/Employee';
    import CustomerAjax from '../../ajaxProxy/Customer';
    import GroupSelect from '../../packages/GroupSelectProxy';
    import LocalMix from './mix';

    import { mapGetters } from 'vuex';

    export default {
        name: 'QuitDepart',
        mixins:[DataTable,FormMix,DialogMix,LocalMix],
        data () {
            return {
                mainurl:EmployeeAjax,
                mainparam:"",
                dialogThis: this,

                quitForm:{
                    user_ids:[],
                    to_id:"",
                },
                bubble:{
                    'selection-change': this.onSelectionChange
                },
                multipleSelection:[],

                options:[],
                target:[],
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id':'department_id'
            }),
        },
        methods:{
            onSelectionChange(val){
                this.multipleSelection = val;
                let re = [];
                for (let index = 0; index < this.multipleSelection.length; index++) {
                    const element = this.multipleSelection[index];
                    re.push(element.id);
                }
                this.quitForm.user_ids = re;
            },
            targeChange(arr){
                this.quitForm.to_id = arr[1];
            },
            loadDatas(data){
                // console.log(data);
                this.options = this.trasnGroupToOptions(data.items);
            },
            onBeforeOpen(){
                this.groupSelect.load();
            },
            getAjaxPromise(model){
                return CustomerAjax.quitTransfer(model);
            }
        },
        created(){
            this.mainparam = JSON.stringify({
                department_id: this.user_department_id,//
                status:-1,
                with:['group','department'],
                fields:['id','account','realname','group_id','department_id','deleted_at'],
                orderField:'deleted_at',
                orderWay:'desc'
            });

            this.groupSelect = new GroupSelect(
                { department_id:this.user_department_id, with:['users']},
                this.loadDatas,
                this );
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
  