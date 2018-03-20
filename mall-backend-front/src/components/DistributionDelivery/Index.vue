<template>
    <div class="hello">
        <el-row>
            <el-form :inline="true" :model="searchForm" ref="searchForm" class="demo-form-inline" size="small">
                <el-form-item prop="dc">
                    <el-select v-model="searchForm.dc" size="small" placeholder="配送中心">
                        <el-option label="郑州配送中心" value="1"></el-option>
                        <el-option label="广州配送中心" value="2"></el-option>
                        <el-option label="深圳配送中心" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item prop="goods_type">
                    <el-select v-model="searchForm.goods_type" size="small" placeholder="商品类型">
                        <el-option label="面膜" value="1"></el-option>
                        <el-option label="补水" value="2"></el-option>
                        <el-option label="祛痘" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item prop="goods_category">
                    <el-select v-model="searchForm.goods_category" size="small" placeholder="商品分类">
                        <el-option label="面膜-补水-补肾" value="1"></el-option>
                        <el-option label="补身-补水-补肾" value="2"></el-option>
                        <el-option label="大补-补水-补肾" value="3"></el-option>
                    </el-select>
                </el-form-item>
                <br>
                <el-form-item prop="goods_name">
                    <el-input v-model="searchForm.goods_name" size="small" placeholder="商品名称"></el-input>
                </el-form-item>
                <el-form-item prop="sale_name">
                    <el-input v-model="searchForm.sale_name" size="small" placeholder="销售人员"></el-input>
                </el-form-item>
                <el-form-item prop="start">
                    <el-date-picker
                    v-model="searchForm.start"
                    type="date"
                    placeholder="选择开始日期"
                    :picker-options="pickerOptions0" @change="setStartTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item prop="end">
                    <el-date-picker
                    v-model="searchForm.end"
                    type="date"
                    placeholder="选择结束日期"
                    :picker-options="pickerOptions1" @change="setEndTime">
                    </el-date-picker>
                </el-form-item>
                <el-form-item prop="cus_name">
                    <el-input v-model="searchForm.cus_name" size="small" placeholder="客户姓名"></el-input>
                </el-form-item>
                <el-form-item prop="cus_tel">
                    <el-input v-model="searchForm.cus_tel" size="small" placeholder="客户电话"></el-input>
                </el-form-item>
                <br>
                <el-form-item prop="company_name">
                    <el-input v-model="searchForm.company_name" size="small" placeholder="快递公司"></el-input>
                </el-form-item>
                <el-form-item prop="delivery_status">
                    <el-select v-model="searchForm.delivery_status" size="small" placeholder="发货状态">
                        <el-option label="已发" value="1"></el-option>
                        <el-option label="待发" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item prop="delivery_type">
                    <el-select v-model="searchForm.delivery_type" size="small" placeholder="发货类型">
                        <el-option label="正常" value="1"></el-option>
                        <el-option label="退货" value="2"></el-option>
                        <el-option label="换货" value="2"></el-option>
                    </el-select>
                </el-form-item>
                <el-form-item prop="delivery_name">
                    <el-select v-model="searchForm.delivery_name" size="small" placeholder="发货人员">
                        <el-option label="张三" value="1"></el-option>
                        <el-option label="李四" value="2"></el-option>
                        <el-option label="王五" value="2"></el-option>
                    </el-select>
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
                <!-- <TableProxy :url="mainurl" :param="mainparam" :reload="dataTableReload"> -->
                <el-table :data="mainData" border highlight-current-row style="width: 100%">
                    <el-table-column label="序号" align="center"  type="index" width="65">
                    </el-table-column>

                    <el-table-column prop="delivery_num" label="发货单号" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="delivery_status" label="发货状态" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="cus_name" label="客户姓名" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="goods_name" label="商品名称" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="num" label="数量" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="goods_unit" label="商品单位" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="goods_category" label="商品分类" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="company_name" label="快递公司" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="express_num" label="快递单号" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="express_list_status" label="快递单打印状态" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="delivery_list_status" label="发货单打印状态" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="select_express" label="是否指定快递" align="center" width="200">
                    </el-table-column>
                    
                    <el-table-column prop="receive_name" label="收件人" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="receive_tel" label="收件人手机" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="weight" label="重量" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="send_fee" label="配送费" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="delivery_fee" label="快递费" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="express_list_time" label="快递单打印时间" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="delivery_list_time" label="发货单打印时间" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="delivery_time" label="发货时间" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="sale_time" label="销售时间" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="receive_time" label="签收时间" align="center" width="200">
                    </el-table-column>

                    <el-table-column prop="sale_name" label="销售人员" align="center" width="200">
                    </el-table-column>

                    <!-- <el-table-column  label="操作" align="center" width="200">
                        <template slot-scope="scope">
                            <el-button type="info" size="small" @click="showEdit(scope.row)">编辑</el-button>
                            <el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
                        </template>
                    </el-table-column> -->

                    <!-- <div slot="buttonbar">
                        <el-button type="primary" size="small" @click="showAdd">添加</el-button>
                    </div> -->
                </el-table>
                <!-- </TableProxy> -->
            </el-col>
        </el-row>
        <el-row >
            <el-col :span="12">
                <el-button type="primary" size="small" @click="addDelivery">发 货</el-button>     
                <el-button type="primary" size="small" @click="handleEdit">修 改</el-button>     
                <el-button type="primary" size="small" @click="setDropOrder">废 单</el-button>     
                <el-button type="primary" size="small" @click="handleReceive">签 收</el-button>     
                <el-button type="primary" size="small" @click="addContact">沟 通</el-button>     
                <el-button type="primary" size="small" @click="editAddress">修改地址</el-button>     
            </el-col>
            <el-col :span="12">
                <div class="pull-right">
                    <el-pagination
                        :current-page="currentPage"
                        :page-size="pageSize"
                        layout="total, prev, pager, next, jumper"
                        :total="total">
                    </el-pagination>   
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-tabs v-model="activeName" type="border-card" @tab-click="handleClick">
                <el-tab-pane label="发货明细" name="first">
                    <el-table :data="tableData1" border style="width: 100%">
                        <el-table-column prop="goods_name" label="商品" width="180"></el-table-column>
                        <el-table-column prop="goods_type_two" label="小类型" width="180"></el-table-column>
                        <el-table-column prop="num" label="数量" width="180"></el-table-column>
                        <el-table-column prop="goods_price" label="价格" width="180"></el-table-column>
                        <el-table-column prop="weight" label="重量" width="180"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="订单明细" name="second">
                    <el-table :data="tableData2" border style="width: 100%">
                        <el-table-column prop="order_num" label="订单编号" width="180"></el-table-column>
                        <el-table-column prop="cus_name" label="客户姓名" width="180"></el-table-column>
                        <el-table-column prop="buy_goods" label="购买商品" width="180"></el-table-column>
                        <el-table-column prop="buy_num" label="数量" width="180"></el-table-column>
                        <el-table-column prop="trade" label="成交时间" width="180"></el-table-column>
                        <el-table-column prop="sale_name" label="销售人员" width="180"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="历史快递" name="third">
                    <el-table :data="tableData3" border style="width: 100%">
                        <el-table-column prop="express_num" label="快递单号" width="180"></el-table-column>
                        <el-table-column prop="express_company" label="快递公司" width="180"></el-table-column>
                        <el-table-column prop="express_fee" label="快递费用" width="180"></el-table-column>
                        <el-table-column prop="recevie_name" label="签收人" width="180"></el-table-column>
                        <el-table-column prop="receive_time" label="客户签收时间" width="180"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="收货地址" name="fourth">
                    <el-table :data="tableData4" border style="width: 100%">
                        <el-table-column prop="cus_name" label="客户姓名" width="180"></el-table-column>
                        <el-table-column prop="province" label="省" width="180"></el-table-column>
                        <el-table-column prop="city" label="市" width="180"></el-table-column>
                        <el-table-column prop="zone" label="区" width="180"></el-table-column>
                        <el-table-column prop="address" label="收货详细地址" width="180"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="沟通联系" name="five">
                    <el-table :data="tableData5" border style="width: 100%">
                        <el-table-column prop="cus_name" label="客户姓名" width="180"></el-table-column>
                        <el-table-column prop="contact_time" label="沟通时间" width="180"></el-table-column>
                        <el-table-column prop="contact_name" label="沟通人" width="180"></el-table-column>
                        <el-table-column prop="contact_content" label="沟通内容" width="180"></el-table-column>
                    </el-table>
                </el-tab-pane>
                <el-tab-pane label="操作记录" name="six">
                    <el-table :data="tableData6" border style="width: 100%">
                        <el-table-column prop="handle_time" label="操作时间" width="180"></el-table-column>
                        <el-table-column prop="handle_name" label="操作人" width="180"></el-table-column>
                        <el-table-column prop="change_content" label="变更内容明细" width="180"></el-table-column>
                    </el-table>
                </el-tab-pane>
            </el-tabs>
        </el-row>
        <!-- 写弹窗组件 -->
        <add-delivery name='add-delivery'
            :ajax-proxy="ajaxProxy">
        </add-delivery>

        <handle-edit name='handle-edit'
            :ajax-proxy="ajaxProxy">
        </handle-edit>

        <set-drop-order name='set-drop-order'
            :ajax-proxy="ajaxProxy">
        </set-drop-order>

        <handle-receive name='handle-receive'
            :ajax-proxy="ajaxProxy">
        </handle-receive>

        <add-contact name='add-contact'
            :ajax-proxy="ajaxProxy">
        </add-contact>

        <edit-address name='edit-address'
            :ajax-proxy="ajaxProxy">
        </edit-address>
    </div>
</template>
<script>
import PageMix from '../../mix/Page';
import SearchTool from '../../mix/SearchTool';
import DataTable from '../../mix/DataTable';

import AddDelivery from './AddDelivery';
import HandleEdit from './HandleEdit';
import SetDropOrder from './SetDropOrder';
import HandleReceive from './HandleReceive';
import AddContact from './AddContact';
import EditAddress from './EditAddress';
export default {
    name: 'DistributionDelivery',
    pageTitle:"配送发货",
    mixins:[PageMix,SearchTool,DataTable],
    components:{
        AddDelivery,
        HandleEdit,
        SetDropOrder,
        HandleReceive,
        AddContact,
        EditAddress,
    },
    data(){
        return {
            mainparam:"",
            mainurl:'',
            ajaxProxy:'',
            searchForm:{
                dc:'',
                goods_type:'',
                goods_category:'',
                goods_name:'',
                sale_name:'',
                start:'',
                end:'',
                cus_name:'',
                cus_tel:'',
                company_name:'',
                delivery_status:'',
                delivery_type:'',
                delivery_name:'',
            },
            mainData:[
                {   delivery_num:'201803091508',
                    delivery_status:'已发',
                    cus_name:'礼泉',
                    goods_name:'神油',
                    num:'100',
                    goods_unit:'瓶',
                    goods_category:'补身-补水-补肾',
                    company_name:'顺丰',
                    express_num:"201803091509",
                    express_list_status:'是',
                    delivery_list_status:'是',
                    select_express:'是',
                    receive_name:'张无忌',
                    receive_tel:'13666666666',
                    weight:'100kg',
                    send_fee:'10',
                    delivery_fee:'88',
                    express_list_time:'2018-03-09',
                    delivery_list_time:'2018-03-09',
                    delivery_time:'2018-03-09',
                    sale_time:'2018-03-09',
                    receive_time:'2018-03-09',
                    sale_name:"赵敏",
                },
            ],
            tableData1:[
                {goods_name:'神油啊',goods_type_two:'补肾',num:100,goods_price:100.11,weight:'100kg',},
                {goods_name:'神油啊',goods_type_two:'补肾',num:100,goods_price:100.11,weight:'100kg',},
                {goods_name:'神油啊',goods_type_two:'补肾',num:100,goods_price:100.11,weight:'100kg',},
                {goods_name:'神油啊',goods_type_two:'补肾',num:100,goods_price:100.11,weight:'100kg',},
                {goods_name:'神油啊',goods_type_two:'补肾',num:100,goods_price:100.11,weight:'100kg',},
                {goods_name:'神油啊',goods_type_two:'补肾',num:100,goods_price:100.11,weight:'100kg',},
            ],
            tableData2:[
                {order_num:'201803061545',cus_name:'李四',buy_goods:'神油2号',buy_num:100,trade:'2018-03-09',sale_name:'李思思',},
                {order_num:'201803061545',cus_name:'李四',buy_goods:'神油2号',buy_num:100,trade:'2018-03-09',sale_name:'李思思',},
                {order_num:'201803061545',cus_name:'李四',buy_goods:'神油2号',buy_num:100,trade:'2018-03-09',sale_name:'李思思',},
                {order_num:'201803061545',cus_name:'李四',buy_goods:'神油2号',buy_num:100,trade:'2018-03-09',sale_name:'李思思',},
            ],
            tableData3:[
                {express_num:'201803091148',express_company:'顺丰',express_fee:88,recevie_name:'王武',receive_time:'2018-03-09',},
                {express_num:'201803091148',express_company:'顺丰',express_fee:88,recevie_name:'王武',receive_time:'2018-03-09',},
                {express_num:'201803091148',express_company:'顺丰',express_fee:88,recevie_name:'王武',receive_time:'2018-03-09',},
                {express_num:'201803091148',express_company:'顺丰',express_fee:88,recevie_name:'王武',receive_time:'2018-03-09',},
                {express_num:'201803091148',express_company:'顺丰',express_fee:88,recevie_name:'王武',receive_time:'2018-03-09',},
            ],
            tableData4:[
                {cus_name:'王五',province:'广州',city:'深圳',zone:'天台',address:'八成八成八成八成八成',},
                {cus_name:'王五',province:'广州',city:'深圳',zone:'天台',address:'八成八成八成八成八成',},
                {cus_name:'王五',province:'广州',city:'深圳',zone:'天台',address:'八成八成八成八成八成',},
                {cus_name:'王五',province:'广州',city:'深圳',zone:'天台',address:'八成八成八成八成八成',},
                {cus_name:'王五',province:'广州',city:'深圳',zone:'天台',address:'八成八成八成八成八成',},
            ],
            tableData5:[
                {cus_name:'美丽',contact_time:'2018-03-01',contact_name:'好丑',contact_content:'好丑好丑好丑好丑好丑好丑好丑',},
                {cus_name:'美丽',contact_time:'2018-03-01',contact_name:'好丑',contact_content:'好丑好丑好丑好丑好丑好丑好丑',},
                {cus_name:'美丽',contact_time:'2018-03-01',contact_name:'好丑',contact_content:'好丑好丑好丑好丑好丑好丑好丑',},
                {cus_name:'美丽',contact_time:'2018-03-01',contact_name:'好丑',contact_content:'好丑好丑好丑好丑好丑好丑好丑',},
                {cus_name:'美丽',contact_time:'2018-03-01',contact_name:'好丑',contact_content:'好丑好丑好丑好丑好丑好丑好丑',},
                {cus_name:'美丽',contact_time:'2018-03-01',contact_name:'好丑',contact_content:'好丑好丑好丑好丑好丑好丑好丑',},
            ],
            tableData6:[
                {handle_time:'2018-03-01',handle_name:'李福清',change_content:'李福清李福清李福清李福清',},
                {handle_time:'2018-03-01',handle_name:'李福清',change_content:'李福清李福清李福清李福清',},
                {handle_time:'2018-03-01',handle_name:'李福清',change_content:'李福清李福清李福清李福清',},
                {handle_time:'2018-03-01',handle_name:'李福清',change_content:'李福清李福清李福清李福清',},
                {handle_time:'2018-03-01',handle_name:'李福清',change_content:'李福清李福清李福清李福清',},
            ],
            currentPage:1,
            pageSize:10,
            total:100,
            pickerOptions0: {
                disabledDate(time) {
                    return time.getTime() > Date.now();//- 8.64e7
                }
            },
            pickerOptions1: {
                disabledDate(time) {
                    return time.getTime() < Date.now()- 8.64e7;//
                }
            },
            activeName:'first',
        }
    },
    methods:{
        setStartTime(v){
            this.searchForm.start = v;
        },
        setEndTime(v){
            this.searchForm.end = v;
        },
        addDelivery(){
            this.$modal.show('add-delivery');
        },
        handleEdit(){
            this.$modal.show('handle-edit');
        },
        setDropOrder(){
            this.$modal.show('set-drop-order');
        },
        handleReceive(){
            this.$modal.show('handle-receive');
        },
        addContact(){
            this.$modal.show('add-contact');
        },
        editAddress(){
            this.$modal.show('edit-address');
        },  
        handleClick(tab, event){
            console.log(tab, event);
        }
    },
    created(){

    },
    mounted(){

    },
    
}
</script>
<style scoped>

</style>

