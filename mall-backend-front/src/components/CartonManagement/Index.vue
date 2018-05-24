<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="carton_name">
                    <el-input v-model="searchForm.carton_name" size="small" placeholder="纸箱类型"></el-input>
                </el-form-item>
                <el-form-item prop="carton_model">
                    <el-input v-model="searchForm.carton_model" size="small" placeholder="纸箱型号"></el-input>
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

                    <el-table-column label="ID" align="center"  prop="id" width="65">
                    </el-table-column>

                    <el-table-column prop="carton_name" label="纸箱类型" align="center">
                    </el-table-column>

                    <el-table-column prop="carton_model" label="纸箱型号" align="center">
                    </el-table-column>

                    <el-table-column prop="carton_long" label="纸箱长度(mm)" align="center">
                    </el-table-column>

                    <el-table-column prop="carton_wide" label="纸箱宽度(mm)" align="center">
                    </el-table-column>

                     <el-table-column prop="carton_high" label="纸箱高度(mm)" align="center">
                    </el-table-column>

                     <el-table-column prop="carton_weight" label="纸箱重量(g)" align="center">
                    </el-table-column>

                     <el-table-column prop="carton_number" label="纸箱数量" align="center">
                    </el-table-column>

                    <el-table-column prop="remark" label="备注" align="center" :show-overflow-tooltip="true">
                    </el-table-column>

                    <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                            <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column>

                   <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="showAdd">添加</el-button>
                        <el-button type="primary" size="small" @click="showVolumeRatio">设置商品与纸箱比例</el-button>
                    </div>

                 </TableProxy>
            </el-col>
        </el-row>

        <!-- 写弹窗组件 -->
        <Add name='add-carton-company'
            :ajax-proxy="ajaxProxy"
             @submit-success="handleReload">
        </Add>
        <VolumeRatio name='add-volume-ratio'
            :ajax-proxy="volumeAjaxProxy"
             @submit-success="handleReload"
             @onClose="onClose">
        </VolumeRatio>

        <Edit name='edit-carton-company'
            :ajax-proxy="ajaxProxy"
            @submit-success="handleReload">
        </Edit>
    </div>
</template>
<script>
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';
import config from '../../mix/Delete';
import CartonManagementAjaxProxy from '../../ajaxProxy/CartonManagement';
import VolumeRatioAjaxProxy from '../../ajaxProxy/VolumeRatio';
import VolumeRatioSelectProxy from '../../packages/VolumeRatioSelectProxy';

import Add from './Add';
import Edit from './Edit';
import VolumeRatio from './VolumeRatio';
export default {
    name: 'CartonManagement',
    pageTitle:"纸箱管理",
    mixins:[PageMix,SearchTool,DataTable,config,CartonManagementAjaxProxy],
    components:{
        Add,
        Edit,
        VolumeRatio,
    },
    data(){
        return {
            mainparam:"",
            volumeRatio:"",
            mainurl:CartonManagementAjaxProxy.getUrl(),
            ajaxProxy:CartonManagementAjaxProxy,
            volumeAjaxProxy:VolumeRatioAjaxProxy,
            searchForm:{
                carton_name:'',
                carton_model:'',
            },
        }
    },
    methods:{
        onSearchChange(param){
            this.mainparam = JSON.stringify(param);
        },
        showAdd(){
            this.$modal.show('add-carton-company');
        },
        showVolumeRatio(){
            // this.loadVolumeRatioAjax();
            this.$modal.show('add-volume-ratio',{model:this.volumeRatio});
        },
        showEdit(row){
            this.$modal.show('edit-carton-company',{model:row});
        },
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        onClose(){
            this.loadVolumeRatioAjax();
        },
        loadVolumeRatio(data){
            this.volumeRatio = data.items;
        },
        loadVolumeRatioAjax(){
            let volumeRatioProxy = new VolumeRatioSelectProxy(null, this.loadVolumeRatio, this);
            this.volumeRatioProxy = volumeRatioProxy;
            this.volumeRatioProxy.load();
        },
    },
    created(){
        this.loadVolumeRatioAjax();
        this.$on('search-tool-change', this.onSearchChange);
    },
    mounted(){

    },
    
}
</script>
<style scoped>

</style>

