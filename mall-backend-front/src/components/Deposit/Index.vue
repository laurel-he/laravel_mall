<template>
    <div>
      <!-- search bar -->
        <el-row>
            <el-col :span="12">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" class="search-bar">
                    <el-form-item prop="department_id" >
                        <el-select size="small" placeholder="请选择单位"  v-model="searchForm.department_id" @change="onDepartChange">
                            <el-option v-for="v in departments" 
                                :label="v.name" 
                                :value="v.id" 
                                :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="group_id" >
                        <el-select size="small" placeholder="请选择小组"  v-model="searchForm.group_id" @change="onGroupChange">
                            <el-option v-for="v in groups" 
                                :label="v.name" 
                                :value="v.id" 
                                :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="user_id" >
                        <el-select size="small" placeholder="请选择员工"  v-model="searchForm.user_id">
                            <el-option v-for="v in users"
                                :label="v.realname" 
                                :value="v.id" 
                                :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item>
                        <el-button size="small" type="primary" icon="search" @click="searchToolChange('searchForm')" >查询</el-button>
                        <el-button size="small" @click="searchToolReset('searchForm')" type="primary">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
      <!-- / search bar -->

      <!-- data table -->
        <el-row>
            <el-col>
                <TableProxy
                :url="mainurl"
                :param="mainparam"
                :reload="dataTableReload">
                    <el-table-column label="序号" align="center"  type="index" width="65">
                    </el-table-column>
                    <el-table-column label="部门" prop="department_name"></el-table-column>
                    <el-table-column label="小组" prop="group_name"></el-table-column>
                    <el-table-column label="员工" prop="realname"></el-table-column>
                    <!-- 充值金额、充值时间、充值操作人、充值部门 -->
                    <el-table-column label="充值金额" prop="money"></el-table-column>
                    <el-table-column label="充值方式" prop="charge_type">
                        <template slot-scope="scope">
                            <span v-if="scope.row.charge_type==1">微信</span>
                            <span v-else-if="scope.row.charge_type==2">支付宝</span>
                            <span v-else-if="scope.row.charge_type==3">银行转账</span>
                        </template>
                    </el-table-column>
                     <el-table-column label="充值时间" prop="charge_time"></el-table-column>
                    <el-table-column label="记录时间" prop="created_at" width="190"></el-table-column>
                    <el-table-column label="操作员工" prop="creator"></el-table-column>
                    <el-table-column label="充值部门" prop="charge_department"></el-table-column>
                    <el-table-column label="备注" prop="remark" :show-overflow-tooltip="true"></el-table-column>

                    <!-- <el-table-column   align="center" width="180" fixed="right"  label="操作"  >
                        <template slot-scope="scope">
                            <el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>
                        </template>
                    </el-table-column> -->

                    <!-- buttonbar -->
                    <div slot="buttonbar">
                        <el-button size="small" type="info" @click="showAdd">添加</el-button>
                    </div>
                    <!-- / buttonbar -->
                </TableProxy>
            </el-col>
        </el-row>
      <!-- / data table -->

      <!-- 弹窗 -->
            <Add name='add-deposit'
             :ajax-proxy="ajaxProxy"
             @submit-success="handleReload"/>
      <!-- / 弹窗 -->
    </div>
  </template>
  
  <script>
  import PageMix from '../../mix/Page';

  import DataTable from '../../mix/DataTable';
  import Add from './Add';

  import SearchTool from '../../mix/SearchTool';
  import getGroupsByPid from '../../ajaxProxy/getGroupsByPid';
  import getUsersByGid from '../../ajaxProxy/getUsersByGid';
  import DepositAjaxProxy from  '../../ajaxProxy/Deposit';
  import DepartSelectProxy from '../../packages/DepartSelectProxy';
  import GroupSelectProxy from '../../packages/GroupSelectProxy';
  import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';

  export default {
    name: 'Deposit',
    pageTitle:"保证金-充值管理",
    mixins:[PageMix,DataTable,SearchTool,getGroupsByPid,getUsersByGid],
    components:{
        Add
    },
    data () {
        return {
            ajaxProxy:DepositAjaxProxy,
            departments:[],
            groups:[],
            users:[],
            searchForm:{
                department_id:"",
                group_id:"",
                user_id:""
            },
            mainurl:DepositAjaxProxy,
            mainparam:"",
        }
    },
    methods:{
        showAdd(){
            this.$modal.show('add-deposit');
        },
        onSearchChange(param) {
            this.mainparam = JSON.stringify(param);
        },
        loadDepartment(data){
            this.departments = data.items;
        },
        onDepartChange(pid){
            this.groups=[];
            this.users=[];
            this.searchForm.group_id='';
            this.searchForm.user_id='';
            if(pid){
                this.getGroupsAjax(pid);
            }

        },
        onGroupChange(gid){
            this.users=[];
            this.searchForm.user_id='';
            if(gid){
                this.getUsersAjax(gid);
            }


        }
    },
    created(){
        let departProxy = new DepartSelectProxy(null, this.loadDepartment, this);
        this.departProxy = departProxy;
        this.departProxy.load();
        this.$on('search-tool-change', this.onSearchChange);
    }
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
  </style>
  