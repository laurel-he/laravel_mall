<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="goods_name">
                    <el-input v-model="searchForm.goods_name" placeholder="请输入商品名称" size="small"></el-input>
                </el-form-item>
                <el-form-item prop="sku_sn">
                    <el-input v-model="searchForm.sku_sn" placeholder="请输入商品编号" size="small"></el-input>
                </el-form-item>
                <el-form-item prop="cate_id">
                    <el-cascader
                        expand-trigger="hover"
                        :options="cateOptions"
                        v-model="searchForm.cate_id"
                        @change="handleCateChange"
                        filterable change-on-select clearable
                        placeholder="选择商品分类" size="small" style="line-height:28px;">
                    </el-cascader>
                </el-form-item>
                
                <el-form-item>
                    <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询
                    </el-button>
                    <el-button type="primary" size="small" @click="searchToolReset('searchForm')">重置</el-button>
                </el-form-item>
            </el-form>
        </el-row>
        <el-row>
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size='10'>
                    <!-- <el-table-column type="selection" align="center" width="50"></el-table-column> -->
                    <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>

                    <el-table-column prop="goods_name" label="商品名称" width="180" align="center">
                    </el-table-column>

                    <el-table-column  label="图片" width="180" align="center">
                        <template slot-scope="scope">
                            <img :src="scope.row.cover_url" width="50" height="50" alt="">
                        </template>
                    </el-table-column>

                    <el-table-column prop="goods_price" label="商品价格" align="center">
                    </el-table-column>

                    <el-table-column prop="sku_sn" label="商品编号" align="center">
                    </el-table-column>

                    <el-table-column prop="goods_type" label="商品分类" align="center">
                        <template slot-scope="scope">
                            {{ displayCategory(scope.row.category) }}
                        </template>
                    </el-table-column>

                    <el-table-column prop="unit_type" label="商品单位" align="center">
                        <template slot-scope="scope">
                            {{setUnitTypes(scope.row.unit_type)}}
                        </template>
                    </el-table-column>
                    
                    <el-table-column prop="status" label="上下架" align="center">
                        <template slot-scope="scope">
                            <el-tag v-if="scope.row.status==2">下架</el-tag>
                            <el-tag type="success" v-if="scope.row.status==1">上架</el-tag>
                        </template>
                    </el-table-column>

                    <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row.id)">查看</el-button>
                            <el-button type="info" size="small" @click="showSpec(scope.row)">规格</el-button>
                        </template>
                    </el-table-column>

                    
                </TableProxy>
            </el-col>
        </el-row>

        <Edit name='edit-goods-details' 
            :ajax-proxy="ajaxProxy"
            :cate-options="cateOptions"
            :upload-url="uploadUrl">
        </Edit>
        <Spec name='edit-goods-spec' 
            :ajax-proxy="ajaxProxy">
        </Spec>
        
    </div>
</template>

<script src="./index.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .el-cascader--small .el-cascader__label {
        line-height: 38px;
    }
</style>
