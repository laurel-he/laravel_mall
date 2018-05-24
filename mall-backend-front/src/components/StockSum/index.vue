<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" class="demo-form-inline" size="small">
                    <el-form-item prop="entrepot_id" class="form-item-unique">
                        <el-select
                                clearable
                                v-model="searchForm.entrepot_id"
                                size="small"
                                placeholder="配送中心">
                            <el-option v-for="v in distributors" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="cate_type_id" class="form-item-unique">
                            <el-select
                                    v-model="searchForm.cate_type_id"
                                    size="small"
                                    placeholder="商品类型"
                                    @change="typeChange">
                                <el-option v-for="v in types" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                    <el-form-item prop="cate_kind_id" class="form-item-unique">
                        <el-select
                                v-model="searchForm.cate_kind_id"
                                size="small"
                                placeholder="商品品类">
                            <el-option v-for="v in cate_kinds" :label="v.label"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goods_name" class="form-item-unique">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>

                    <el-form-item prop="searchTime">
                        <el-date-picker
                            size="small"
                            v-model="searchForm.searchTime"
                            type="daterange"
                            placeholder="选择时间范围"
                            @change='timeChange'>
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" size="small" @click="searchToolChange('searchForm')" icon="search">查询
                        </el-button>
                        <el-button size="small" type="primary" @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload"   :page-size="20" >
                    <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                    <el-table-column prop="entrepot.name" label="配送中心" width="180" align="center"></el-table-column>
                    <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                    <el-table-column prop="goods.cate_kind" label="商品种类" width="180" align="center"></el-table-column>
                    <el-table-column prop="saleable_count" label="可用库存数" width="180" align="center"></el-table-column>
                    <el-table-column prop="entrepot_out" label="累记出库数量" align="center"></el-table-column>
                    <el-table-column prop="entrepot_id" label="累记生产入库数量" align="center"></el-table-column>
                    <el-table-column prop="bad_num" label="损坏数量" align="center"></el-table-column>
                    <!-- <el-table-column prop="summary_time" label="汇总时间" align="center"></el-table-column> -->
                </TableProxy>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import PageMix from '../../mix/Page';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import DistributionCenterSelectProxy from '@/packages/DistributionCenterSelectProxy';
    import CategorySelectProxy from '../../packages/CategorySelectProxy';

    import InventoryGather from '@/ajaxProxy/InventoryGather';

    export default {
        name:'StockSum',
        pageTitle:"库存汇总",
        mixins: [PageMix, SearchTool,DataTable],
        data(){
            return {
                ajaxProxy:InventoryGather,
                mainurl:InventoryGather,
                mainparam:"",
                searchForm: {
                    entrepot_id: '',
                    cate_type_id:"",
                    cate_kind_id:"",

                    product_id: "",
                    goods_type_id: '',
                    goods_name: '',
                    storage_id: '',
                    goodsShelveNumber: '',
                    searchTime:'',
                    start:"",
                    end:""
                },
                types: [],
                cate_kinds:[],
                distributors:[]
            }
        },
        methods:{
            handleReload(){
                this.dataTableReload++;
                this.cate_kinds = [];
            },
            onSearchChange(param){
                if (this.searchForm.searchTime.length!=2) {
                    param.start = "";
                    param.end = "";
                }
                this.mainparam = JSON.stringify(param);
            },
            loadEntrepot(data){
                this.distributors = data.items;
            },
            getTypes(data){
                this.types = data.items;
            },
            typeChange(v){
                this.cate_kinds = [];
                this.searchForm.cate_kind_id = '';
                for (let index = 0; index < this.types.length; index++) {
                    const element = this.types[index];
                    if (element.id == v) {
                        this.cate_kinds = element.children;
                    }
                }
            },
            timeChange(v){
                if (v && v.length > 1) {
                    let d = v.split(" - ");
                    this.searchForm.start = d[0]+ " 00:00:00";
                    this.searchForm.end = d[1]+ " 23:59:59";
                }
            }
        },
        created(){
            this.$on('search-tool-change', this.onSearchChange);

            this.entrepotSelect =  new DistributionCenterSelectProxy({}, this.loadEntrepot, this);
            this.entrepotSelect.load();

            let CategorySelect = new CategorySelectProxy({}, this.getTypes, this);
            CategorySelect.load();
        }
    }
</script>

<style scoped>
    .form-item-unique{
        width: 140px !important;
    }
</style>