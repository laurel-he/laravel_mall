<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true" :model="searchForm" ref="searchForm" class="search-bar" size="small">
                    <el-form-item prop="entrepot_id">
                        <el-select v-model="searchForm.entrepot_id" size="small" placeholder="配送中心" clearable>
                            <el-option v-for="v in distributors" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="cate_type_id" >
                        <el-select v-model="searchForm.cate_type_id" size="small" placeholder="商品类型" clearable @change="cate_type_change">
                            <el-option v-for="v in CategoryList" :label="v.label"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="cate_kind_id" >
                        <el-select v-model="searchForm.cate_kind_id" size="small" placeholder="商品品类" clearable >
                            <el-option v-for="v in CategoryChildrenList" :label="v.label"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="goods_name">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                    </el-form-item>
                    <el-form-item prop="sku_sn">
                        <el-input v-model="searchForm.sku_sn" size="small" placeholder="商品编号"></el-input>
                    </el-form-item>
                    <el-form-item prop="sale_name">
                        <el-input v-model="searchForm.sale_name" size="small" placeholder="销售人员"></el-input>
                    </el-form-item>
                    <el-form-item prop="deliver_name">
                        <el-input v-model="searchForm.deliver_name" size="small" placeholder="收货人姓名"></el-input>
                    </el-form-item>
                    <el-form-item prop="deliver_phone">
                        <el-input v-model="searchForm.deliver_phone" size="small" placeholder="收货人电话"></el-input>
                    </el-form-item>
                    <el-form-item prop="express_name">
                        <el-input v-model="searchForm.express_name" size="small" placeholder="快递公司"></el-input>
                    </el-form-item>
                    <el-form-item prop="status">
                        <el-select v-model="searchForm.status" size="small" placeholder="发货状态">
                            <el-option label="待发" value="0"></el-option>
                            <el-option label="已发" value="1"></el-option>
                            <el-option label="废单" value="2"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="assign_type">
                        <el-select v-model="searchForm.assign_type" size="small" placeholder="发货类型">
                            <el-option label="正常" value="0"></el-option>
                            <el-option label="退货" value="1"></el-option>
                            <el-option label="换货" value="2"></el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item prop="user_name">
                        <el-input v-model="searchForm.user_name" size="small" placeholder="发货人员"></el-input>
                    </el-form-item>
                    <el-form-item prop="times" class="date-item">
                        <el-date-picker
                                v-model="searchForm.times"
                                type="daterange"
                                size="small"
                                placeholder="选择日期范围"
                                @change="timeChange">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                        <el-button type="primary" size="small" @click="searchToolReset('searchForm')">重置</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <el-tabs>
                    <TableProxy
                            :url="mainurl"
                            :param="mainparam"
                            :reload="dataTableReload" :page-size="15">
                        <el-table-column label="序号" align="center" type="index" ></el-table-column>
                        <el-table-column prop="sku_sn" label="商品编号"  align="center"></el-table-column>
                        <el-table-column prop="assign_sn" label="快递单号"  align="center"></el-table-column>
                        <el-table-column prop="out_entrepot_at" label="出库时间"  align="center"></el-table-column>
                        <el-table-column prop="status" label="商品状态"  align="center">
                            <template slot-scope="scope">
                                <span v-if="scope.row.status==0">待发</span>
                                <span v-if="scope.row.status==1">已发</span>
                                <span v-if="scope.row.status==2">废单</span>
                            </template>
                        </el-table-column>
                        <el-table-column prop="sale_name" label="销售人员"  align="center"></el-table-column>
                        <el-table-column prop="goods_name" label="商品名称"  align="center"></el-table-column>
                        <el-table-column prop="cate_type" label="商品类型"  align="center"></el-table-column>
                        <el-table-column prop="cate_kind" label="商品种类"  align="center"></el-table-column>

                        <el-table-column prop="goods_num" label="商品数量"  align="center"></el-table-column>
                        <el-table-column prop="express_name" label="快递公司" align="center"></el-table-column>
                        <el-table-column prop="weight" label="商品重量" align="center"></el-table-column>

                        <el-table-column prop="express_fee" label="快递费用（元）" align="center"></el-table-column>
                        <el-table-column prop="assign_fee" label="配送费用（元）" align="center"></el-table-column>

                        <el-table-column prop="deliver_name" label="收件人姓名" align="center"></el-table-column>
                        <el-table-column prop="deliver_phone" label="收件人手机" align="center"></el-table-column>
                        <el-table-column prop="deliver_address" label="收件人地址" align="center"></el-table-column>
                        <el-table-column prop="user_name" label="发货人" align="center"></el-table-column>
                        <el-table-column prop="invoice_print_status" label="发货单打印状态" align="center">
                            <template slot-scope="scope">
                                <span v-if="scope.row.assign_print_status==0">未打印</span>
                                <span v-if="scope.row.assign_print_status==1">已打印</span>
                            </template>
                        </el-table-column>
                        <el-table-column prop="express_order_print_status" label="快递单打印状态" align="center">
                            <template slot-scope="scope">
                                <span v-if="scope.row.express_print_status==0">未打印</span>
                                <span v-if="scope.row.express_print_status==1">已打印</span>
                            </template>
                        </el-table-column>
                    </TableProxy>
                </el-tabs>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import PageMix from '../../mix/Page';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import StockOutDetailsAjaxProxy from '../../ajaxProxy/StockOutDetails';

    import GoodsSelectProxy from '../../packages/GoodsSelectProxy';
    import DistributionCenterProxy from '../../packages/DistributionCenterSelectProxy';
    import SelectProxy from  '../../packages/SelectProxy';
    export default {
        name:'StockOutDetails',
        pageTitle:"出库明细",
        mixins: [PageMix, SearchTool,DataTable,StockOutDetailsAjaxProxy],
        data(){
            return {
                ajaxProxy: StockOutDetailsAjaxProxy,
                mainurl:StockOutDetailsAjaxProxy.getUrl(),
                mainparam:'',
                searchForm: {
                    assign_sn: "",
                    entrepot_id:'',
                    cate_type_id:'',
                    cate_kind_id:'',
                    goods_name:'',
                    sale_name:'',
                    start:'',
                    end:'',
                    deliver_name:'',
                    deliver_phone:'',
                    express_name:'',
                    status:'',
                    assign_type:'',
                    user_name:'',
                },
                distributors:[],
                CategoryList:[],
                CategoryChildrenList:[],
                times:'',

            }
        },
        methods:{
            searchToolReset(name){
                this.$refs[name].resetFields();
                this.$refs[name].$emit('reset');
                this.$emit('search-tool-change', this[name]);
                this.times='';
            },
            // searchToolChange(data){
            //    console.log(this.searchForm);
            //    return false;
            // },
            getDistributionCenter(data){
                this.distributors = data.items;
            },
            getCategoryList(data){
                this.CategoryList=data.items;
            },
            onSearchChange(param){
                this.mainparam = JSON.stringify(param);
            },
            getCategoryChildrenList(data){
                this.CategoryChildrenList=data;
            },
            cate_type_change(v){
                this.searchForm.cate_kind_id = '';
                if(v){
                    let selectProxy = new SelectProxy('/getCategorys/'+ v, this.getCategoryChildrenList, this);
                    selectProxy.load();
                }
            },
            timeChange(v){
                this.searchForm.start = v.split(' - ')[0];
                this.searchForm.end = v.split(' - ')[1];
            },
        },
        created(){
            //获取配送中心数据
            let DistributionCenterSelect = new DistributionCenterProxy({}, this.getDistributionCenter, this);
            DistributionCenterSelect.load();
            //获取商品类型
            let selectProxy = new SelectProxy('/tree', this.getCategoryList, this);
            selectProxy.load();
            this.$on('search-tool-change', this.onSearchChange);

            this.mainparam = JSON.stringify(this.searchForm);
        }
    }
</script>

<style scoped>
    .search-bar .el-form-item {
        width: 140px;
    }
    .date-item{
        width: 220px !important;
    }
</style>