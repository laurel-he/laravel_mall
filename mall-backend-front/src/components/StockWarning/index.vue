<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" >

                    <el-form-item prop="goods_type_id"  >
                        <el-select
                                v-model="searchForm.goods_type_id"
                                size="small"
                                placeholder="商品类型">
                            <el-option v-for="v in types" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
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
                        <el-table-column prop="goods_type" label="商品类型" width="180" align="center"></el-table-column>
                        <el-table-column prop="product_name" label="商品种类" width="180" align="center"></el-table-column>
                        <el-table-column prop="rest_goods_number" label="商品剩余数量" width="180" align="center"></el-table-column>
                        <el-table-column prop="total_goods_number" label="累记库存总量" align="center"></el-table-column>
                        <el-table-column prop="warehouse_status" label="库存状态" align="center"></el-table-column>


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
        name:'StockWarning',
        pageTitle:"库存预警",
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
                    {   distribution_name:'成都很快公司',
                        goods_name:'爽肤水',
                        goods_type:'护肤品',
                        product_name:'爽肤水 200ml',
                        rest_goods_number:'60',
                        total_goods_number:'200',
                        warehouse_status:'正常',
                    }, {   distribution_name:'成都很快公司',
                        goods_name:'爽肤水',
                        goods_type:'护肤品',
                        product_name:'爽肤水 200ml',
                        rest_goods_number:'60',
                        total_goods_number:'200',
                        warehouse_status:'正常',
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