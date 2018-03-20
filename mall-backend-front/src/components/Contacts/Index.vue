<template>
    <div class="hello">
        <el-row>
            <el-col :span="12">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" class="search-bar">
                    <el-form-item prop="name" style="width: 140px">
                        <el-input type="text" size="small" v-model="searchForm.name" placeholder="请输入联系人姓名"></el-input>
                    </el-form-item>
                    <el-form-item prop="phone" style="width: 140px">
                        <el-input type="text" size="small" v-model="searchForm.phone" placeholder="请输入联系人手机号"></el-input>
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

                    <el-table-column prop="name" label="联系人姓名" align="center"></el-table-column>

                    <el-table-column label="与本人关系"  prop="relationship_id" align="center">
                        <template slot-scope="scope">
                            <span v-if="scope.row.relationship_id==1">父子(女)</span>
                            <span v-if="scope.row.relationship_id==2">母子(女)</span>
                            <span v-if="scope.row.relationship_id==3">兄弟(姐妹)</span>
                            <span v-if="scope.row.relationship_id==4">朋友</span>
                            <span v-if="scope.row.relationship_id==5">其他</span>
                        </template>
                    </el-table-column>

                    <el-table-column prop="phone" label="联系人电话" align="center"></el-table-column>

                    <el-table-column prop="qq" label="联系人QQ"  align="center"></el-table-column>
                    
                    <el-table-column prop="weixin" label="联系人微信"  align="center"></el-table-column>

                    <el-table-column   align="center" width="180" fixed="right"  label="操作"  >
                        <template slot-scope="scope">
                            <el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>
                        </template>
                    </el-table-column>
                    <div slot="buttonbar">
                        <el-tooltip content="点击填写公告并发布" placement="right">
                            <el-button size="small" icon="plus" type="info" @click="$modal.show('add-contacts')" >添加</el-button>
                        </el-tooltip>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>





        <!-- / 修改公告 -->

        <Add name='add-contacts'
             :ajax-proxy="ajaxProxy"
             @submit-success="handleReload"/>


        <Edit name='edit-contacts'
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

import Contacts from '../../ajaxProxy/Contacts';
//import TableProxy from '../common/TableProxy';

export default {
    name: 'Contacts',
    pageTitle:"重要联系人",
    mixins: [PageMix,SearchTool,DataTable,config,Contacts],
    components: {
        Add,
        Edit,
    },

    data () {
        return {
            ajaxProxy:Contacts,
            mainurl:Contacts.getUrl(),
            mainparam:"",
            total:100,
            dataLoad:false,
            searchForm:{
                name:"",
                phone:"",
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
        
        openEdit(row){
            this.$modal.show('edit-contacts', {model:row});
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
