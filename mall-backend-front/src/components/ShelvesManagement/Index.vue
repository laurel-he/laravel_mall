<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="shelves_num">
                    <el-input v-model="searchForm.shelves_num" size="small" placeholder="货架编号"></el-input>
                </el-form-item>
                <el-form-item prop="shelves_name">
                    <el-input v-model="searchForm.shelves_name" size="small" placeholder="货架名称"></el-input>
                </el-form-item>
                <el-form-item prop="distributor_id">
                    <el-select v-model="searchForm.distributor_id" size="small" placeholder="配送中心">
                        <el-option v-for=" v in distributors" :value="v.id" :key="v.id" :label="v.name"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item prop="shelves_manager_id">
                    <el-select v-model="searchForm.shelves_manager_id" size="small" placeholder="请选择负责人" >
                        <el-option v-for="v in managers" :label="v.name" :value="v.id" :key="v.id"></el-option>
                    </el-select>
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
                 <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload">

                    <el-table-column label="ID" align="center" prop="id">
                    </el-table-column>

                    <el-table-column prop="shelves_num" label="货架编号" align="center">
                    </el-table-column>

                    <el-table-column prop="shelves_name" label="货架名称" align="center">
                    </el-table-column>

                    <el-table-column prop="distributor_name" label="所属配送中心" align="center">
                    </el-table-column>

                    <el-table-column prop="shelves_manager_name" label="货架负责人" align="center">
                    </el-table-column>

                     <el-table-column prop="remark" label="备注" align="center">
                     </el-table-column>
                    <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                            <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column>

                 <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="showAdd">添加</el-button>
                    </div>

                 </TableProxy>
            </el-col>
        </el-row>

        <add-dialog
                name="add"
                :ajax-proxy="ajaxProxy"
                :distributors="distributors"
                :managers="managers"
                @submit-success="handleReload">
        </add-dialog>
        <edit-dialog
                name="edit"
                :ajax-proxy="ajaxProxy"
                :distributors="distributors"
                :managers="managers"
                @submit-success="handleReload">
        </edit-dialog>


    </div>
</template>
<script>
import addDialog from './add.vue';
import editDialog from './edit.vue';
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';
import ShelvesManagement from '../../ajaxProxy/ShelvesManagement';
import DistributionCenterProxy from '../../packages/DistributionCenterSelectProxy';
export default {
    name: 'ShelvesManagement',
    pageTitle:"货架管理",
    mixins:[PageMix,SearchTool,DataTable,ShelvesManagement],
    components:{
        addDialog,
        editDialog
    },
    data(){
        return {
            mainparam:"",
            mainurl:ShelvesManagement.getUrl(),
            ajaxProxy:ShelvesManagement,
            distributors:[],
            managers:[
                {id:1,name:'张三'},
                {id:2,name:'李四'},
                {id:3,name:'王五'},
            ],
            searchForm:{
                shelves_num:'',
                shelves_name:'',
                distributor_id:'',
                shelves_manager_id:'',
            },
        }
    },
    methods:{
        onSearchChange(param){
            this.mainparam = JSON.stringify(param);
        },
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        showAdd(){
            this.$modal.show('add');
        },
        showEdit(row){
            this.$modal.show('edit',{model:row});
        },
        getDistributionCenter(data){
            this.distributors = data.items;
        },

    },
    created(){
        let DistributionCenterSelect = new DistributionCenterProxy({}, this.getDistributionCenter, this);
        DistributionCenterSelect.load();
        this.$on('search-tool-change', this.onSearchChange);
    },
    mounted(){

    },
    
}
</script>
<style scoped>

</style>

