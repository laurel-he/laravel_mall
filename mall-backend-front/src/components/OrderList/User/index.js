
import exchange from "../exchange";
import addDialog from "../Add.vue";
import Advance from './Advance.vue';

import deleteMix from '@/mix/Delete';
import DataProxy from '@/packages/DataProxy';
import TableProxy from '../../common/TableProxy';
import OrderBasic from '@/ajaxProxy/OrderBasic';

import mix from '../mix';
import { mapGetters  } from 'vuex';

export default {
    name: 'OrderList',
    pageTitle:"订单详情",
    mixins: [mix,deleteMix],
    components:{
        addDialog,exchange,Advance
    },
    data () {
        return {
            ajaxProxy:OrderBasic,
            orderBasicAjaxProxy:OrderBasic,
            mainurl:OrderBasic.getUrl(),
            mainparam:"",
            daterange:'',
            searchForm:{
                phone:'',
                start:'',
                goods_name:'',
                consignee:'',
                sn:'',
                // deal_name:'',
                end:'',
                condition:'',
                deal_id:'',
                value7:"",

                // hyf 添加
                status:"", //订单状态 
                product_status:"", //货物状态
                after_sale_status:"",//售后状态,
                appends:['status_text','product_status_text','after_sale_status_text']

            },
            // tableData: '',
            bubble:null,
            
            value6: '',
            value7: '',
            dbRow:null,
            row_model:''
        }
    },
    computed:{
        ...mapGetters([
            'user_id'
          ])
    },
    methods:{
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        showRowData(row){
            this.$modal.show('rowInfo',{rowData:row});
        },
        


        /** 点击订单列表展示用户信息 */
        showRow(row){
            this.dbRow = row;
        },
       
        All:function(){
            this.orderlistInit();
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
        delivesearch:function($criteria){
            this.searchToolReset('searchForm');
            this.searchForm.deliver=$criteria;
            this.searchToolChange('searchForm');
        },
        typeChange:function(v){
            this.typeName=this.conditions[v];
        },
        // showAdd:function(){
        //     this.$modal.show('add-orderBasic');
        // },
        startDateChange:function(v){
            if (v) {
                var sdate = v.split(' - ');
                this.searchForm.start = sdate[0] + " 00:00:00";
                this.searchForm.end = sdate[1] + " 23:59:59";
            }  else {
                this.searchForm.start = "";
                this.searchForm.end = "";
            }
        },
       
        onSearchChange(param){
            param.deal_id = this.user_id;
            this.mainparam = JSON.stringify(param);
        },
       
    },
    created(){
        let o = {};
        o['row-dblclick'] = this.showRow;
        this.bubble = o;

        this.onSearchChange(this.searchForm);
        this.$on('search-tool-change', this.onSearchChange);
    }
}