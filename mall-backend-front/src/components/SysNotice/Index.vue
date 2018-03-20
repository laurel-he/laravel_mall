<template>
    <div class="hello">
        <el-row>
            <el-col :span="12">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" class="search-bar">
                    <el-form-item prop="title" style="width: 140px">
                        <el-input type="text" size="small" v-model="searchForm.title" placeholder="请输入标题关键字"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button size="small" type="primary" icon="search" @click="searchToolChange('searchForm')" >查询</el-button>
                        <el-button size="small" @click="searchToolReset('searchForm')" type="primary">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>


        <el-row>
            <el-col>
                <TableProxy
                        :url="mainurl"
                        :param="mainparam"
                        :reload="dataTableReload">
                    <el-table-column label="序号" align="center"  type="index" width="65"></el-table-column>

                    <el-table-column label="公告类型"  prop="type_id" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.type_id==1">功能升级</span>
                            <span v-if="scope.row.type_id==2">新功能上线</span>
                            <span v-if="scope.row.type_id==3">功能测试</span>
                            <span v-if="scope.row.type_id==4">系统更新</span>
                            <span v-if="scope.row.type_id==5">系统BUG</span>
                            <span v-if="scope.row.type_id==6">系统维护</span>
                            <span v-if="scope.row.type_id==7">其它公告</span>
                        </template>
                    </el-table-column>

                    <el-table-column prop="title" label="公告标题" align="center"></el-table-column>

                    <el-table-column prop="content" label="公告内容" align="center"></el-table-column>

                    <el-table-column prop="start_time" label="开始日期"  align="center"></el-table-column>
                    
                    <el-table-column prop="end_time" label="截止日期"  align="center"></el-table-column>

                    <el-table-column prop="account" label="发布人" align="center"></el-table-column>

                    <el-table-column   align="center" width="180" fixed="right"  label="操作"  >
                        <template slot-scope="scope">
                            <el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-tooltip content="点击填写公告并发布" placement="right">
                            <el-button size="small" icon="plus" type="info" @click="$modal.show('add-sysnotice')" >添加</el-button>
                        </el-tooltip>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>





        <!-- / 修改公告 -->

        <Add name='add-sysnotice'
             :ajax-proxy="ajaxProxy"
             @submit-success="handleReload"/>


        <Edit name='edit-sysnotice'
              :ajax-proxy="ajaxProxy"
              @submit-success="handleReload"/>

    </div>

</template>

<script>

import Add from './Add';
import Edit from './Edit';


import DataTable from '../../mix/DataTable';

import PageMix from '../../mix/Page';
import config from '../../mix/Delete';
//import DataProxy from '../../packages/DataProxy';
import SearchTool from '../../mix/SearchTool';
import SelectProxy from  '../../packages/SelectProxy';

import SysNotice from '../../ajaxProxy/SysNotice';
//import TableProxy from '../common/TableProxy';

export default {
    name: 'SysNotice',
    pageTitle:"系统公告",
    mixins: [PageMix,SearchTool,DataTable,config,SysNotice],
    components: {
        Add,
        Edit,
    },

    data () {
        return {
            ajaxProxy:SysNotice,
            mainurl:SysNotice.getUrl(),
            mainparam:"",
            total:100,
            dataLoad:false,
            searchForm:{
                title:"",
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

        onSearchChange(param){
            this.mainparam = JSON.stringify(param);
        },

        showAdd(){
            this.$modal.show('add-sysnotice');
        } ,
        openEdit(row){
            this.$modal.show('edit-sysnotice', {model:row});
        } ,


    },
    created(){
        this.$on('search-tool-change', this.onSearchChange);




    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
