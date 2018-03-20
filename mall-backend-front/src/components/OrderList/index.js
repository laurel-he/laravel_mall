import rowInfo from "./rowInfo";
import exchange from "./exchange";
import addDialog from "./Add.vue";
import DataTable from '../../mix/DataTable';
import PageMix from '../../mix/Page';
import config from '../../mix/Delete';
import DataProxy from '../../packages/DataProxy';
import SelectProxy from  '../../packages/SelectProxy';
import OrderlistAjaxProxy from '../../ajaxProxy/OrderBasic';
import UsersSelectProxy from '../../packages/UsersSelectProxy';
import BuyerAjaxProxy from '../../ajaxProxy/Buyer';
import OrdergoodsAjaxProxy from '../../ajaxProxy/Ordergoods';
import DeliveryAddressAjaxProxy from '../../ajaxProxy/DeliveryAddress';
import Tree from '../../ajaxProxy/Tree';
import Users from '../../ajaxProxy/Users';
import TableProxy from '../common/TableProxy';
import OrderBasic from '../../ajaxProxy/OrderBasic';
import SearchTool from "../../mix/SearchTool";
export default {
    name: 'OrderList',
    pageTitle:"订单详情",
    mixins: [PageMix,SearchTool,DataTable,config,OrderlistAjaxProxy],
    components:{
        rowInfo,addDialog,exchange
    },
    data () {
        return {
            ajaxProxy:OrderlistAjaxProxy,
            orderBasicAjaxProxy:OrderBasic,
            mainurl:OrderlistAjaxProxy.getUrl(),
            mainparam:"",
            dataLoad:false,
            addDialog: false,
            users:[],
            buyer:[],
            typeName:'请选择排名方式',
            conditions:["录入个数", "成交金额", "成交个数"],
            searchForm:{
                start:'',
                goods_name:'',
                consignee:'',
                id:'',
                sale_name:'',
                end:'',
                condition:'',
                department:'1',
                type:'',
                deliver:'',

            },
            tabindex:'0',
            currentPage4:1,
            tableData: '',
            manageData:[{
                order_id: '78786786',
                order_action: '提交订单',
                manager: 'admin',
                remark:'提交了一个新订单',
                time:'2018-01-22'
            }, {
                order_id: '23214',
                order_action: '取消订单',
                manager: '花花',
                remark:'取消了一个订单',
                time:'2018-01-23'
            }, {
                order_id: '7657657',
                order_action: '提交订单',
                manager: '丫丫',
                remark:'提交了一个新订单aa',
                time:'2018-02-22'
            }, {
                order_id: '78786786',
                order_action: '取消订单',
                manager: '花花',
                remark:'取消了一个订单',
                time:'2018-02-11'
            }],
            usertableData:[],
            usertableData1:[],
            addresstableData: [],
            goodstableData:[],
            CategoryList:'',
            buyer_id:'',
            pickerOptions2: {
                shortcuts: [{
                    text: '最近一周',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近三个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                        picker.$emit('pick', [start, end]);
                    }
                }]
            },
            value6: '',
            value7: ''
        }
    },
    watch:{
        addDialog(val, oldVal){
            console.log('index addDialog', val);
        }
    },
    methods:{
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        showRowData(row){
            this.$modal.show('rowInfo',{rowData:row});
        },
        showExchange(row){
            this.$modal.show('exchange',{rowData:row});
        },
        /** 发起退款弹窗  */
        open2(id) {
            this.$confirm('确认发起退款（需要审核）?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.refund(id),
                this.refresh(),
                this.$message({
                    type: 'success',
                    message: '发起退款成功!'
                });
        }).catch(() => {
                this.$message({
                type: 'info',
                message: '已取消'
            });
        });
        },

        /** 点击订单列表展示用户信息 */
        showRow(row){
            this.usertableData.splice(0,this.usertableData.length);
            /** 选项卡1显示客户信息 */
            let selectProxy = new SelectProxy(BuyerAjaxProxy.getUrl(), this.loadbuyer, this);
            selectProxy.setExtraParam({cus_id:row.cus_id}).load();
            /** 选项卡2获取订单商品信息 */
            let goodsProxy = new SelectProxy(OrdergoodsAjaxProxy.getUrl(), this.loadgoods, this);
            goodsProxy.setExtraParam({goods_id:row.goods_id,order_id:row.id}).load();
            /** 选项卡3获取用户地址信息 */
            let addressProxy = new SelectProxy(DeliveryAddressAjaxProxy.getUrl(), this.loaddelivery, this);
            addressProxy.setExtraParam({address_id:row.address_id}).load();
            /** 选项卡2显示订单商品信息 */
            this.loadbuyer2(row.cus_id);
        },

        getCategoryList(data){
            this.CategoryList=data.items;
        },
        dataReload:function(){
//          console.log(this.searchForm);
        },
        All:function(){
            this.orderlistInit();
        },
        typesearch:function($criteria){
            this.searchToolReset('searchForm');
            this.searchForm.type=$criteria;
            this.searchToolChange('searchForm');
        },
        refund(id)
        {
            let refundProxy = new SelectProxy(OrderlistAjaxProxy.getUrl(), this.loadtest, this);
            refundProxy.setExtraParam({refund_id:id}).load();

        },
        loadUsers(data) {
            this.users = data.items;
        },
        loadtest(data){
            this.mainData = data.items;
            // console.log(data.items);
        },
        loaddelivery(data){
            this.addresstableData = data.items;
        },
        loadbuyer(data) {
            this.usertableData1 = data.items;
            this.putbuyer(this.usertableData1);
        },
        putbuyer(data){
            var i=0;
            var id = this.buyer_id;
            console.log(data[0]);
            for(i=0;i<data.length;i++)
            {
                if(data[i].id==id)
                {
                    let addData ={
                        name:data[i].name,
                        sex:data[i].sex,
                        age:data[i].age,
                    };
                    this.usertableData.push(addData);
                }
            }
        },
        loadbuyer2(id){
            this.buyer_id = id;
        },
        loadcustomer(data){
            this.buyer = data.items;
        },
        loadgoods(data) {
            this.goods = data.items;
            this.goodstableData = this.goods;
        },
        /** 切换选项卡时查找对应信息 */
        handleClick(tab, event) {
            this.tabindex = tab.index;
        },
        show_all:function(){
            this.searchForm.type = '';
            this.searchForm.deliver = '';
            this.searchForm.goods_name = '';
            this.searchForm.consignee = '';
            this.searchForm.id = '';
            this.searchForm.sale_name = '';
            this.searchForm.end = '';
            this.searchForm.condition = '';
            this.searchForm.type = '';
            this.searchForm.deliver = '';
            this.searchForm.value7 = '';
            this.searchToolChange('searchForm');
            this.refresh();
        },
        refresh(){
            this.$emit('refresh-success');
        },
        delivesearch:function($criteria){
            this.searchToolReset('searchForm');
            this.searchForm.deliver=$criteria;
            this.searchToolChange('searchForm');
        },
        typeChange:function(v){
            this.typeName=this.conditions[v];
        },
        showAdd:function(){
            this.$modal.show('add-orderBasic');
        },
        startDateChange:function(v){
            var date = v.split('/');
            this.searchForm.start = date[0];
            this.searchForm.end = date[1];this.searchForm.start = date[0]+" 00:00:00";
            this.searchForm.end = date[1]+" 23:59:59";
        },
        mainTableLoad(data){
            this.toggleTableLoad();
            this.tableData = data.items;
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
//            console.log(param);
            this.mainparam = JSON.stringify(param);
        },
//        searchReset:function(){
//            this.$refs['searchForm'].resetFields();
//            this.typeName = '请选择排名方式';
//            this.toggleTableLoad();
//        },
        getCategory(){
            let selectProxy = new SelectProxy(Tree.getUrl(), this.getCategoryList, this);
            selectProxy.load();
        },
        click(){},

    },
    created(){
        let selectProxy = new SelectProxy(BuyerAjaxProxy.getUrl(), this.loadcustomer, this);
        selectProxy.load();
        this.$on('search-tool-change', this.onSearchChange);
        this.$on('refresh-success', this.handleReload);
        let orderProxy = new UsersSelectProxy(null, this.loadUsers, this);
        this.orderProxy = orderProxy;
        this.orderProxy.load();
        this.getCategory();


    }
}