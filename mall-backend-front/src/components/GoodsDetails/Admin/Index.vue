<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="goods_name">
                    <el-input v-model="searchForm.goods_name" placeholder="请输入商品名称" size="small"></el-input>
                </el-form-item>
                <el-form-item prop="goods_number">
                    <el-input v-model="searchForm.goods_number" placeholder="请输入商品货号" size="small"></el-input>
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
                <!-- <el-form-item prop="start">
                    <el-date-picker v-model="searchForm.start" size="small" type="date"
                        placeholder="商品添加始日期" :picker-options="pickerOptions" @change="getStartTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item prop="end">
                    <el-date-picker v-model="searchForm.end" size="small" type="date"
                        placeholder="商品添加止日期" :picker-options="pickerOptions" @change="getEndTime">
                    </el-date-picker>
                </el-form-item> -->
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

                    <el-table-column  label="图片" width="100" align="center">
                        <template slot-scope="scope">
                            <img :src="scope.row.cover_url" width="50" height="50" alt="">
                        </template>
                    </el-table-column>

                    <el-table-column prop="goods_price" label="商品价格" align="center">
                    </el-table-column>

                    <el-table-column prop="goods_number" label="商品货号" align="center">
                    </el-table-column>

                    <el-table-column prop="goods_type" label="商品分类" width="180" align="center">
                        <template slot-scope="scope">
                            {{ displayCategory(scope.row.category) }}
                        </template>
                    </el-table-column>

                    <el-table-column prop="unit_type" label="商品单位" align="center">
                        <template slot-scope="scope">
                            {{setUnitTypes(scope.row.unit_type)}}
                        </template>
                    </el-table-column>
                    <el-table-column prop="new_goods" label="新品首发" align="center">
                        <template slot-scope="scope">
                            <el-switch
                                    v-model="scope.row.new_goods"
                                    on-color="#13ce66"
                                    off-color="#ff4949"
                                    :on-value="1" 
                                    :off-value="0"
                                    @change="setNewgoodsChange(scope.row)">
                            </el-switch>
                        </template>
                    </el-table-column>
                    <el-table-column prop="hot_goods" label="畅销精品" align="center">
                        <template slot-scope="scope">
                            <el-switch
                                    v-model="scope.row.hot_goods"
                                    on-color="#13ce66"
                                    off-color="#ff4949"
                                    :on-value="1" 
                                    :off-value="0"
                                    @change="setHotgoodsChange(scope.row)">
                            </el-switch>
                        </template>
                    </el-table-column>
                    <!-- <el-table-column prop="recommend_goods" label="推荐" align="center">
                        <template slot-scope="scope">
                            <el-switch
                                    v-model="scope.row.recommend_goods"
                                    on-color="#13ce66"
                                    off-color="#ff4949">
                            </el-switch>
                        </template>
                    </el-table-column> -->
                    <el-table-column prop="status" label="上下架" align="center">
                        <template slot-scope="scope">
                            <el-switch v-model="scope.row.status" @change="setStatusChange(scope.row)" on-color="#13ce66" off-color="#ff4949" :on-value="1" :off-value="2">
                            </el-switch>
                        </template>
                    </el-table-column>

                    <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button-group>
                                <el-button type="info" size="small" @click="showEdit(scope.row.id)">编辑</el-button>
                                <el-button type="info" size="small" @click="showSpec(scope.row)">规格</el-button>
                                <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
                            </el-button-group>
                        </template>
                    </el-table-column>

                    <div slot="buttonbar">
                        <!-- <el-button size="small" type="warning" icon="delete" @click="handleDeletes">批量删除 </el-button> -->
                        <el-button size="small" type="primary"  @click="showAdd">添加商品</el-button>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>

        <Add name='add-goods-details' 
            :cate-map="cidMapTypeId"
            :ajax-proxy="ajaxProxy"
            :cate-options="cateOptions"
            :upload-url="uploadUrl"
            @submit-success="handleReload">
        </Add>

        <Edit name='edit-goods-details' 
            :ajax-proxy="ajaxProxy"
            :cate-options="cateOptions"
            :upload-url="uploadUrl"
            @submit-success="handleReload">
        </Edit>

        <Spec name='edit-goods-spec' 
            :cate-map="cidMapTypeId"
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
