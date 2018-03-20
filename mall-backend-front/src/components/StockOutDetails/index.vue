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

                    <el-form-item prop="storage_id"  >
                        <el-select
                                v-model="searchForm.storage_id"
                                size="small"
                                placeholder="销售人员">
                            <el-option v-for="v in storageUsers" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="product_id"  >
                        <el-select
                                v-model="searchForm.product_id"
                                size="small"
                                placeholder="商品种类">
                            <el-option v-for="v in productNames" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goods_name">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>
                    <el-form-item prop="goods_number">
                        <el-input v-model="searchForm.goods_number" size="small" placeholder="商品编号"></el-input>
                    </el-form-item>
                    <el-form-item prop="express_company">
                        <el-input v-model="searchForm.express_company" size="small" placeholder="快递公司"></el-input>
                    </el-form-item>
                    <el-form-item prop="express_order">
                        <el-input v-model="searchForm.express_order" size="small" placeholder="快递单号"></el-input>
                    </el-form-item>
                    <el-form-item prop="customer_name">
                    <el-input v-model="searchForm.customer_name" size="small" placeholder="客户姓名"></el-input>
                    </el-form-item>
                    <el-form-item prop="customer_phone">
                        <el-input v-model="searchForm.customer_phone" size="small" placeholder="客户手机"></el-input>
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
                        <el-table-column label="序号" align="center" type="index" ></el-table-column>
                        <el-table-column prop="goods_number" label="商品编号"  align="center"></el-table-column>
                        <el-table-column prop="express_order" label="快递单号"  align="center"></el-table-column>
                        <el-table-column prop="out_time" label="出库时间"  align="center"></el-table-column>
                        <el-table-column prop="goods_status" label="商品状态"  align="center"></el-table-column>
                        <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                        <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                        <el-table-column prop="goods_type" label="商品类型"  align="center"></el-table-column>
                        <el-table-column prop="product_name" label="商品种类"  align="center"></el-table-column>
                        <el-table-column prop="sale_goods_number" label="商品数量"  align="center"></el-table-column>
                        <el-table-column prop="express_company" label="快递公司" align="center"></el-table-column>
                        <el-table-column prop="goods_weight" label="商品重量" align="center"></el-table-column>
                        <el-table-column prop="express_money" label="快递费用（元）" align="center"></el-table-column>
                        <el-table-column prop="distribution_money" label="配送费用（元）" align="center"></el-table-column>
                        <el-table-column prop="customer_name" label="客户姓名" align="center"></el-table-column>
                        <el-table-column prop="customer_phone" label="客户手机" align="center"></el-table-column>
                        <el-table-column prop="customer_address" label="客户地址" align="center"></el-table-column>
                        <el-table-column prop="invoice_print_status" label="发货单打印状态" align="center"></el-table-column>
                        <el-table-column prop="express_order_print_status" label="快递单打印状态" align="center"></el-table-column>
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
        name:'StockOutDetails',
        pageTitle:"出库明细",
        mixins: [PageMix, SearchTool,DataTable],
        data(){
            return {
                searchForm: {
                    product_id: "",
                    goods_type_id: '',
                    goods_name: '',
                    goods_number: '',
                    express_order: '',
                    express_company: '',
                    storage_id: '',
                    customer_name: '',
                    customer_phone: '',
                    goodsShelveNumber: '',
                    distribution_id: '',
                    searchTime:'',
                },
                dataList:[
                    {   goods_number:'6',
                        express_order:'1321564564',
                        out_time:'2018-03-10',
                        goods_status:'发货',
                        sale_name:'张三',
                        goods_name:'爽肤水 200ml',
                        goods_type:'护肤品',
                        product_name:'爽肤水',
                        sale_goods_number:'5',
                        express_company:'成都跑的快公司',
                        goods_weight:'2kg',
                        express_money:'15',
                        distribution_money:'20',
                        customer_name:'大佬',
                        customer_phone:'13564652315',
                        customer_address:'北京海淀阳光小区5栋3单元2号',
                        invoice_print_status:'已打印',
                        express_order_print_status:'已打印',
                    },{   goods_number:'6',
                        express_order:'1321564564',
                        out_time:'2018-03-10',
                        goods_status:'发货',
                        sale_name:'张三',
                        goods_name:'爽肤水 200ml',
                        goods_type:'护肤品',
                        product_name:'爽肤水',
                        sale_goods_number:'5',
                        express_company:'成都跑的快公司',
                        goods_weight:'2kg',
                        express_money:'15',
                        distribution_money:'20',
                        customer_name:'大佬',
                        customer_phone:'13564652315',
                        customer_address:'北京海淀阳光小区5栋3单元2号',
                        invoice_print_status:'已打印',
                        express_order_print_status:'已打印',
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