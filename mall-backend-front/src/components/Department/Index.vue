<template>
    <div class="hello">
        <el-row>
            <el-col>
                <el-form :inline="true"  ref="searchForm" :model="searchForm">
                    <!-- <el-form-item style="display: none;" prop="id">
                        <el-input  v-model="searchForm.id">
                        </el-input>
                    </el-form-item> -->

                    <el-form-item prop="name" >
                        <el-input size="small" placeholder="请输入单位名"  v-model="searchForm.name">
                        </el-input>
                    </el-form-item>

                    <!-- <el-form-item prop="contact" >
                        <el-input size="small" placeholder="请输入联系人"  v-model="searchForm.contact">
                        </el-input>

                    </el-form-item>
                    <el-form-item prop="tel" >
                        <el-input size="small" placeholder="联系人电话"  v-model="searchForm.tel">
                        </el-input>
                    </el-form-item> -->

                    <el-form-item prop="type">
                        <el-select size="small" placeholder="请选择" v-model="searchForm.type" clearable>
                            <el-option v-for="(item,index) in typeList" :value="index" :label="item" :key="index"></el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item>
                        <el-button size="small" type="primary" icon="search" @click="searchToolChange('searchForm')" >查询</el-button>
                        <el-tooltip content="清空搜索框并刷新表格数据" placement="bottom-start">
                            <el-button size="small" @click="searchToolReset('searchForm')" type="primary" style="margin-left:10px;">重置</el-button>
                        </el-tooltip>
                    </el-form-item>

                </el-form>
            </el-col>
        </el-row>


        <el-row>
            <el-col>
                <TableProxy
                        :url="mainurl"
                        :param="mainparam"
                        :reload="dataTableReload" :page-size="15">
                    <el-table-column label="序号" align="center"  type="index" width="65">
                    </el-table-column>
                    <el-table-column label="单位名"  prop="name" >
                    </el-table-column>

                    <el-table-column prop="type_text" label="类型" align="center">
                    </el-table-column>

                    <el-table-column label="联系人">
                        <template slot-scope="scope">
                            {{ scope.row.manager ? scope.row.manager.realname : '' }}
                        </template>
                    </el-table-column>

                    <el-table-column label="联系电话"  align="center">
                        <template slot-scope="scope">
                            {{ scope.row.manager ? scope.row.manager.mobilephone : '' }}
                        </template>
                    </el-table-column>
                    <el-table-column label="保证金"　prop="deposit"></el-table-column>
                    <!-- 让这个部门的人暂无法登录 -->
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

                    <el-table-column prop="remarks" label="备注" :show-overflow-tooltip="true">
                    </el-table-column>

                    <el-table-column   align="center" width="180" fixed="right"  label="操作"  >
                        <template slot-scope="scope">
                            <el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>
                            <!-- <el-button type="info"  size="small"> 导出人员 </el-button> -->
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-tooltip content="点击填写公告并发布" placement="right">
                            <el-button size="small" icon="plus" type="info" @click="showAdd" >添加</el-button>
                        </el-tooltip>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>

        <Add name='add-department'
             :type-list="typeList"
             :ajax-proxy="ajaxProxy"
             :entrepot-list="entrepotlist"
             @submit-success="handleReload"/>


        <Edit name='edit-department'
              :type-list="typeList"
              :ajax-proxy="ajaxProxy"
              :entrepot-list="entrepotlist"
              @submit-success="handleReload"/>

        <SetHr name='sethr-department'
               :ajax-proxy="ajaxProxy"
               @submit-success="handleReload"/>

    </div>

</template>

<script>

import Add from './Add';
import Edit from './Edit';
import SetHr from './SetHr';
import DataTable from '../../mix/DataTable';
import PageMix from '../../mix/Page';
import config from '../../mix/Delete';
import SearchTool from '../../mix/SearchTool';
import SelectProxy from  '../../packages/SelectProxy';
import DepartAjaxProxy from '../../ajaxProxy/Department';
import DistributionCenterSelectProxy from '@/packages/DistributionCenterSelectProxy';

export default {
    name: 'Department',
    pageTitle:"组织单位",
    mixins: [PageMix,SearchTool,DataTable,config,DepartAjaxProxy],
    components: {
        Add,
        Edit,
        SetHr
    },
    data () {
        return {
            ajaxProxy:DepartAjaxProxy,
            mainurl:DepartAjaxProxy.getUrl(),
            mainparam:"",
            depTypeName:"选择单位类型",
            typeList:[],
            entrepotlist:[],
            total:100,
            dataLoad:false,
            searchForm:{
                name:"",
                id:"0",
                contact:"",
                tel:"",
                type:""
            },

        }
    },
    methods:{
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        dataReload:function(){
          console.log(this.searchForm);
        },
        searchReset:function(){
            this.$refs['searchForm'].resetFields();
        },
        refresh:function(){
            this.$refs['searchForm'].resetFields();
        },
        depTypeChange:function(v){
            this.searchForm.type=v;
            this.depTypeName = this.typeList[v];
        },

         addFormSubmit:function(){
          console.log(this.addForm);
        },

        mainTableLoad(data){
            this.toggleTableLoad();
            this.tableData = data.items;
            this.total = data.total;
        },
        currentChange(v){
            this.toggleTableLoad();
            this.mainProxy.setPage(v).load();
        },
        toggleTableLoad(){
            this.dataLoad = !this.dataLoad;
        },

        onSearchChange(param){
            this.mainparam = JSON.stringify(param);
        },
	    initDepartmentType(data){
            this.typeList = data;
        },
        departMentInit(){
            let selectProxy = new SelectProxy(DepartAjaxProxy.getUrl(), this.initDepartmentType, this);
            selectProxy.setExtraParam({business:'DepartmentType'}).load();
        },

        showAdd(){
            this.entrepot.load();
            this.$modal.show('add-department');
        } ,
        openEdit(row){
            // this.editRow = row;
            // this.entrepot.load();
            this.$modal.show('edit-department', {model:row});
        } ,
        showSetHr(){
            // this.$modal.show('sethr-department');
        },
        switchHandle(){

        },
        loadEntrepot(data){
            this.entrepotlist = data.items;
        }

    },
    created(){

        this.$on('search-tool-change', this.onSearchChange);
        this.departMentInit();
        
        this.entrepot = new DistributionCenterSelectProxy({}, this.loadEntrepot, this);
        this.entrepot.load()

    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
