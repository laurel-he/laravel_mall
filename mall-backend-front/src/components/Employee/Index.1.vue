<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true" ref="searchForm" :model="searchForm">
                    <el-form-item style="display: none;" prop="id">
                        <el-input  v-model="searchForm.id"></el-input>
                    </el-form-item>
                    <el-form-item style="width: 140px" prop="typeNumber">
                        <el-select v-model="searchForm.typeNumber" size="small" clearable placeholder="查询类型">
                            <el-option v-for="item in types" :label="item.name" 
                            :value="item.value" :key="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
    
                    <el-form-item prop="typeValue">
                        <el-input v-model="searchForm.typeValue" size="small" 
                        placeholder="请输入查询数据">
                        </el-input>
                    </el-form-item>
    
                    <el-form-item prop="department_id">
                        <el-select size="small" v-model="searchForm.department_id" placeholder="部门" @change="departmentChange">
                            <el-option v-for="v in departments" :label="v.name" 
                            :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
    
                    <el-form-item prop="group_id">
                        <el-select size="small" v-model="searchForm.group_id" placeholder="团队小组">
                            <el-option v-for="v in groups" :label="v.name" 
                            :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
    
                    <el-form-item prop="status" style="width: 90px;">
                        <el-select size="small" v-model="searchForm.status">
                            <el-option value="1" label="在职"></el-option>
                            <el-option value="-1" label="离职"></el-option>
                        </el-select>
                    </el-form-item>
    
                    <el-form-item>
                        <el-button type="primary" size="small" icon="search" 
                        @click="searchToolChange('searchForm')">查询
                        </el-button>
                        <el-button @click="searchToolReset('searchForm')" 
                        size="small" type="primary">重置
                        </el-button>
                    </el-form-item>
    
                    <!-- <el-form-item>
                        <el-tooltip content="点击刷新当前页面" placement="right">
                            <el-button  size="small" type="danger">刷新</el-button>
                        </el-tooltip>
                    </el-form-item> -->
                </el-form>
            </el-col>
        </el-row>

        <el-row>
            <el-col>
                 <TableProxy 
                    :url="mainurl" 
                    :param="mainparam"
                    :reload="dataTableReload"
                    :bubble="bubble" :page-size="15">
                    <el-table-column label="序号" width="70" type="index">
                    </el-table-column>

                    <el-table-column prop="head" label="头像" width="100" align="center">
                        <template slot-scope="scope">
                            <img 
                                width="50"
                                height="50"
                                :src="scope.row.head" 
                                v-show="scope.row.head" 
                                alt="头像">
                        </template>
                    </el-table-column>

                     <el-table-column prop="account" label="登录账号" width="100">
                    </el-table-column>

                    <el-table-column prop="realname" label="员工姓名" width="150">
                    </el-table-column>

                    <el-table-column label="部门" width="100">
                        <template slot-scope="scope">
                            {{ scope.row.department ? scope.row.department.name : '' }}
                        </template>
                    </el-table-column>
                    <el-table-column label="团队小组" width="100">
                        <template slot-scope="scope">
                            {{ scope.row.group ? scope.row.group.name : '' }}
                        </template>
                    </el-table-column>

                    <el-table-column label="职位" width="120" >
                        <template slot-scope="scope">
                            {{ displayRoleName(scope.row.roles) }}
                        </template>
                    </el-table-column>

                    <el-table-column prop="sex" label="性别" width="80" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.sex==0">未定义</span>
                            <span v-else-if="scope.row.sex==1" >男</span>
                            <span v-else-if="scope.row.sex==2">女</span>
                        </template>
                    </el-table-column>

                    <el-table-column prop="id_card" label="身份证号" width="192">
                    </el-table-column>

                    <el-table-column prop="telephone" label="固话" width="140" align="center">
                    </el-table-column>

                    <el-table-column prop="mobilephone" label="手机" width="140" align="center">
                    </el-table-column>

                    <el-table-column prop="qq" label="QQ号" width="140" align="center">
                    </el-table-column>

                    <el-table-column prop="qq_nickname" label="QQ昵称" width="180" align="center">
                    </el-table-column>

                    <el-table-column prop="weixin" label="微信号" width="160" align="center">
                    </el-table-column>

                    <el-table-column prop="weixin_nickname" label="微信昵称" width="190" align="center">
                    </el-table-column>

                    <el-table-column prop="address" label="地址" width="190" align="center">
                    </el-table-column>

                    <el-table-column prop="ip" label="登录IP" width="170" header-align="center">
                    </el-table-column>

                    <el-table-column prop="location" label="登录地点" width="170" align="center">
                    </el-table-column>

                    <el-table-column prop="lg_time" label="最后登录时间" width="175" align="center">
                    </el-table-column>

                    <el-table-column prop="out_time" label="最后退出时间" width="175" align="center">
                    </el-table-column>

                    <el-table-column prop="creator_name" label="创建员工" width="190" align="center">
                    </el-table-column>

                    <el-table-column prop="created_at" label="创建时间" width="190">
                    </el-table-column>

                    <el-table-column fixed="right" label="操作" width="240" align="center">
                        <template slot-scope="scope">
                            <el-button type="success"  size="small" @click="openEdit(scope.row)" >编辑</el-button>
                            <!-- <el-button type="info" size="small">职能</el-button> -->
                            <el-button type="primary" size="small" @click="openPassword(scope.row)">修改密码</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >离职</el-button>
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-button size="small" type="primary" @click="openAdd">添 加</el-button>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>

        <!-- 弹窗 -->
        <addDialog 
            name='add-employee'
            :ajax-proxy="ajaxProxy"
            :departments="departments"
            @submit-success="handleReload"/>

         <editDialog
           name="edit-employee"
           :ajax-proxy="ajaxProxy"
           :departments="departments"
           @submit-success="handleReload"/>

         <EditPassWord name="change-password" :ajax-proxy="passowrdAjaxProxy" />

         <!-- / 弹窗 -->

    </div>
</template>
<script>
    import addDialog from './addDialog';
    import editDialog from './editDialog';
    import EditPassWord from './EditPassWord';
    import PageMix from '../../mix/Page';
    import DataProxy from '../../packages/DataProxy';
    import DataTable from '../../mix/DataTable';
    import DepartSelectProxy from '../../packages/DepartSelectProxy';
    import GroupSelectProxy from '../../packages/GroupSelectProxy';
    import SearchTool from '../../mix/SearchTool';
    import getGroupsByPid from '../../ajaxProxy/getGroupsByPid';
    import EmployeeAjaxProxy  from '../../ajaxProxy/Employee';
    import PassowrdAjaxProxy from '../../ajaxProxy/Password';


    import { mapActions,mapGetters } from 'vuex';

    export default {
        name: 'Employee',
        pageTitle: "员工管理",
        mixins: [PageMix, SearchTool,DataTable,getGroupsByPid],
        components: {
            addDialog,
            editDialog,
            EditPassWord
        },
        data() {
            return {
                ajaxProxy: EmployeeAjaxProxy,
                passowrdAjaxProxy:PassowrdAjaxProxy,
                mainurl:EmployeeAjaxProxy.getUrl() ,
                mainparam:"",
                searchForm: {
                    typeValue: "",
                    department_id: '',
                    group_id: '',
                    status: "1",
                    typeNumber: ''
                },
                departments: [],
                groups: [],
                currentPage4: 1,
                types: [
                    {value: '1', name: '员工账号'},
                    {value: '2', name: '员工姓名'},
                    {value: '3', name: '手机号'},
                    {value: '4', name: 'QQ号'},
                    {value: '5', name: '微信号'},
                ],
                bubble:{
                    'row-click': this.handleRowClick
                }
            }
        },
        methods: {
            ...mapActions([
                'getRoles'
            ]),

            getAjaxProxy(){
              return  this.ajaxProxy;
            },
            departmentChange(pid){
                this.groups=[];
                this.searchForm.group_id='';
               this.getGroupsAjax(pid);
            },
            openEdit(row){
            this.$modal.show('edit-employee', {model:row});
            },
            openAdd(){
                this.$modal.show('add-employee');
            },
            loadDepartment(data) {
                this.departments = data.items;
            },
            onSearchChange(param) {
                this.mainparam = JSON.stringify(param);
            },
            handleRowClick(row, event, column){
               console.log('row-click handle', row, event, column);
            },
            displayRoleName(roles){
                let cate = [];
                for (let index = 0; index < roles.length; index++) {
                    cate.push(roles[index].display_name);
                }
                return cate.join(" 、");
            },
            openPassword(user){
                let model = {id:user.id, account:user.account};
                this.$modal.show('change-password',{model:model});
            }

        },
        created() {
            let departProxy = new DepartSelectProxy(null, this.loadDepartment, this);
            this.departProxy = departProxy;
            this.departProxy.load();
            this.$on('search-tool-change', this.onSearchChange);
            this.getRoles();
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
