<template>
    <div >
        <el-row>
            <el-col>
                <el-form :inline="true" ref="searchForm" class="demo-form-inline"  :model="searchForm">
                    <el-form-item prop="pdt_name">
                        <el-input v-model="searchForm.pdt_name" size="small" placeholder="产品名称">></el-input>
                    </el-form-item>
                    <el-form-item prop="into_time">
                        <el-date-picker size="small" v-model="searchForm.into_time"
                                        placeholder="入库时间"
                                        @change="intoTimeDateChange"
                                        :editable="false">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="info" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                        <el-button type="info" size="small" icon="search"  @click="$modal.show('advance')">高级查询</el-button>
                        <el-tooltip content="点击刷新当前页面" placement="right"  style="margin-left:15px;">
                            <el-button  size="small" type="info" @click="searchToolReset('searchForm')">重置</el-button>
                        </el-tooltip>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
        <el-row>
            <el-col>
                <el-table :data="tableData" v-loading="dataLoad" border style="width: 100%">
                    <el-table-column type="selection"  align="center" width="50" ></el-table-column>
                    <el-table-column label="序号" align="center"  type="index" width="65"></el-table-column>
                    <el-table-column prop="pdt_type" label="类型" width="180" align="center"></el-table-column>
                    <el-table-column prop="pdt_name" label="商品名称" align="center"></el-table-column>
                    <el-table-column prop="into_name" label="入库人" align="center"></el-table-column>
                    <el-table-column prop="batch_no" label="批次" align="center"></el-table-column>
                    <el-table-column prop="expiry_date" label="有效期" align="center"></el-table-column>
                    <el-table-column prop="pdt_time" label="生产日期" align="center"></el-table-column>
                    <el-table-column prop="pdt_num" label="数量" align="center"></el-table-column>
                    <el-table-column prop="pdt_price" label="价格" align="center"></el-table-column>
                    <el-table-column prop="into_time" label="入库时间" align="center"></el-table-column>
                </el-table>
            </el-col>
        </el-row>
        <el-row >
            <el-col :span="12">
                <div class="grid-content bg-purple" style="float: left;margin-top: 5px">
                    <el-button size="small" type="primary" @click="$modal.show('goodsInto')">新增入库</el-button>
                </div>
            </el-col>
            <div class="pull-right" style="float: right;margin-top: 5px">
                <el-col :span="12">
                    <el-pagination
                            :current-page="currentPage4"
                            :page-size="100"
                            layout="total, prev, pager, next, jumper"
                            :total="total"
                            @current-change="currentChange">
                    </el-pagination>
                </el-col>
            </div>
        </el-row>

        <advanceDialog name="advance"/>
        <goodsIntoDialog name="goodsInto"/>
    </div>
</template>
      
<script>
    import advanceDialog from './advanceDialog';
    import goodsIntoDialog from './goodsIntoDialog';

    import PageMix from '../../mix/Page';
    import DataProxy from '../../packages/DataProxy';
    import SearchTool from '../../mix/SearchTool';
export default {
    name: 'GoodsInto',
    pageTitle:"商品入库",
    mixins: [PageMix,SearchTool],
    components: {
        advanceDialog,
        goodsIntoDialog
    },
    data () {
        return {
            total:100,
            dataLoad:false,
            searchForm:{
                pdt_name:'',
                into_time:'',
            },
            currentPage4:1,
            tableData:[
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
                {
                    pdt_type:'保健品',
                    pdt_name:'强力雄兽丸',
                    into_name:'健仁堂',
                    batch_no:'20171212',
                    expiry_date:'2018-03-03',
                    pdt_time:'2017-08-08',
                    pdt_num:'100',
                    pdt_price:'1000',
                    into_time:'2017-10-10'
                },
            ],
            tableData1:[],
            tableData2:[],
            tableData3:[],
        }
    },
    methods:{
        dataReload:function(){
          console.log(this.searchForm);
        },
        searchReset:function(){

        },
        handleDeletes:function(){

        },
        mainTableLoad(data){
            this.toggleTableLoad();
            this.tableData = data.items;
            this.tableData1 = data.items1;
            this.tableData2 = data.items2;
            this.tableData3 = data.items3;
            this.total = data.total;
        },
        currentChange(v){
            this.toggleTableLoad();
            this.mainProxy.setPage(v).load();
        },
        toggleTableLoad(){
            this.dataLoad = !this.dataLoad;
        },
        onSearchChange(param){
          this.toggleTableLoad();
          this.mainProxy.setExtraParam(param).load();
          this.toggleTableLoad();
        },
        intoTimeDateChange(v){
            this.searchForm.into_time = v;
        }

    },
    created(){
        // this.toggleTableLoad();
        // let mainProxy = new DataProxy("/buycheck", this.pageSize, this.mainTableLoad, this);
        // this.mainProxy = mainProxy;
        // this.mainProxy.load();
       
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .el-form-item {
      margin-bottom: 2px;
  }
</style>
