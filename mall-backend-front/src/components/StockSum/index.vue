<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" >
                    <el-form-item prop="department_id"  >
                        <el-select
                                v-model="searchForm.distribution_id"
                                size="small"
                                placeholder="配送中心">
                            <el-option v-for="v in distributors" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="product_id"  >
                        <el-select
                                v-model="searchForm.product_id"
                                size="small"
                                placeholder="商品品类">
                            <el-option v-for="v in productNames" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goods_name">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>

                    <el-form-item prop="searchTime">
                        <el-date-picker
                                v-model="searchForm.searchTime"
                                type="datetimerange"
                                placeholder="选择时间范围">
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
                <el-tabs>
                    <el-table :data="dataList" empty-text="暂无数据" border>
                        <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>
                        <el-table-column prop="distribution_name" label="配送中心" width="180" align="center"></el-table-column>
                        <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>
                        <el-table-column prop="product_name" label="商品种类" width="180" align="center"></el-table-column>
                        <el-table-column prop="usable_stock_number" label="可用库存数" width="180" align="center"></el-table-column>
                        <el-table-column prop="production_out_number" label="累记出库数量" align="center"></el-table-column>
                        <el-table-column prop="total_production_in_number" label="累记生产入库数量" align="center"></el-table-column>
                        <el-table-column prop="damage_number" label="损坏数量" align="center"></el-table-column>
                        <el-table-column prop="summary_time" label="汇总时间" align="center"></el-table-column>

                    </el-table>
                </el-tabs>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import PageMix from '../../mix/Page';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    export default {
        name:'StockSum',
        pageTitle:"库存汇总",
        mixins: [PageMix, SearchTool,DataTable],
        data(){
            return {
                searchForm: {
                    product_id: "",
                    goods_type_id: '',
                    goods_name: '',
                    storage_id: '',
                    goodsShelveNumber: '',
                    distribution_id: '',
                    searchTime:'',
                },
                dataList:[
                    {   distribution_name:"圆通",
                        goods_name:"爽肤水",
                        product_name:"护肤品",
                        usable_stock_number:"100",
                        production_out_number:"50",
                        total_production_in_number:"120",
                        damage_number:"5",
                        summary_time:"2018-03-10",
                    },{   distribution_name:"圆通",
                        goods_name:"爽肤水",
                        product_name:"护肤品",
                        usable_stock_number:"100",
                        production_out_number:"50",
                        total_production_in_number:"120",
                        damage_number:"5",
                        summary_time:"2018-03-10",
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
        created(){
            this.$on('search-tool-change', this.onSearchChange);
        }
    }
</script>

<style scoped>

</style>