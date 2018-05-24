<template>
    <div>
        <el-row>
            <el-col :span="24">
                <el-form :inline="true"  ref="searchForm" :model="searchForm" >
                    <el-form-item prop="cate_type_id">
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
                    
                    <el-form-item prop="cate_kind_id">
                        <el-select
                                v-model="searchForm.cate_kind_id"
                                size="small"
                                placeholder="商品品类">
                            <el-option v-for="v in cate_kinds" :label="v.label"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="entrepot_id">
                        <el-select
                                v-model="searchForm.entrepot_id"
                                size="small"
                                placeholder="配送中心">
                            <el-option v-for="v in distributors" :label="v.name"
                                       :value="v.id" :key="v.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item prop="goods_name">
                        <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
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
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size="15">
                    <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>

                    <el-table-column prop="entrepot.name" label="配送中心" width="180" align="center"></el-table-column>

                    <el-table-column prop="goods_name" label="商品名称" width="180" align="center"></el-table-column>

                    <el-table-column prop="goods.cate_type" label="商品类型" width="180" align="center"></el-table-column>

                    <el-table-column prop="goods.cate_kind" label="商品种类" width="180" align="center"></el-table-column>

                    <el-table-column prop="entrepot_count" label="商品剩余数量" width="180" align="center"></el-table-column>

                    <el-table-column prop="produce_in" label="累记库存总量" align="center"></el-table-column>

                    <el-table-column prop="warehouse_status" label="库存状态" align="center">
                        <template slot-scope="scope">
                            {{ setWarehouseStatus(scope.row) }}
                        </template>
                    </el-table-column>

                    <el-table-column label="操作" fixed="right" align="center">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                        </template>
                    </el-table-column>
                </TableProxy>
            </el-col>
        </el-row>

        <edit name="edit-dialog" 
              :ajax-proxy="ajaxProxy"
              :distributors="distributors"
              :types="types"
              @submit-success="handleReload">
        </edit>
    </div>
</template>

<script>
    import PageMix from '../../mix/Page';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import DistributionCenterSelectProxy from '@/packages/DistributionCenterSelectProxy';
    import CategorySelectProxy from '@/packages/CategorySelectProxy';
    import StockWarningAjaxProxy from '@/ajaxProxy/StockWarning';

    import edit from "./edit";

    export default {
        name:'StockWarning',
        pageTitle:"库存预警",
        mixins: [PageMix, SearchTool,DataTable,StockWarningAjaxProxy],
        components:{
            edit,
        },
        data(){
            return {
                mainparam:"",
                mainurl:StockWarningAjaxProxy.getUrl(),
                ajaxProxy:StockWarningAjaxProxy,
                searchForm: {
                    cate_type_id:'',
                    cate_kind_id:'',
                    goods_name: '',
                    entrepot_id: '',
                },
                distributors: [],
                types: [],
                cate_kinds:[],
            }
        },
        methods:{
            handleReload(){
                this.dataTableReload++;
                this.cate_kinds = [];
            },
            showEdit(row){
                this.entrepotSelect.load();
                this.CategorySelect.load(); 
                row.cate_type_id = row.goods.cate_type_id;
                row.cate_kind_id = row.goods.cate_kind_id;
                this.$modal.show('edit-dialog',{model:row});
            },
            onSearchChange(param){
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
            setWarehouseStatus(row){
                if(row.entrepot_count > row.inventory_max){
                    return "仓库爆满";
                }else if(row.entrepot_count < row.inventory_min){
                    return "缺货预警";
                }else if(row.entrepot_count <= row.inventory_max  && row.entrepot_count >= row.inventory_min){
                    return "货物充足";
                }
            }
        },
        created(){
            this.$on('search-tool-change', this.onSearchChange);

            this.entrepotSelect =  new DistributionCenterSelectProxy({}, this.loadEntrepot, this);
            this.entrepotSelect.load();

            this.CategorySelect = new CategorySelectProxy({}, this.getTypes, this);
            this.CategorySelect.load();
            
        }
    }
</script>

<style scoped>

</style>