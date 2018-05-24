<template>
    <div>
        <el-row>
            <el-form :inline="true"  ref="searchForm" class="demo-form-inline" :model="searchForm">
                <el-form-item prop="title">
                    <el-input v-model="searchForm.title" placeholder="请输入标题关键字" size="small"></el-input>
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
                    @row-dblclick="doubleClick"
                    :reload="dataTableReload" :page-size="15">
                    <el-table-column label="序号" align="center" type="index" width="65"> 
                    </el-table-column>

                    <el-table-column label="标题" prop="title" header-align="center">
                    </el-table-column>

                    <el-table-column label="图片" prop="image" header-align="center">
                        <template slot-scope="scope">
                            <img :src="scope.row.image" v-show="scope.row.image" width="50" height="50" alt="">
                        </template>
                    </el-table-column>

                    <el-table-column label="发布时间" prop="created_at" header-align="center">
                    </el-table-column>

                    <el-table-column label="更新时间" prop="updated_at" header-align="center">
                    </el-table-column>

                    <el-table-column width="180" fixed="right"  label="操作" align="center">
                        <template slot-scope="scope">
                            <el-button type="success" @click="showEdit(scope.row)" size="small">编辑</el-button>
                            <el-button type="danger"  @click="handleDelete(scope.row.id)" size="small" >删除</el-button>
                            <!-- <el-button type="info"  size="small"> 导出人员 </el-button> -->
                        </template>
                    </el-table-column>

                    <div slot="buttonbar">
                        <el-button size="small" icon="plus" type="info" @click="showAdd" >添加</el-button>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>
   
        <Add 
            name="add-article"
            :ajax-proxy="ajaxProxy"
            @submit-success="handleReload">
        </Add>

        <Edit 
            name="edit-article"
            :ajax-proxy="ajaxProxy"
            @submit-success="handleReload">
        </Edit>

    </div>


</template>

<script>
    import Add from './Add.vue';
    import Edit from './Edit.vue';
    import PageMix from '../../mix/Page';
   
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';

    import ArticleAjaxProxy from '../../ajaxProxy/Article';

    export default {
        name: 'Articles',
        pageTitle: "最新资讯",
        mixins: [PageMix, SearchTool,DataTable],
        components: {
            Add,
            Edit
        },
        data() {
            return {
                ajaxProxy: ArticleAjaxProxy,
                mainurl:ArticleAjaxProxy,
                mainparam:"",
                searchForm: {
                    title: "",
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
            showAdd(){
                this.$modal.show('add-article');
            },
            showEdit: function (row) {
                // this.currentRow = row;
                this.$modal.show('edit-article', {model:row});
            },
            doubleClick(row, event){
                console.log(row);
            }
        },
        created() {
            this.$on('search-tool-change', this.onSearchChange);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
