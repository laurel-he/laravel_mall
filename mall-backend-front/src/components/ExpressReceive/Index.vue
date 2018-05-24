<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="express_id" class="form-item-unique">
                    <el-select v-model="searchForm.express_id" size="small" placeholder="物流公司">
                        <el-option v-for="v in companys" :value="v.id" :key="v.id" :label="v.company_name">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item prop="assign_sn" class="form-item-unique">
                    <el-input v-model="searchForm.assign_sn" size="small" placeholder="发货单号"></el-input>
                </el-form-item>
                <el-form-item prop="express_sn" class="form-item-unique">
                    <el-input v-model="searchForm.express_sn" size="small" placeholder="快递单号"></el-input>
                </el-form-item>
                <el-form-item prop="start">
                    <el-date-picker
                    v-model="searchForm.start"
                    type="date"
                    size="small"
                    placeholder="选择开始日期"
                    :picker-options="pickerOptions0" @change="setStartTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item prop="end">
                    <el-date-picker
                    v-model="searchForm.end"
                    type="date"
                    size="small"
                    placeholder="选择结束日期"
                    :picker-options="pickerOptions1" @change="setEndTime">
                    </el-date-picker>
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
                 <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size="15" :bubble="buble">
                    <el-table-column label="序号" align="center"  type="index" width="65">
                    </el-table-column>

                    <el-table-column prop="express_name" label="物流名称" align="center">
                    </el-table-column>

                    <el-table-column prop="assign_sn" label="发货单号" align="center">
                    </el-table-column>

                    <el-table-column prop="express_sn" label="快递单号" align="center">
                    </el-table-column>

                    <el-table-column prop="check_user_name" label="核对人" align="center">
                    </el-table-column>

                     <el-table-column prop="assign_check_time" label="发货核对时间" align="center">
                     </el-table-column>

                   <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                            <!--<el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>-->
                        </template>
                    </el-table-column>

                     <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="showAdd">添加</el-button>
                    </div>
                 </TableProxy>
            </el-col>
        </el-row>
        <br>
        <SubDetail :row="currentRow"></SubDetail>
        <add-dialog
                name="add"
                :ajax-proxy="ajaxProxy"
                :companys="companys"
                @submit-success="handleReload">
        </add-dialog>

        <edit-dialog
                name="edit"
                :ajax-proxy="ajaxProxy"
                :companys="companys"
                @submit-success="handleReload">
        </edit-dialog>

    </div>
</template>
<script>
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';

import addDialog from './add.vue';
import editDialog from './edit.vue';
import SubDetail from './SubDetail.vue';
import ExpressReceiveAjaxProxy from '../../ajaxProxy/ExpressReceive';

import ExpressCompanySelectProxy from '../../packages/ExpressCompanySelectProxy';
export default {
    name: 'ExpressReceive',
    pageTitle:"物流揽收",
    mixins:[PageMix,SearchTool,DataTable],
    components:{
        addDialog,
        editDialog,
        SubDetail
    },
    data(){
        return {
            mainparam:"",
            mainurl:ExpressReceiveAjaxProxy.getUrl(),
            ajaxProxy:ExpressReceiveAjaxProxy,
            searchForm:{
                logistics_name:'',
                assign_sn:'',
                express_sn:'',
                start:'',
                end:'',
            },
            companys:[],
            pickerOptions0: {
                disabledDate(time) {
                    return time.getTime() > Date.now();//- 8.64e7
                }
            },
            pickerOptions1: {
                disabledDate(time) {
                    return time.getTime() < Date.now()- 8.64e7;//
                }
            },
            buble:null,
            currentRow:null
        }
    },
    methods:{
        showAdd(){
            this.$modal.show('add');
        },
        showEdit(row){
            this.$modal.show('edit',{model:row});
        },
        setStartTime(v){
            this.searchForm.start = v + ' ' + '00:00:00';
        },
        setEndTime(v){
            this.searchForm.end = v + ' ' + '00:00:00';
        },
        onSearchChange(param){
            this.mainparam = JSON.stringify(param);
        },
        getExpressCompanySelect(data){
            this.companys = data.items;
        },
        onDbRow(row){
            this.currentRow = row;
        }
    },
    created(){
        //获取物流公司数据
        let ExpressCompanySelect = new ExpressCompanySelectProxy({}, this.getExpressCompanySelect, this);
        ExpressCompanySelect.load();

        let o = {
            'row-dblclick': this.onDbRow
        };
        this.buble = o;
    },
    mounted(){
        this.$on('search-tool-change', this.onSearchChange);
    },
    
}
</script>
<style scoped>
    .form-item-unique{
        width: 140px !important;
    }
</style>

