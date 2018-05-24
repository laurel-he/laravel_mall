<template>
        <div class="bar-wrapper" v-bind:class="{ 'bar-wrapper-move': isbaractive }"  @mouseup.left="deactiveMove" @mousemove="barEnter">
            <el-row>
                <el-col :span="24">
                    <el-form :inline="true" :model="searchForm" ref="searchForm" class="search-bar">
                        
                        <el-form-item prop="group_id" >
                            <el-select size="small" v-model="searchForm.group_id" placeholder="小组" @change="onGroupChange" clearable>
                                <!-- groups -->
                                <el-option v-for="group in groups" :value="group.id" :label="group.name" :key="group.id"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item prop="user_id">
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
                        <el-form-item class="un-width">
                                <el-button size="small" type="info" @click="showDialog('advance')">高级查询</el-button>
                                <el-button size="small" type="info" @click="setBusiness('tracked')">跟踪</el-button>
                                <el-button size="small" type="info" @click="setBusiness('untracked')">未跟踪</el-button>
                                <el-button size="small" type="info" @click="setBusiness('plan')">计划</el-button>
                                <el-button size="small" type="info" @click="setSourceType('out')">转让</el-button>
                                <el-button size="small" type="info" @click="setSourceType('in')">转入</el-button>
                                <el-button size="small" type="info" @click="setType('V')">服务</el-button>
                                
                                <el-button size="small" @click="setBusiness('conflict')">冲突</el-button>
                                <el-button size="small" @click="preCheck">客户预查</el-button>
                            </el-form-item>
                    </el-form>
                </el-col>
            </el-row>
            <br>
            <el-row>
                <el-col :span="24">
                    <TableProxy
                            :height="mainHeight"
                            :url="mainurl"
                            :param="mainparam"
                            :reload="dataTableReload" :page-size="pageSize" @cellclick="rowCellClick">
                        <el-table-column label="序号"  type="index" align="center" width="80"></el-table-column>
                        <el-table-column prop="mid_relative.group_name" label="小组" width="100" ></el-table-column>
                        <el-table-column prop="mid_relative.user_name" label="员工" width="100" ></el-table-column>
                        <el-table-column prop="name" label="客户姓名" width="160"></el-table-column>
                        <el-table-column prop="type" label="客户类型" width="160">
                            <template slot-scope="scope">
                                {{ setCustomerTypeLabel(scope.row.type) }}
                            </template>
                        </el-table-column>
                        <el-table-column prop="sex_text" label="性别"  align="center"></el-table-column>
                        <el-table-column prop="age" label="年龄" align="center" width="100"></el-table-column>
                        <el-table-column label="QQ号" prop="qq" align="center" width="160">
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
                        <el-table-column fixed="right" label="操作" width="200" align="center">
                            <template slot-scope="scope">
                                <el-button-group>
                                    <el-button type="primary" size="small"  @click="openEdit(scope.row)">编 辑</el-button>
                                    <el-button type="primary" size="small"  @click="openAddDeliveryAddress(scope.row)">收货地址</el-button>
                                    <el-button size="small" type="success"  @click="openAddOrder(scope.row)">下 单</el-button>
                                </el-button-group>
                                <!--<el-button size="small" type="danger" @click="handleDelete(scope.row.id)">删除</el-button>-->
                            </template>
                        </el-table-column>
                        <div slot="buttonbar">
                            <el-button size="small"  type="primary" @click="openAdd" >添加客户</el-button>
                            <el-button size="small"  type="info" @click="addOtherContact" icon="plus">联系方式</el-button>
                            <el-button size="small"  type="info" @click="addTrackLog">录入跟踪</el-button>
    
                            <el-button size="small"  type="info" @click="showDialog('set-transfer')">转让</el-button>
                            <el-button size="small"  type="info" @click="showDialog('quit-depart')" >离职接收</el-button>

                            <el-button size="small"  type="info" @click="addComplain">投诉</el-button>
                            <el-button size="small" type="info"  @click="setPlan">计划</el-button>
                            
                        </div>
                    </TableProxy>
                </el-col>
                <el-col :span="24">
                    <div class="sl-bar"   @mousedown.left="activeMove"></div>
                </el-col>
            </el-row>
            <br>

            <SubDetail :row="model" :complain-type="complainType">
            </SubDetail>
           
    
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
    
            <other-contact name='other-contact'
                @submit-success="handleReload">
            </other-contact>
    
            <addOrder name='add-orderBasic'
                      width="60%"
                      :ajax-proxy="orderBasicAjaxProxy"
                      :CategoryList="CategoryList" @submit-success="handleReload">
            </addOrder>
            
           <add-track name='add-track'
                @submit-success="handleReload">
            </add-track>
    
             <Transfer name='set-transfer'></Transfer>
             <QuitDepart name="quit-depart"></QuitDepart>

            <plan name="plan"
                  :ajax-proxy="planAjaxProxy"
                  @submit-success="handleReload">
            </plan>
	        <add-complain name='add-complain' 
                @submit-success="handleReload">
            </add-complain>
            <preCheck name="preCheck"
                  width="60%">
            </preCheck>

            <Advance name="advance" :cus-type="cusData.type" :department-id="user_department_id"></Advance>
    
        </div>
    
    </template>
    
    <script>
        // import advancedQuery from "./advancedQuery";
        import localmix from '../mix';
        import Advance from './Advance';

        import OrderBasic from '@/ajaxProxy/OrderBasic';
    
        import DepartSelect from '@/packages/DepartSelectProxy';
        import GroupSelect from '@/packages/GroupSelectProxy';
        import EmployeeSelect from '@/packages/EmployeeSelectProxy';
        import CustomerSelect from '@/packages/CustomerSelectProxy';
    
        import { mapGetters } from 'vuex';
        import APP_CONST from '@/config';
    
        export default {
            name: 'Customer',
            pageTitle: "客户资料",
            mixins: [localmix],
            components:{
                Advance
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
                        // with:['contacts', 'midRelative'],

                        user_business:'',
                        type:'',
                        source:"",
                    },
                    orderBasicAjaxProxy:OrderBasic,
                    mainparam:'',
                    cusData:{},
                }
            },
            computed:{
                ...mapGetters({
                    'user_department_id':'department_id',
                    'user_group_id':'group_id',
                    'user_user_id' :'user_id'
                }),
            },
            methods: {
                getAjaxProxy(){
                    return  this.ajaxProxy;
                },
                setCustomerTypeLabel(type){
                    return this.cusData['type'][type];
                },
                onSearchChange(param){
                    this.mainparam = JSON.stringify(param);
                },
                onSearchReset(){
                    if (this.user_department_id != 0) {
                        this.searchForm.department_id = this.user_department_id;
                        // this.onDepartChange(this.searchForm.department_id);
                    } else {
                        return ;
                    }

                    if (this.user_group_id != 0) {
                        this.searchForm.group_id = this.user_group_id;
                        this.onGroupChange(this.searchForm.group_id);
                    } else {
                        this.searchForm.department_id = 0;
                    }

                    this.resetB();
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
                
                onGroupChange(v){
                    this.searchForm.user_id = '';
                    if (v.toString().length > 0) {
                        this.employeeSelect.setParam({group_id:v,fields:['id', 'realname']});
                        this.employeeSelect.load();
                    }  
                },
            },
            created(){
                this.$on('search-tool-change', this.onSearchChange);
                this.getCategory();   
                
                // this.departSelect = new DepartSelect({type:'0'}, this.loadDeparts, this);
                this.groupSelect  = new GroupSelect(null, this.loadGroups, this);
                this.employeeSelect = new EmployeeSelect(null, this.loadUsers, this);
    
                this.onSearchReset();
                
                if (this.user_department_id && this.user_department_id != 0 ) {
                    this.searchForm.department_id = this.user_department_id;
                    this.groupSelect.setParam({department_id:this.user_department_id,fields:['id','name']});
                    this.groupSelect.load();
                } else {
                    this.searchForm.department_id = 0;
                }

                this.onSearchChange(this.searchForm);
                
                
                
            },
            mounted(){
                this.$refs['searchForm'].$on('reset', this.onSearchReset);
            }
        }
    </script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
    </style>
    <style scoped>
        @import '../mix/style.css';
    </style>
