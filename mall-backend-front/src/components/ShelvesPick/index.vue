<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                    <!--<el-table :data="shelvesList" empty-text="暂无数据" border @cell-click="cellClick">-->
                        <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" @cellclick="rowCellClick" :page-size="20" >
                        <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                        <el-table-column prop="shelves_num" label="货架编号"  align="center"></el-table-column>
                        <el-table-column prop="shelves_name" label="货架名称"  align="center" :show-overflow-tooltip="true"></el-table-column>
                        <el-table-column prop="distributor_name" label="配送中心"  align="center" :show-overflow-tooltip="true"></el-table-column>
                        <el-table-column prop="shelves_manager_name" label="负责人"  align="center"></el-table-column>
                        <el-table-column prop="shelves_status" label="货架状态"  align="center">
                            <template slot-scope="scope">
                                <span v-if="scope.row.shelves_status==0">空</span>
                                <span v-if="scope.row.shelves_status==1">满</span>
                                <span v-if="scope.row.shelves_status==2">坏</span>
                            </template>
                        </el-table-column>
                        <el-table-column prop="remark" label="备注"  align="center" :show-overflow-tooltip="true"></el-table-column>
                        </TableProxy>
                    <!--</el-table>-->
                </el-tabs>
            </el-col>
        </el-row>
        <div >
            <el-button size="small"  type="info" @click="addGoodsDialog" >货架上货</el-button>
            <el-button size="small" type="info" @click="editGoodsShelves">修改货架</el-button>
            <el-button size="small" type="info" @click="goodsShelvesStatus">货架状态</el-button>
        </div>
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
                :ajax-proxy="ajaxProxy"
                :CategoryList="CategoryList"
                @add-submit="ShelvesPickData"
                @submit-success="handleReload">
        </add-goods-dialog>
        <edit-goods-shelves
                name="editGoodsShelves"
                :ajax-proxy="ajaxProxy"
                :CategoryList="CategoryList"
                @add-submit="ShelvesPickData"
                @submit-success="handleReload">
        </edit-goods-shelves>
        <goods-shelves-status
                name="goodsShelvesStatus"
                :ajax-proxy="ajaxProxy"
                @add-submit="ShelvesPickData"
                @submit-success="handleReload">
        </goods-shelves-status>
    </div>
</template>

<script>
    import addGoodsDialog from './goodsShelves.vue';
    import editGoodsShelves from './editGoodsShelves.vue';
    import goodsShelvesStatus from './goodsShelvesStatus.vue';
    import PageMix from '../../mix/Page';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import Dialog from '../common/Dialog';
    import { mapGetters } from 'vuex';

    import ShelvesPick from '../../ajaxProxy/ShelvesPick';
    import ShelvesManagement from '@/ajaxProxy/ShelvesManagement';
    import ShelvesManagementSelectProxy from '../../packages/ShelvesManagementSelectProxy';
    import SelectProxy from  '../../packages/SelectProxy';
    import ShelvesPickProxy from  '../../packages/ShelvesPickProxy';
    export default {
        name:'ShelvesPick',
        pageTitle:"货架拣货",
        mixins: [PageMix, SearchTool,DataTable,ShelvesPick],
        components: {
            addGoodsDialog,
            editGoodsShelves,
            goodsShelvesStatus,
        },
        data(){
            return {
                mainparam:'',
                mainurl:ShelvesManagement.getUrl(),
                ajaxProxy:ShelvesPick,
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
            rowCellClick(row){
                this.model=row;
                this.getShelvesPick(this.model.id)
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
            ShelvesManagement(data){
                this.shelvesList=data.items;
            },
            hasCurrentRow(){
                if (this.model) {
                    return true;
                } else {
                    return false;
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

        },
        created(){
            //获取商品类型
            let selectProxy = new SelectProxy('/tree', this.getCategoryList, this);
            selectProxy.load();
            this.getShelvesManagement();
            this.$on('search-tool-change', this.onSearchChange);
            // this.$on('add-submit',this.ShelvesPickData)

        }
    }
</script>

<style scoped>

</style>