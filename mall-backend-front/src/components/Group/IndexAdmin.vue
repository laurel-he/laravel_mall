<template>
        <div>
            <el-row>
                <el-form :inline="true"  ref="searchForm" :model="searchForm" class="search-bar">
                    <el-form-item prop="department_id"  >
                        <el-select 
                            clearable
                            v-model="searchForm.department_id" 
                            size="small" 
                            placeholder="部门">
                            <el-option v-for="v in departments" :label="v.name"
                             :value="v.id" :key="v.id">
                             </el-option>
                        </el-select>
                    </el-form-item>
    
                    <el-form-item prop="name">
                        <el-input v-model="searchForm.name" size="small" placeholder="团队小组名称"></el-input>
                    </el-form-item>
    
                    <!-- <el-form-item prop="realname" style="width: 120px">
                        <el-input v-model="searchForm.realname" size="small" placeholder="输入负责人姓名">
                        </el-input>
                    </el-form-item> -->
    
                    <!-- <el-form-item prop="phone" style="width: 120px">
                        <el-input v-model="searchForm.phone" size="small" placeholder="输入联系电话">
                        </el-input>
                    </el-form-item> -->
    
                    <el-form-item>
                        <el-button type="primary" size="small" @click="searchToolChange('searchForm')" icon="search">查询
                        </el-button>
                        <el-button size="small" type="primary" @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-row>
            <el-row>
                <el-col>
    
                    <TableProxy 
                        :url="mainurl" 
                        :param="mainparam"
                        @dbclick="doubleClick"
                        :reload="dataTableReload">
                        <el-table-column label="序号" align="center" type="index" width="65"> 
                        </el-table-column>
    
                        <el-table-column  label="部门">
                            <template slot-scope="scope">
                                {{ scope.row.department ? scope.row.department.name : '' }}
                            </template>
                        </el-table-column>
    
                        <el-table-column label="团队小组名称" prop="name"  >
                        </el-table-column>
    
                        <el-table-column  label="联系人(负责人)"  >
                            <template slot-scope="scope">
                                {{ scope.row.manager ? scope.row.manager.realname : '' }}
                            </template>
                        </el-table-column>
    
                        <el-table-column label="联系电话" align="center">
                            <template slot-scope="scope">
                                {{ scope.row.manager ? scope.row.manager.mobilephone : '' }}
                            </template>
                        </el-table-column>
                        <!-- 控制一个小组的员工 暂不能登录 未实现 -->
                        <el-table-column label="是否启用" align="center" prop="status">
                            <template slot-scope="scope">
                                <el-switch
                                        v-model="scope.row.status"
                                        :on-value="1"
                                        :off-value="0"
                                        on-color="#13ce66"
                                        off-color="#ff4949"
                                        @change="switchHandle(scope.$index, scope.row)">
                                </el-switch>
                            </template>
                        </el-table-column>
    
                        <el-table-column prop="remarks" label="说明备注" align="center">
                        </el-table-column>
    
                        <el-table-column   align="center" width="180" fixed="right"  label="操作"  >
                            <template slot-scope="scope">
                                <el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>
                                <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>
                                <!-- <el-button type="info"  size="small"> 导出人员 </el-button> -->
                            </template>
                        </el-table-column>
    
                        <div slot="buttonbar">
                                <el-button size="small" icon="plus" type="info" @click="showadd" >添加</el-button>
                        </div>
                    </TableProxy>
                </el-col>
            </el-row>
    
            <el-row>
                <el-col :span="24">
                    <el-tabs>
                        <el-tab-pane label="团队成员">
                            <el-table :data="users" empty-text="暂无数据" border>
                                <el-table-column prop="user_id" label="员工ID" width="180" align="center">
                                </el-table-column>
                                <el-table-column prop="realname" label="员工姓名" width="180" align="center">
                                </el-table-column>
                                <el-table-column prop="role_name" label="员工职位" width="180" align="center">
                                </el-table-column>
                                <el-table-column prop="phone" label="手机" align="center">
                                </el-table-column>
                                <el-table-column prop="qq" label="QQ号" align="center">
                                </el-table-column>
                            </el-table>
                        </el-tab-pane>
                    </el-tabs>
                </el-col>
            </el-row>
            
            <!-- 添加小组 -->
            <!-- add-open.sync 这样写不起作用 bug? -->
            
    
            <edit-dialog 
                name="edit"
                :departments="departments" 
                :ajax-proxy="ajaxProxy"
                @submit-success="handleReload">
            </edit-dialog>
    
            <!-- <MyDialog name='abc'></MyDialog> -->
    
            <add-dialog 
                name="add"
                :departments="departments" 
                :ajax-proxy="ajaxProxy"
                :strategies = 'strategies'
                @submit-success="handleReload">
            </add-dialog>
    
        </div>
    
    
    </template>
    
    <script>
        import addDialog from './Add.vue';
        import editDialog from './Edit.vue';
        import PageMix from '../../mix/Page';
        import getUsersByGid from '../../ajaxProxy/getUsersByGid';
        import DepartSelectProxy from '../../packages/DepartSelectProxy';
        import GroupSelectProxy from '../../packages/GroupSelectProxy';
        import SearchTool from '../../mix/SearchTool';
        import DataTable from '../../mix/DataTable';
        import GroupAjaxProxy from '../../ajaxProxy/Group';
        import SelectProxy from  '../../packages/SelectProxy';
        // import Dialog from '../common/Dialog';
    
        export default {
            name: 'Group',
            pageTitle: "团队小组",
            mixins: [PageMix, SearchTool,DataTable,getUsersByGid],
            components: {
                addDialog,
                editDialog,
            },
            data() {
                return {
                    ajaxProxy: GroupAjaxProxy,
                    mainurl:GroupAjaxProxy,
                    mainparam:"",
                    url:'/employees',
                    departments: [],
                    groups: [],
                    users: [],
                    addDialog: false,
                    editDialog: false,
                    searchForm: {
                        name: "",
                        department_id: '',
    
                    },
                    currentRow:null,
                    tableData1: [],
    
                    //显示隐藏策略
                    strategies:null,
                }
            },
            computed:{
                strategyColumnDepart(){
                    return this.strategies.column_depart == 1 ;
                },  
            },
            watch:{
                addDialog(val, oldVal){
                    console.log('index addDialog', val);
                }
            },
            methods: {
                
                doubleClick:function (row) {
                    this.getUsersAjax(row.id);
                    // let categoryProxy = new SelectProxy(this.url+'/'+row.id,this.userLoaded, this,);
                    // categoryProxy.load();
                },
                userLoaded(data){
                    this.tableData1=data.items;
                }, getAjaxProxy(){
                    return  this.ajaxProxy;
                },
                switchHandle:function(index,row){
    
                },
                depTypeChange: function (v) {
                    this.searchForm.type = v;
                    this.depTypeName = this.typeList[v];
                },
                openEdit: function (row) {
                    // this.currentRow = row;
                    this.$modal.show('edit', {model:row});
                },
               
                loadDepartment(data) {
                    this.departments = data.items;
                },
                loadGroup(data) {
                    this.groups = data.items;
                },
                onSearchChange(param) {
                    this.mainparam = JSON.stringify(param);
                },
    
                an(){
                    this.$modal.show('abc');
                },
                showadd(){
                    this.$modal.show('add');
                }
            },
            created() {
    
                let departProxy = new DepartSelectProxy(null, this.loadDepartment, this);
                this.departProxy = departProxy;
                this.departProxy.load();
    
    
                // let departProxy = new DepartSelectProxy({'type': 0}, this.loadDepartment, this);
                // this.departProxy = departProxy;
                // this.departProxy.load();
    
                // let groupProxy = new GroupSelectProxy({'depart_id': 1}, this.loadGroup, this);
                // this.groupProxy = groupProxy;
                // this.groupProxy.load();
    
                this.$on('search-tool-change', this.onSearchChange);
    
                // this.getStrategy(this.$options.name);
                this.strategies = this.$store.getters.getStrategy( this.$options.name );
                // console.log(strategy);
    
            }
        }
    </script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
    
    </style>
    