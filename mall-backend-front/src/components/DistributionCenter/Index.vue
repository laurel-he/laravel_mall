<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="name">
                    <el-input v-model="searchForm.name" size="small" placeholder="名称"></el-input>
                </el-form-item>
                <el-form-item prop="contact">
                    <el-input v-model="searchForm.contact" size="small" placeholder="联系人"></el-input>
                </el-form-item>
                <el-form-item prop="contact_phone">
                    <el-input v-model="searchForm.contact_phone" size="small" placeholder="联系方式"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                    <el-button type="primary" size="small" @click="searchToolReset('searchForm')">重置</el-button>
                    <!-- <el-button type="primary" size="small" @click="refreshTable">刷新</el-button> -->
                </el-form-item>
            </el-form>
        </el-row>
        <el-row>
            <el-col>
                 <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size="15">
                    <el-table-column type="index" width="80" label="序号"></el-table-column>
                    <!-- <el-table-column label="ID" align="center" prop="id"></el-table-column> -->

                    <el-table-column prop="name" label="名称" align="center"></el-table-column>

                    <el-table-column prop="eng_name" label="英文简称" align="center"></el-table-column>

                    <el-table-column prop="contact" label="联系人" align="center"></el-table-column>

                    <el-table-column prop="contact_phone" label="联系方式" align="center"></el-table-column>

                    <el-table-column prop="address" label="地址" align="center" :show-overflow-tooltip="true"></el-table-column>

                    <el-table-column prop="comment" label="备注" align="center" :show-overflow-tooltip="true"></el-table-column>

                    <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                            <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column>

                   <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="add">添加</el-button>
                    </div>

                 </TableProxy>
            </el-col>
        </el-row>

        <add-dialog
                name="add"
                :ajax-proxy="ajaxProxy"
                @submit-success="handleReload">
        </add-dialog>
        <edit-dialog
                name="edit"
                :ajax-proxy="ajaxProxy"
                @submit-success="handleReload">
        </edit-dialog>

    </div>
</template>
<script>
import addDialog from './add.vue';
import editDialog from './edit.vue';
import config from '../../mix/Delete';
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';
import { mapGetters } from 'vuex';
// import Dialog from '../common/Dialog';
import DistributionCenterAjaxProxy from '../../ajaxProxy/DistributionCenter';
export default {
    name: 'DistributionCenter',
    pageTitle:"配送中心",
    mixins:[PageMix,SearchTool,config,DataTable,DistributionCenterAjaxProxy],
    components:{
        addDialog,
        editDialog,
    },
    data(){
        return {
            mainparam:"",
            mainurl:DistributionCenterAjaxProxy.getUrl(),
            ajaxProxy:DistributionCenterAjaxProxy,
            searchForm:{
                name:'',
                contact:'',
                contact_phone:'',
            },
        }
    },
    methods:{
        add(){
            this.$modal.show('add');
        },
        showEdit(row){
            this.$modal.show('edit',{model:row});
        },
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        onSearchChange(param){
            this.mainparam = JSON.stringify(param);
        },

    },
    created(){
        this.$on('search-tool-change', this.onSearchChange);
    },
    mounted(){

    },
    
}
</script>
<style scoped>

</style>

