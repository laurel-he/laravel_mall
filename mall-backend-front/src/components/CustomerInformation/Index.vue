<template>
    <div class="hello">
        <el-row>
            <el-col :span="24">
                <el-form :inline="true" :model="searchForm" ref="searchForm" class="search-bar">
                    <el-form-item prop="department_id" v-show="strategySearchDepartShow">
                        <el-select size="small" v-model="searchForm.department_id" placeholder="部门" @change="onDepartChange" clearable>
                            <!-- departments -->
                            <el-option v-for="depart in departments" :value="depart.id" :label="depart.name" :key="depart.id"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="group_id" v-show="strategySearchGroupShow">
                        <el-select size="small" v-model="searchForm.group_id" placeholder="小组" @change="onGroupChange" clearable>
                            <!-- groups -->
                            <el-option v-for="group in groups" :value="group.id" :label="group.name" :key="group.id"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="user_id" v-show="strategySearchUserShow">
                        <el-select size="small" v-model="searchForm.user_id" placeholder="员工" clearable>
                            <!-- users -->
                            <el-option v-for="user in users" :value="user.id" :label="user.realname" :key="user.id"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="name">
                        <el-input v-model="searchForm.name" placeholder="客户姓名" size="small"></el-input>
                    </el-form-item>
                    <el-form-item prop="phone" >
                        <el-input v-model="searchForm.phone" placeholder="客户手机号" size="small"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" size="small"  @click="searchToolChange('searchForm')">查询</el-button>
                        <el-button type="primary" size="small"  @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row>
            <el-col >
                <TableProxy
                        :url="mainurl"
                        :param="mainparam"
                        :reload="dataTableReload">
                    <el-table-column label="序号"  type="index" align="center" width="80"></el-table-column>
                    <el-table-column prop="mid_relative.department_name" label="部门"  width="100" v-if="strategyColumnDepart">
                    </el-table-column>
                    <el-table-column prop="mid_relative.group_name" label="小组" width="100" v-if="strategyColumnGroup"></el-table-column>
                    <el-table-column prop="mid_relative.user_name" label="员工" width="100" v-if="strategyColumnUser"></el-table-column>
                    <el-table-column prop="name" label="客户姓名" width="160"></el-table-column>
                    <el-table-column prop="sex_text" label="性别"  align="center"></el-table-column>
                    <el-table-column prop="age" label="年龄" align="center" width="100"></el-table-column>
                    <el-table-column label="QQ号"  align="center" width="160">
                        <template slot-scope="scope">
                            {{ scope.row.contacts[0].qq }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="qq_nickname" label="QQ昵称" align="center" width="160">
                        <template slot-scope="scope">
                            {{ scope.row.contacts[0].qq_nickname }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="phone" label="手机"  align="center" width="160">
                        <template slot-scope="scope">
                            {{ scope.row.contacts[0].phone }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="weixin" label="微信号"  align="center" width="160">
                        <template slot-scope="scope">
                            {{ scope.row.contacts[0].weixin }}
                        </template>
                    </el-table-column>
                    <el-table-column prop="weixin_nickname" label="微信昵称"  align="center" width="160">
                        <template slot-scope="scope">
                            {{ scope.row.contacts[0].weixin_nickname }}
                        </template>
                    </el-table-column>
                    <el-table-column fixed="right" label="操作" width="280" align="center">
                        <template slot-scope="scope">
                            <el-button type="primary" size="small"  @click="openEdit(scope.row)">编 辑</el-button>
                            <el-button type="primary" size="small"  @click="openAddDeliveryAddress(scope.row)">收货地址</el-button>
                            <el-button size="small" type="success"  @click="openAddOrder(scope.row)">下 单</el-button>
                            <!--<el-button size="small" type="danger" @click="handleDelete(scope.row.id)">删除</el-button>-->
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-button size="small"  type="primary" @click="$modal.show('add-customerinformation')" >添加客户</el-button>
                        <el-button size="small"  type="info" @click="showDialog('set-transfer')" v-show="strategyButtonTransferShow">转让</el-button>
                        <!-- 一个小组员工 到 另一个小组员工 -->
                        <el-button size="small" @click="showDialog('quit-depart')" v-show="strategyButtonQuit1Show">离职接收</el-button>
                        <!-- 一个部门经理 到另 一个部门经理  -->
                        <el-button size="small" @click="showDialog('quit')" v-show="strategyButtonQuit2Show">离职接收</el-button>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>


        <Add name='add-customerinformation'
             :ajax-proxy="ajaxProxy"
             @submit-success="handleReload">

        </Add>

        <Edit name='edit-customerinformation'
              :ajax-proxy="ajaxProxy"
              @submit-success="handleReload">

        </Edit>

        <addAddress name='add-Address'
                    width="60%"
                    :ajax-proxy="addressAjaxProxy" @submit-success="handleReload">

        </addAddress>
        <!--<Chat name='chat'></Chat>-->
        <addOrder name='add-orderBasic'
                  width="60%"
                  :ajax-proxy="orderBasicAjaxProxy"
                  :CategoryList="CategoryList" @submit-success="handleReload">
        </addOrder>
        
        <Transfer name='set-transfer'></Transfer>

        <QuitDepart name="quit-depart"></QuitDepart>
        <Quit name="quit"></Quit>

    </div>

</template>

<script>
    // import advancedQuery from "./advancedQuery";
    import Add from "./Add";
    import Edit from "./Edit";
    import Chat from "./Chat";
    import addOrder from "./addOrder";
    import addAddress from "./addAddress";
    import Transfer from './Transfer';
    import QuitDepart from './QuitForDepart';
    import Quit from './Quit';

    import DataTable from '../../mix/DataTable';
    import PageMix from '../../mix/Page';
    //import DataProxy from '../../packages/DataProxy';
    import SearchTool from '../../mix/SearchTool';
    import SelectProxy from  '../../packages/SelectProxy';

    import Customer from '../../ajaxProxy/Customer';
   
    import Category from '../../ajaxProxy/Category';
    import DeliveryAddress from '../../ajaxProxy/DeliveryAddress';
    import OrderBasic from '../../ajaxProxy/OrderBasic';


    import DepartSelect from '../../packages/DepartSelectProxy';
    import GroupSelect from '../../packages/GroupSelectProxy';
    import EmployeeSelect from '../../packages/EmployeeSelectProxy';

    import { mapGetters } from 'vuex';
    import APP_CONST from '../../config';

    export default {
        name: 'Customer',
        pageTitle: "客户资料",
        mixins: [PageMix,SearchTool,DataTable,Customer],
        components: {
            // advancedQuery,
            Add,
            // Chat,
            Edit,
            addOrder,
            addAddress,
            Transfer,
            QuitDepart,
            Quit
        },
        data() {
            return {
                departments:[],
                groups:[],
                users:[],
                searchForm: {
                    department_id:'',
                    group_id:"",
                    user_id:"",
                    name:'',
                    phone:'',
                    with:['contacts', 'midRelative']
                },
                addressData:'',
                ajaxProxy:Customer,
                addressAjaxProxy:DeliveryAddress,
                orderBasicAjaxProxy:OrderBasic,
                mainurl:Customer.getUrl(),
                mainparam:'',
                CategoryList:'',
                strategies:""
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id':'department_id',
                'user_group_id':'group_id',
                'user_user_id' :'user_id'
            }),
            strategySearchDepartShow(){
                return this.strategies.search_depart != 0;
            }, 
            strategyColumnDepart(){
                return this.strategies.column_depart == 1 ;
            },
            
            strategySearchGroupShow(){
                return this.strategies.search_group != 0;
            },
            strategyColumnGroup(){
                return this.strategies.column_group == 1;
            },

            strategySearchUserShow(){
                return this.strategies.search_user != 0;
            },
            strategyColumnUser(){
                return this.strategies.column_user == 1;
            },
            strategyButtonTransferShow(){
                return this.strategies.button_transfer != 0;
            },
            strategyButtonQuit1Show(){
                return this.strategies.button_quit1 != 0;
            },
            strategyButtonQuit2Show(){
                return this.strategies.button_quit2 != 0;
            },

            

        },
        methods: {
            openEdit(row){
                this.$modal.show('edit-customerinformation', {model:row});
            },
            openAddDeliveryAddress(row){
                this.$modal.show('add-Address', {model:row});
            },
            openAddOrder(row){
                this.$modal.show('add-orderBasic', {model:row});
            },
            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            onSearchChange(param){
                this.mainparam = JSON.stringify(param);
            },
            getCategoryList(data){
                this.CategoryList=data.items;
            },
            getAddressData(data){
                this.addressData=data.items;
            },
            getCategory(){
                let selectProxy = new SelectProxy('/tree', this.getCategoryList, this);
                selectProxy.load();
            },
            getAddress(){
                let selectProxy = new SelectProxy(DeliveryAddress.getUrl(), this.getAddressData, this);
                selectProxy.load();
            },
            onSearchReset(){
                // todo 把角色有关的字符串 通通改成常量
                if (this.$store.getters.hasRole('administrator') ||  
                    this.$store.getters.hasRole('super-manager') ){
                    this.departSelect.setParam({type:'0'});
                    this.departSelect.load();
                } else {
                    if (this.$store.getters.hasRole('sale-manager')) {
                        if (this.user_department_id != 0) {
                            this.searchForm.department_id = this.user_department_id;
                            this.onDepartChange(this.searchForm.department_id);
                        } else {
                            return ;
                        }

                        if (this.user_group_id != 0) {
                            this.searchForm.group_id = this.user_group_id;
                            this.onGroupChange(this.searchForm.group_id);
                        } else {
                            return ;
                        }

                       
                    } 

                    if (this.$store.getters.hasRole('sale-captain')) {

                        if (this.user_group_id != 0) {
                            this.searchForm.group_id = this.user_group_id;
                            this.onGroupChange(this.searchForm.group_id);
                        }  else {
                            return ;
                        }
                    }

                    if (this.user_user_id != 0) {
                        this.searchForm.user_id = this.user_user_id;
                    }
                }
            },
            loadDeparts(data){
                if (data.items) {
                    this.departments = data.items;
                } else {
                    this.departments = data;
                }
            },
            loadGroups(data){
                this.groups = data.items;
            },
            loadUsers(data){
                this.users = data.items;
            },
            onDepartChange(v){
                if (v.toString().length > 0) {
                    this.groupSelect.setParam({department_id:v,fields:['id','name']});
                    this.groupSelect.load();
                }    
            },
            onGroupChange(v){
                if (v.toString().length > 0) {
                    this.employeeSelect.setParam({group_id:v,fields:['id', 'realname']});
                    this.employeeSelect.load();
                }  
            }

        },
        created(){
            this.$on('search-tool-change', this.onSearchChange);
            this.getCategory();   
            
            this.departSelect = new DepartSelect({type:'0'}, this.loadDeparts, this);
            this.groupSelect  = new GroupSelect(null, this.loadGroups, this);
            this.employeeSelect = new EmployeeSelect(null, this.loadUsers, this);

            this.onSearchReset();

            this.strategies = this.$store.getters.getStrategy( this.$options.name );
            // console.log(this.strategies);

            this.mainparam = JSON.stringify(this.searchForm);
            // this.$emit('search-tool-change', this.searchForm);
        },
        mounted(){
            this.$refs['searchForm'].$on('reset', this.onSearchReset);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>