<template>
    <div>
        <el-row>
            <el-form :inline="true"  ref="searchForm" class="demo-form-inline" :model="searchForm">
                <el-form-item prop="content">
                    <el-input v-model="searchForm.content" placeholder="请输入内容关键字" size="small"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询
                    </el-button>
                    <el-button size="small" type="primary" @click="searchToolReset('searchForm')">重置</el-button>
                </el-form-item>
            </el-form>
        </el-row>
        <el-row>
            <el-col>
                <TableProxy 
                    :url="mainurl" 
                    :param="mainparam"
                    :reload="dataTableReload" :page-size="15">
                    <el-table-column label="序号" align="center" type="index" width="65"> 
                    </el-table-column>

                    <el-table-column label="姓名" prop="name" header-align="center">
                    </el-table-column>

                    <el-table-column label="电话" prop="phone" header-align="center">
                    </el-table-column>

                    <el-table-column label="内容" prop="content" header-align="center" show-overflow-tooltip>
                    </el-table-column>

                    <el-table-column label="留言时间" prop="created_at" align="center">
                    </el-table-column>

                    <el-table-column width="180" fixed="right"  label="操作" align="center">
                        <template slot-scope="scope">
                            <el-button type="success" @click="showEdit(scope.row)" size="small">查看</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)" size="small" >删除</el-button>
                            <!-- <el-button type="info"  size="small"> 导出人员 </el-button> -->
                        </template>
                    </el-table-column>

                    <div slot="buttonbar">
                        <!-- <el-button size="small" icon="plus" type="info" @click="showAdd" >添加</el-button> -->
                    </div>
                </TableProxy>
            </el-col>
        </el-row>

        <Edit 
            name="edit-connection"
            :ajax-proxy="ajaxProxy"
            @submit-success="handleReload">
        </Edit>

    </div>


</template>

<script>
    import Edit from './Edit.vue';
    import PageMix from '../../mix/Page';
   
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';

    import ConnectionAjaxProxy from '../../ajaxProxy/Connection';

    export default {
        name: 'Connection',
        pageTitle: "留言详情",
        mixins: [PageMix, SearchTool,DataTable],
        components: {
            Edit
        },
        data() {
            return {
                ajaxProxy: ConnectionAjaxProxy,
                mainurl:ConnectionAjaxProxy.getUrl(),
                mainparam:"",
                searchForm: {
                    content: "",
                },
                currentRow:null,
                tableData1: []
            }
        },
        methods: {
            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            onSearchChange(param) {
                this.mainparam = JSON.stringify(param);
            },
            // showAdd(){
            //     this.$modal.show('add-article');
            // },
            showEdit: function (row) {
                // this.currentRow = row;
                this.$modal.show('edit-connection', {model:row});
            },
        },
        created() {
            this.$on('search-tool-change', this.onSearchChange);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
