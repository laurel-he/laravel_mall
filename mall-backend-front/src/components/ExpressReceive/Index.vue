<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="company_name">
                    <el-input v-model="searchForm.company_name" size="small" placeholder="物流公司名称"></el-input>
                </el-form-item>
                <el-form-item prop="delivery_num">
                    <el-input v-model="searchForm.delivery_num" size="small" placeholder="发货单号"></el-input>
                </el-form-item>
                <el-form-item prop="express_num">
                    <el-input v-model="searchForm.express_num" size="small" placeholder="快递单号"></el-input>
                </el-form-item>
                <el-form-item prop="start">
                    <el-date-picker
                    v-model="searchForm.start"
                    type="date"
                    placeholder="选择开始日期"
                    :picker-options="pickerOptions0" @change="setStartTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item prop="end">
                    <el-date-picker
                    v-model="searchForm.end"
                    type="date"
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
                <!-- <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload"> -->
                <el-table :data="mainData" border highlight-current-row style="width: 100%">
                    <el-table-column label="序号" align="center"  type="index" width="65">
                    </el-table-column>

                    <el-table-column prop="company_name" label="物流名称" align="center">
                    </el-table-column>

                    <el-table-column prop="check_time" label="发货核对时间" align="center">
                    </el-table-column>

                    <el-table-column prop="delivery_num" label="发货单号" align="center">
                    </el-table-column>

                    <el-table-column prop="express_num" label="快递单号" align="center">
                    </el-table-column>

                    <el-table-column prop="check_name" label="核对人" align="center">
                    </el-table-column>

                    <!-- <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                            <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column> -->

                    <!-- <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="showAdd">添加</el-button>
                    </div> -->
                </el-table>
                <!-- </TableProxy> -->
            </el-col>
        </el-row>
        <el-row >
            <el-col :span="12">
                <!-- <el-button type="primary" size="small" @click="showAdd">添加</el-button>          -->
            </el-col>
            <el-col :span="12" :offset="12">
                <div class="pull-right">
                    <el-pagination
                        :current-page="currentPage"
                        :page-size="pageSize"
                        layout="total, prev, pager, next, jumper"
                        :total="total">
                    </el-pagination>   
                </div>
            </el-col>
        </el-row>
    </div>
</template>
<script>
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';
export default {
    name: 'ExpressReceive',
    pageTitle:"物流揽收",
    mixins:[PageMix,SearchTool,DataTable],
    components:{

    },
    data(){
        return {
            mainparam:"",
            mainurl:'',
            ajaxProxy:'',
            searchForm:{
                company_name:'',
                express_num:'',
                start:'',
                end:'',
            },
            mainData:[
                {company_name:'顺丰',check_time:'2018-03-09',delivery_num:'201803091408',express_num:'201803091409',check_name:'李富强'},
                {company_name:'顺丰',check_time:'2018-03-09',delivery_num:'201803091408',express_num:'201803091409',check_name:'李富强'},
                {company_name:'顺丰',check_time:'2018-03-09',delivery_num:'201803091408',express_num:'201803091409',check_name:'李富强'},
            ],
            currentPage:1,
            pageSize:10,
            total:100,
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
        }
    },
    methods:{
        setStartTime(v){
            this.searchForm.start = v;
        },
        setEndTime(v){
            this.searchForm.end = v;
        },
    },
    created(){

    },
    mounted(){

    },
    
}
</script>
<style scoped>

</style>

