<template>
    <div>
        <el-row>
            <el-form :inline="true"  ref="searchForm" :model="searchForm" class="search-bar">
                <el-form-item prop="contact_phone" style="width: 120px">
                    <el-input v-model="searchForm.contact_phone" size="small" placeholder="输入联系电话">
                    </el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" size="small" @click="searchToolChange('searchForm')" icon="search">查询</el-button>
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
                    <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>

                    <el-table-column label="问题一" prop="problem_one"  ></el-table-column>
                    <el-table-column label="问题二" prop="problem_two"  ></el-table-column>
                    <el-table-column label="问题三" prop="problem_three"  ></el-table-column>
                    <el-table-column label="问题四" prop="problem_four"  ></el-table-column>
                    <el-table-column label="问题五" prop="problem_five"  ></el-table-column>
                    <el-table-column label="提交人联系方式" prop="contact_phone"></el-table-column>

                    <!--<el-table-column   align="center" width="180" fixed="right"  label="操作"  >-->
                        <!--<template slot-scope="scope">-->
                            <!--<el-button type="success" @click="openEdit(scope.row)"     size="small">编辑</el-button>-->
                            <!--<el-button type="danger"  @click="handleDelete(scope.row.id)"   size="small" >删除</el-button>-->
                        <!--</template>-->
                    <!--</el-table-column>-->
                    <!--<div slot="buttonbar">-->
                        <!--<el-button size="small" icon="plus" type="info"  >添加</el-button>-->
                    <!--</div>-->
                </TableProxy>
            </el-col>
        </el-row>

    </div>


</template>

<script>
    import Add from './Add.vue';
    import Edit from './Edit.vue';
    import PageMix from '../../mix/Page';
   
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';

    import SkinCareInfo from '../../ajaxProxy/SkinCareInfo';

    export default {
        name: 'SkinCareInfo',
        pageTitle: "资讯详情",
        mixins: [PageMix, SearchTool,DataTable],
        components: {
            Add,
            Edit
        },
        data() {
            return {
                mainurl:SkinCareInfo.getUrl(),
                mainparam:"",
                currentRow:null,
                searchForm:{
                    contact_phone:""
                }
            }
        },
        watch:{
            addDialog(val, oldVal){
                console.log('index addDialog', val);
            }
        },
        methods: {

            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            openEdit: function (row) {
                // this.currentRow = row;
                this.$modal.show('edit-article', {model:row});
            },

            onSearchChange(param) {
                this.mainparam = JSON.stringify(param);
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
