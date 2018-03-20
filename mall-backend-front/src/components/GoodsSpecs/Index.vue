<template>
  <div class="hello">
    <el-row>
      <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
        <el-form-item prop="name">
          <el-input v-model="searchForm.name" placeholder="请输入规格名称" size="small"></el-input>
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
        <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload">
          <!-- <el-table-column type="selection" align="center" width="50"></el-table-column> -->

          <el-table-column label="序号" align="center" type="index" width="65"></el-table-column>

          <el-table-column prop="name" label="规格名称" width="180" align="center">
          </el-table-column>

          <el-table-column prop="type" label="展示方式" align="center">
              <template slot-scope="scope">
                {{setShowTypes(scope.row.type)}}
              </template>
          </el-table-column>

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
              <el-button size="small" type="primary" @click="showAdd">添加规格</el-button>
          </div>
        </TableProxy>
      </el-col>
    </el-row>

    <Add name='add-goods-spec' 
        :ajax-proxy="ajaxProxy"
        @submit-success="handleReload">
    </Add>

    <Edit name='edit-goods-spec'
         :ajax-proxy="ajaxProxy"
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
import SelectProxy from  '../../packages/SelectProxy';
import GoodsSpecsAjaxProxy from '../../ajaxProxy/GoodsSpecs';
import URL_CONST from '../../config';

export default {
    name: 'GoodsSpecs',
    pageTitle: "商品规格",
    mixins: [PageMix, SearchTool,DataTable,GoodsSpecsAjaxProxy],
    components:{
      Add,
      Edit
    },
    data() {
        return {
            ajaxProxy:GoodsSpecsAjaxProxy,
            mainparam:"",
            mainurl:GoodsSpecsAjaxProxy.getUrl(),
            showTypes:{
                1:'文字',
                2:'图片',
                3:'自选',
            },
            searchForm: {
                name: '',
            },

        }
    },
    methods: {
        getAjaxProxy(){
           return this.ajaxProxy;
        },
        
        onSearchChange(param) {
            this.mainparam = JSON.stringify(param);
        },
        setShowTypes(type){
            return this.showTypes[type];
        },
        /* showTrack(field) {
            let param = {
                user_id: 1,
                track_num: 1212,
            }
            this.$emit('search-tool-change', param);
        }, */
        showAdd(){
            this.$modal.show('add-goods-spec',{model:this.showTypes});
        },
        showEdit(row){
            this.$modal.show('edit-goods-spec',{model:row,extra:this.showTypes});
        },
        
    },
    created() {
        this.$on('search-tool-change', this.onSearchChange);

    }
}
</script>
