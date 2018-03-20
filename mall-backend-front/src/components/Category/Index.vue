<template>
    <!--<el-tree :data="data" :props="defaultProps" ></el-tree>-->
    <div>
        <el-row>
            <el-form>
                <el-form-item>
                    <el-input v-model="type_name" placeholder="输入关键字进行过滤" style="width: 300px"></el-input>
                </el-form-item>
            </el-form>
            </el-row>
        <el-row>
            <el-col :span="12">
                <el-tree
                        class="filter-tree"
                        :data="data"
                        :props="defaultProps"
                        default-expand-all
                        node-key="id"
                        :expand-on-click-node="false"
                        :filter-node-method="filterNode"
                        ref="tree"
                        :render-content="renderContent"
                       >
                </el-tree>
                <el-button type="primary" size="small" @click="$modal.show('add-category')">添加分类</el-button>
            </el-col>


        <addDialog name='add-category'
                   :ajax-proxy="ajaxProxy"
                   @submit-success="handleReload"/>

        <editDialog name='edit-category'
                    :ajax-proxy="ajaxProxy"
                    @submit-success="handleReload"/>

        </el-row>

        <addSub name='add-subcategory'
                   :ajax-proxy="ajaxProxy"
                   @submit-success="handleReload"/>
    </div>

</template>

<script>
    import addDialog from './addDialog';
    import editDialog from './editDialog';
    import addSub from './addSub';

    import DataTable from '../../mix/DataTable';

    import PageMix from '../../mix/Page';
    import config from '../../mix/Delete';
    import DataProxy from '../../packages/DataProxy';
    import SearchTool from '../../mix/SearchTool';
    import SelectProxy from  '../../packages/SelectProxy';
    import Category from '../../ajaxProxy/Category';
    import TableProxy from '../common/TableProxy';
    export default {

        name: 'Category',
        pageTitle:"商品分类",
        components: {
            addDialog,
            editDialog,
            addSub
        },
        mixins: [PageMix,SearchTool,DataTable,config,Category],
        data() {
            return {
                ajaxProxy:Category,
                addDialog:false,
                editDialog:false,
                url:'/categorys',
                categoryId:'',
                type_name:'',
                data:[],
                defaultProps: {
                    children:'children',
                    label:'label'
                },

           
            }
        },
        methods: {
            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            deleteData(id){
                this.categoryId=id;
                let categoryProxy = new DataProxy('/deleteCategory/'+id, this.pageSize, this.deleteCategory, this,);
                 categoryProxy.load();

            },
            deleteCategory(data){
                // if(data.items){
                //     this.$message.error("该分类还有子类不能删除！！！");
                //     return false;
                // }else{
                   
                // }

                 this.handleDelete(this.categoryId);
            },
            handleReload(){
                this.getRes();
            },
            dataLoaded(data){
                 this.data = data.items;
            },

            editFun(data){
                this.$modal.show('edit-category',{model:data})
            },
            addSub(data){
                this.$modal.show('add-subcategory', {parent: data});
            },
            getRes:function(){
                let categoryProxy = new DataProxy(this.url, this.pageSize, this.dataLoaded, this,);
                 categoryProxy.load();

            },

            filterNode(value, data) {
                if (!value) return true;
                return data.label.indexOf(value) !== -1;
            },    

            onSearchChange(param){
                console.log(param);
            },

            renderContent(h, { node, data, store }) {

                return (
                    <span>
                    <span>
                    <span>{node.label}</span>
                   </span>
                <span style="float: right; margin-right: 20px">
                    <el-button size="mini" type="success" on-click={ () => this.editFun(data) }>编 辑</el-button>
                    <el-button size="mini" disabled={node.level>=3}   type="success" on-click={ () => this.addSub(data) }> 添加子类 </el-button>
                    <el-button size="mini" type="danger" on-click={ () => this.deleteData(data.id) }>删除分类</el-button>
                </span>
                </span>);
            }
        },
        watch: {
            type_name(val) {
                this.$refs.tree.filter(val);
            }
        },
        created(){
           this.getRes();

        }


    }
</script>

<style scoped>

</style>
