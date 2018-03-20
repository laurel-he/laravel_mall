<template>
    <div class="hello">
        <el-row>
            <el-col :span="12">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" class="search-bar">
                    <el-form-item prop="webUrl" style="width: 140px">
                        <el-input type="text" size="small" v-model="searchForm.webUrl" placeholder="请输入查询网址"></el-input>
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

                    <el-table-column prop="describe" label="网址描述" align="center"></el-table-column>


                    <el-table-column prop="webUrl" label="具体网址" align="center">
                        <template slot-scope="scope">
                            <a :href="'http://' + scope.row.webUrl" target="_blank">{{scope.row.webUrl}}</a>
                        </template>
                    </el-table-column>

                    <el-table-column prop="remark" label="备注"  align="center"></el-table-column>
                    

                    <el-table-column   align="center" width="180" fixed="right"  label="操作"  >
                        <template slot-scope="scope">
                            <el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-tooltip content="点击填写公告并发布" placement="right">
                            <el-button size="small" icon="plus" type="info" @click="$modal.show('add-website')" >添加</el-button>
                        </el-tooltip>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>





        <!-- / 修改公告 -->

        <Add name='add-website'
             :ajax-proxy="ajaxProxy"
             @submit-success="handleReload"/>


        <Edit name='edit-website'
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

import Website from '../../ajaxProxy/Website';
//import TableProxy from '../common/TableProxy';

export default {
    name: 'Website',
    pageTitle:"常用网址",
    mixins: [PageMix,SearchTool,DataTable,config,Website],
    components: {
        Add,
        Edit,
    },

    data () {
        return {
            ajaxProxy:Website,
            mainurl:Website.getUrl(),
            mainparam:"",
            total:100,
            dataLoad:false,
            searchForm:{
                webUrl:"",
            },

        }
    },
    methods:{
        getAjaxProxy(){
            return  this.ajaxProxy;
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
        openEdit(row){
            this.$modal.show('edit-website', {model:row});
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
