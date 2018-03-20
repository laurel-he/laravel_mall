<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                    <el-table :data="dataList" empty-text="暂无数据" border>
                        <el-table-column label="序号" align="center" type="index" ></el-table-column>
                        <el-table-column prop="distribution_name" label="配送中心"  align="center"></el-table-column>
                        <el-table-column prop="shelves_number" label="货架编号"  align="center"></el-table-column>
                        <el-table-column prop="master" label="负责人"  align="center"></el-table-column>
                        <el-table-column prop="shelves_status" label="货架状态"  align="center"></el-table-column>
                        <el-table-column prop="remarks" label="备注"  align="center"></el-table-column>
                    </el-table>
                </el-tabs>
            </el-col>
        </el-row>
        <br>
        <div >
            <!-- <el-button size="small"  type="info" @click="addGoodsDialog" >货架拣货</el-button> -->
            <el-button size="small"  type="info" @click="addGoodsDialog" >货架上货</el-button>
            <el-button size="small" type="info" @click="editGoodsShelves">修改货架</el-button>
            <el-button size="small" type="info" @click="goodsShelvesStatus">货架状态</el-button>
        </div>
        <br>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                    <el-tab-pane label="货架明细">
                        <el-table :data="productionListData" empty-text="暂无数据" border>
                            <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                            <el-table-column prop="goods_type" label="商品类型" width="180" align="center"></el-table-column>
                            <el-table-column prop="production_name" label="商品品种" width="180" align="center"></el-table-column>
                            <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                            <el-table-column prop="number" label="数量" align="center"></el-table-column>
                            <el-table-column prop="production_number" label="商品编号" align="center"></el-table-column>
                            <el-table-column prop="remarks" label="备注" align="center"></el-table-column>
                        </el-table>
                    </el-tab-pane>
                </el-tabs>
            </el-col>
        </el-row>



        <add-goods-dialog
                name="addGoodsDialog"
                @submit-success="handleReload">
        </add-goods-dialog>
        <edit-goods-shelves
                name="editGoodsShelves"
                @submit-success="handleReload">
        </edit-goods-shelves>
        <goods-shelves-status
                name="goodsShelvesStatus"
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
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    export default {
        name:'ShelvesPick',
        pageTitle:"货架拣货",
        mixins: [PageMix, SearchTool,DataTable],
        components: {
            addGoodsDialog,
            editGoodsShelves,
            goodsShelvesStatus,

        },
        data(){
            return {
                dataList:[
                    {   distribution_name:'成都很快公司',
                        shelves_number:'21354',
                        master:'王小虎',
                        shelves_status:'满',
                        remarks:'正常',
                    },{   distribution_name:'成都很快公司',
                        shelves_number:'21354',
                        master:'王小虎',
                        shelves_status:'满',
                        remarks:'正常',
                    },{   distribution_name:'成都很快公司',
                        shelves_number:'21354',
                        master:'王小虎',
                        shelves_status:'满',
                        remarks:'正常',
                    },

                ],
                productionListData: [
                    {
                        goods_type:'护肤品',
                        production_name:'爽肤水',
                        goods_name:'爽肤水 200ml',
                        number:'4',
                        production_number:'6',
                        remarks:'',
                    }, {
                        goods_type:'护肤品',
                        production_name:'爽肤水',
                        goods_name:'爽肤水 200ml',
                        number:'4',
                        production_number:'6',
                        remarks:'',
                    },
                ],
                types: [
                    {id:1,name:'面膜'},
                    {id:2,name:'爽肤水'},
                ],
                productNames: [
                    {id:1,name:'面膜 6张'},
                    {id:2,name:'爽肤水 200ml'},
                ],
                storageUsers: [
                    {id:1,name:'张三'},
                    {id:2,name:'李四'},
                ],
                distributors: [
                    {id:1,name:'顺丰'},
                    {id:2,name:'圆通'},
                ],
            }
        },
        methods:{
            addGoodsDialog(){
                this.$modal.show('addGoodsDialog');
            },
            editGoodsShelves(){
                this.$modal.show('editGoodsShelves');

            },
            goodsShelvesStatus(){
                this.$modal.show('goodsShelvesStatus');
            },

        },
        created(){
            this.$on('search-tool-change', this.onSearchChange);
        }
    }
</script>

<style scoped>

</style>