<template>
  <div class="hello">
    <el-row>
      <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
        <el-form-item prop="name">
          <el-input v-model="searchForm.name" size="small" placeholder="请输入类型名称"></el-input>
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
        <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size="15">
          <!-- <el-table-column type="selection" align="center" width="50"></el-table-column> -->

          <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>

          <el-table-column prop="name" label="类型名称" width="180" align="center">
          </el-table-column>

          <el-table-column prop="type_attr" label="属性标签" align="center">
            <template slot-scope="scope">
              {{showSpec(scope.row.specs)}}
            </template>
          </el-table-column>

          <!-- <el-table-column prop="status" label="是否启用" align="center">
            <template slot-scope="scope">
                <el-switch
                        v-model="scope.row.status"
                        on-color="#13ce66"
                        off-color="#ff4949">
                </el-switch>
            </template>
          </el-table-column> -->
          
          <el-table-column prop="created_at" label="添加时间" align="center">
          </el-table-column>

          <el-table-column  label="操作" align="center" width="140">
            <template slot-scope="scope">
              <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
              <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
            </template>
          </el-table-column>

          <div slot="buttonbar">
            <!-- <el-button size="small" type="danger" @click="handleDeletes">批量删除 </el-button> -->
            <el-button size="small" type="primary" @click="showAdd()">添加类型</el-button>
          </div>
        </TableProxy>
      </el-col>
    </el-row>

    <Add name='add-goods-type' 
         :ajax-proxy="ajaxProxy" 
         :specs="specs"
         @submit-success="handleReload">
    </Add>
    <Edit name='edit-goods-type' 
          :ajax-proxy="ajaxProxy" 
          :specs="specs"
          @submit-success="handleReload">
    </Edit>

  </div>
</template>

<script>
import Add from './Add';
import Edit from './Edit';
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';
import GoodsTypeAjaxProxy from '../../ajaxProxy/GoodsType';
import GoodsSpecsSelectProxy from '../../packages/GoodsSpecsSelectProxy';
import URL_CONST from '../../config';
export default {
    name: 'GoodsType',
    pageTitle: "商品类型",
    mixins: [PageMix, SearchTool,DataTable,GoodsTypeAjaxProxy],
    components:{
      Add,
      Edit
    },
    data() {
        return {
            ajaxProxy:GoodsTypeAjaxProxy,
            mainparam:"",
            mainurl:GoodsTypeAjaxProxy.getUrl(),
            searchForm: {
                name: '',
            },
            specs:[],

        }
    },
    methods: {
        getAjaxProxy(){
            return this.ajaxProxy;
        },
        onSearchChange(param) {
            this.mainparam = JSON.stringify(param);
        },
        showAdd(){
            this.getGoodsSpecs();
            this.$modal.show('add-goods-type');
        },
        showEdit(row){
            this.getGoodsSpecs();
            this.$modal.show('edit-goods-type',{model:row});
        },
        loadSpecs(data){
            this.specs = data.items;
        },
        getGoodsSpecs(){
            let goodsSpecs = new GoodsSpecsSelectProxy({}, this.loadSpecs, this);
            goodsSpecs.load();
        },
        showSpec(specs){
            let spec = [];
            for (let i = 0; i < specs.length; i++) {
                spec.push(specs[i].name);
            }
            return spec.join(" / ");
        }

    },

    created() {
        this.$on('search-tool-change', this.onSearchChange);
        this.getGoodsSpecs();
    }
}
</script>
