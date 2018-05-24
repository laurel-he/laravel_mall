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
                <!--<el-form-item prop="shelves_manager_id">-->
                    <!--<el-select v-model="searchForm.shelves_manager_id" size="small" placeholder="请选择负责人" >-->
                        <!--<el-option v-for="v in managers" :label="v.name" :value="v.id" :key="v.id"></el-option>-->
                    <!--</el-select>-->
                <!--</el-form-item>-->
                <el-form-item>
                    <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                    <el-button type="primary" size="small" @click="searchToolReset('searchForm')">重置</el-button>
                    <!-- <el-button type="primary" size="small" @click="refreshTable">刷新</el-button> -->
                </el-form-item>
            </el-form>
        </el-row>
        <el-row>
            <el-col>
                 <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" @cellclick="rowCellClick" :page-size="20" >

                    <el-table-column label="ID" align="center" prop="id">
                    </el-table-column>

                    <el-table-column prop="shelves_num" label="货架编号" align="center" :show-overflow-tooltip="true">
                    </el-table-column>

                    <el-table-column prop="shelves_name" label="货架名称" align="center" :show-overflow-tooltip="true">
                    </el-table-column>

                    <el-table-column prop="distributor_name" label="所属配送中心" align="center">
                    </el-table-column>

                    <el-table-column prop="shelves_manager_name" label="货架负责人" align="center">
                    </el-table-column>

                     <el-table-column prop="shelves_status" label="货架状态"  align="center">
                         <template slot-scope="scope">
                             <span v-if="scope.row.shelves_status==0">空</span>
                             <span v-if="scope.row.shelves_status==1">满</span>
                             <span v-if="scope.row.shelves_status==2">坏</span>
                         </template>
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
                        <el-button type="primary" size="small" @click="showAdd">添加货架</el-button>
                     <el-button size="small"  type="primary" @click="addGoodsDialog" >货架上货</el-button>
                     <el-button size="small" type="primary" @click="editGoodsShelves">修改货架</el-button>
                     <el-button size="small" type="primary" @click="goodsShelvesStatus">货架状态</el-button>

                    </div>

                 </TableProxy>
            </el-col>
        </el-row>

        <br>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                    <el-tab-pane label="货架明细">
                        <!--<TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size="20" >-->
                        <el-table :data="shelvesGoodsList" empty-text="暂无数据" border >
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <el-table-column prop="cate_type" label="商品类型" width="180" align="center"></el-table-column>
                            <el-table-column prop="cate_kind" label="商品品种" width="180" align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                            <el-table-column prop="goods_num" label="数量" align="center"></el-table-column>
                            <el-table-column prop="sku_sn" label="商品编号" align="center"></el-table-column>
                            <el-table-column prop="remarks" label="备注" align="center" :show-overflow-tooltip="true"></el-table-column>
                        </el-table>
                        <!--</TableProxy>-->
                    </el-tab-pane>
                </el-tabs>
            </el-col>
        </el-row>

        <add-goods-dialog
                name="addGoodsDialog"
                :ajax-proxy="shelvesPickAjaxProxy"
                :CategoryList="CategoryList"
                @add-submit="ShelvesPickData"
                @submit-success="handleReload">
        </add-goods-dialog>
        <edit-goods-shelves
                name="editGoodsShelves"
                :ajax-proxy="shelvesPickAjaxProxy"
                :CategoryList="CategoryList"
                @add-submit="ShelvesPickData"
                @submit-success="handleReload">
        </edit-goods-shelves>
        <goods-shelves-status
                name="goodsShelvesStatus"
                :ajax-proxy="shelvesPickAjaxProxy"
                @add-submit="ShelvesPickData"
                @submit-success="handleReload">
        </goods-shelves-status>




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
import addGoodsDialog from './goodsShelves.vue';
import editGoodsShelves from './editGoodsShelves.vue';
import goodsShelvesStatus from './goodsShelvesStatus.vue';
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';
import ShelvesManagement from '../../ajaxProxy/ShelvesManagement';
import ShelvesPick from '../../ajaxProxy/ShelvesPick';
import DistributionCenterProxy from '../../packages/DistributionCenterSelectProxy';
import ShelvesManagementSelectProxy from '../../packages/ShelvesManagementSelectProxy';
import SelectProxy from  '../../packages/SelectProxy';
import ShelvesPickProxy from  '../../packages/ShelvesPickProxy';
export default {
    name: 'ShelvesManagement',
    pageTitle:"货架管理",
    mixins:[PageMix,SearchTool,DataTable,ShelvesManagement,ShelvesPick],
    components:{
        addDialog,
        editDialog,
        addGoodsDialog,
        editGoodsShelves,
        goodsShelvesStatus,
    },
    data(){
        return {
            mainparam:"",
            mainurl:ShelvesManagement.getUrl(),
            ajaxProxy:ShelvesManagement,
            shelvesPickAjaxProxy:ShelvesPick,
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
            shelvesList:[],
            shelvesGoodsList:[],
            CategoryList:[],
            model:null,
        }
    },
    methods:{
        addGoodsDialog(){
            if (this.openDialogCheck()) {
                this.$modal.show('addGoodsDialog', {model: this.model});
            }
        },
        editGoodsShelves(){
            if (this.openDialogCheck()) {
                this.$modal.show('editGoodsShelves',{model:this.model});
            }
        },
        goodsShelvesStatus(){
            if (this.openDialogCheck()) {
                this.$modal.show('goodsShelvesStatus', {model: this.model});
            }
        },
        openDialogCheck(){
            if (!this.hasCurrentRow()) {
                this.$alert('请选择一行', '警告', {
                    confirmButtonText: '确定',
                })
                return false;
            } else {
                return true;
            }
        },
        hasCurrentRow(){
            if (this.model) {
                return true;
            } else {
                return false;
            }
        },
        rowCellClick(row){
            this.model=row;
            this.getShelvesPick(this.model.id)
        },
        getCategoryList(data){
            this.CategoryList=data.items;
        },
        ShelvesPickData(data){
            this.shelvesGoodsList=data.items;
        },
        getShelvesManagement(){
            //获取货架数据信息
            let ShelvesManagementSelect = new ShelvesManagementSelectProxy({}, this.ShelvesManagement, this);
            ShelvesManagementSelect.load();
        },
        getShelvesPick(id){
            //获取货架商品明细数据信息
            // let data ={shelves_id:id};
            // this.ajaxProxy.get(data);
            let ShelvesPickProxySelect = new ShelvesPickProxy({shelves_id:id}, this.ShelvesPickData, this);
            ShelvesPickProxySelect.load();
        },







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
        let selectProxy = new SelectProxy('/tree', this.getCategoryList, this);
        selectProxy.load();
        this.getShelvesManagement();



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

