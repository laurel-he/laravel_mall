<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="order_number">
                    <el-input v-model="searchForm.order_sn" size="small" placeholder="请输入订单号"></el-input>
                </el-form-item>
                <el-form-item prop="express_no">
                    <el-input v-model="searchForm.express_sn" size="small" placeholder="请输入快递单号"></el-input>
                </el-form-item>
                <!-- <el-form-item prop="express_status">
                    <el-select size="small" placeholder="物流状态" v-model="searchForm.express_status">
                        <el-option v-for="(item,index) in expressStatus" :key="index" :label="item" :value="index"></el-option>
                    </el-select>
                </el-form-item> -->
                <el-form-item prop="start">
                    <el-date-picker v-model="searchForm.start" size="small" type="date"
                        placeholder="发货始日期" :picker-options="pickerOptions" @change="getStartTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item prop="end">
                    <el-date-picker v-model="searchForm.end" size="small" type="date"
                        placeholder="发货止日期" :picker-options="pickerOptions" @change="getEndTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" size="small" icon="search" @click="searchToolChange('searchForm')">查询</el-button>
                    <el-button type="primary" size="small" @click="searchToolReset('searchForm')">重置</el-button>
                    <!-- <el-button type="primary" size="small" @click="refreshTable">刷新</el-button> -->
                </el-form-item>
            </el-form>
        </el-row>
        <el-row>
            <el-col>
                <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload" :page-size="15">
                    <el-table-column label="序号" align="center"  type="index" width="65"></el-table-column>
                    <el-table-column prop="express_sn" label="快递单号" align="center">
                    </el-table-column>
                    <el-table-column prop="order_sn" label="订单号" align="center">
                    </el-table-column>
                    <!-- <el-table-column prop="order_time" label="订单日期" align="center">
                    </el-table-column> -->
                    <el-table-column prop="express_name" label="物流公司" align="center">
                    </el-table-column>
                    <!-- <el-table-column prop="express_status" label="物流状态" align="center">
                    </el-table-column> -->
                    <el-table-column prop="express_time" label="发货时间" align="center">
                    </el-table-column>
                    <el-table-column prop="consignee" label="收货人" align="center">
                    </el-table-column>
                    <el-table-column prop="express_phone" label="联系电话" align="center">
                    </el-table-column>
                    <el-table-column prop="address" label="地址" align="center">
                    </el-table-column>
                    <el-table-column prop="express_remark" label="物流备注" align="center">
                    </el-table-column>

                    <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="showAdd">添加</el-button>
                    </div>
                </TableProxy>
            </el-col>
        </el-row>

        <Add 
            name="add-express" 
            :ajax-proxy="ajaxProxy" 
            @submit-success="handleReload" />

    </div>

</template>

<script>
    import PageMix from '../../mix/Page';
    //import DataProxy from '../../packages/DataProxy';
    import SearchTool from '../../mix/SearchTool';
    import DataTable from '../../mix/DataTable';
    import SelectProxy from  '../../packages/SelectProxy';
    import ExpressInfoAjaxProxy from '../../ajaxProxy/ExpressInfo';

    import Add from './Add';

    export default {
        name: 'ExpressInfo',
        pageTitle:"物流信息",
        mixins: [PageMix,SearchTool,DataTable,ExpressInfoAjaxProxy],
        components: {
            Add
        },
        data () {
            return {
                mainparam:"",
                mainurl:ExpressInfoAjaxProxy.getUrl(),
                ajaxProxy:ExpressInfoAjaxProxy,
                expressStatus:['运输中','未运输'],
                searchForm:{
                    order_number:'',
                    express_no:'',
                    express_status:'',
                    start:'',
                    end:'',
                },
                pickerOptions: {
                    disabledDate(time) {
                        return time.getTime() > Date.now();//- 8.64e7
                    }
                },
                editContent:'',
                editorOption:{}


            }
        },
        methods:{
            outTimeDateChange(v){
                this.searchForm.express_time = v;
            },
            onSearchChange(param){
                console.log(param);
                if (this.searchForm.start > this.searchForm.end) {
                    this.$message.error("请选择正确的时间段");
                    return ;
                }
                this.mainparam = JSON.stringify(param);
            },
            
            initExpressStatus(data){
                this.expressStatus = data;
            },
            getExpressStatus(){
                let selectProxy = new SelectProxy(this.mainurl,this.initExpressStatus,this);
                selectProxy.setExtraParam({business:'ExpressStatus'}).load();
            },
            getStartTime(v){
                this.searchForm.start = v;
            },
            getEndTime(v){
                this.searchForm.end = v;
            },//---------------------
            onEditorBlur(quill) {
                //console.log('editor blur!', quill);
            },
            onEditorFocus(quill) {
                console.log('editor focus!', quill);
                
            },
            onEditorReady(quill) {
                //console.log('editor ready!', quill);
            },
            onEditorChange({ quill, html, text }) {
                //console.log('editor change!', quill.getContents(), html, text);
                this.editContent = html;
                //console.log(quill.getContents());
            },
            showAdd(){
                this.$modal.show('add-express');
            }
            
        },
        created(){
            this.$on('search-tool-change', this.onSearchChange);
            this.getExpressStatus();
        },
        mounted() {
            //console.log('this is current quill instance object', this.editor)
        },
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
