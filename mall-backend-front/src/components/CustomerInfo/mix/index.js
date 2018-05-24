import Add from "../Add";
import Edit from "../Edit";
import Chat from "../Chat";
import Plan from "../Plan";
import addOrder from "../addOrder";
import addAddress from "../addAddress";
import Transfer from '../Transfer';
import QuitDepart from '../QuitForDepart';
import Quit from '../Quit';
import OtherContact from '../OtherContact';
import AddTrack from '../AddTrack';
import SubDetail from '../SubDetail';
import AddComplain from '../AddComplain';
import preCheck from '../preCheck';

import DataTable from '@/mix/DataTable';
import SearchTool from '@/mix/SearchTool';

import Customer from '@/ajaxProxy/Customer';
import OrderBasic from '@/ajaxProxy/OrderBasic';
import SelectProxy from  '@/packages/SelectProxy';

import CustomerSelect from '@/packages/CustomerSelectProxy';
import AreaSelect from '@/packages/AreaSelectProxy';

import DeliveryAddress from '@/ajaxProxy/DeliveryAddress';
import PlanAjax from '@/ajaxProxy/Plan';


const mix = {
    mixins: [DataTable,SearchTool],
    components: {
        // advancedQuery,
        Add,
        // Chat,
        Edit,
        addOrder,
        addAddress,
        Transfer,
        QuitDepart,
        Quit,
        OtherContact,
        AddTrack,
        SubDetail,
        Plan,
        preCheck,
	    AddComplain,
    },
    data(){
        return {
            addressData:'',
            CategoryList:'',
            addressAjaxProxy:DeliveryAddress,
            ajaxProxy:Customer, 
            planAjaxProxy:PlanAjax,
            mainurl:Customer.getUrl(),
            customerType:{},
            customerSource:{},
            orderBasicAjaxProxy:OrderBasic,
            model:null,
            pageSize:15,
            mainparam:'',
            complainType:{},
            isbaractive:false,
            mainHeight: 400
        }
    },
    methods:{
        
        openAdd(){
            this.$modal.show('add-customerinformation',{
                extra:this.cusData,
            });
        },
        openEdit(row){
            this.$modal.show('edit-customerinformation', {model:row,extra:this.cusData,});
        },
        openAddDeliveryAddress(row){
            this.$modal.show('add-Address', {model:row});
        },
        addTrackLog(){
            if (this.selectRowCheck()) {
                this.$modal.show('add-track',{model:this.model});
            }
        },
        openAddOrder(row){
            this.$modal.show('add-orderBasic', {model:row});
        },
        addOtherContact(){
            if (this.selectRowCheck()) {
                this.$modal.show('other-contact',{model:this.model});
            }
        },
        onSearchChange(param){
            param['with']=['contacts', 'midRelative'];
            param['appends'] =['type_text'];
            this.mainparam = JSON.stringify(param);
        },
        getCategoryList(data){
            this.CategoryList=data.items;
        },
        getAddressData(data){
            this.addressData=data.items;
        },
        getCategory(){
            let selectProxy = new SelectProxy('/tree', this.getCategoryList, this);
            selectProxy.load();
        },
        getAddress(){
            let selectProxy = new SelectProxy(DeliveryAddress.getUrl(), this.getAddressData, this);
            selectProxy.load();
        },
        getComplainType(data) {
            this.complainType = data;
        },
        setComplainType() {
            let customerSelect = new CustomerSelect(null, this.getComplainType, this);
            customerSelect.setParam({ business: 'complainType' }).load();
        },
        getCustomerType(data){
            this.cusData['type'] = data;
        },
        setCustomerType(){
            let customerSelect = new CustomerSelect(null,this.getCustomerType,this);
            customerSelect.setParam({business:'customerType'}).load();
        },
        getCustomerSource(data){
            this.cusData['source'] = data;
        },
        setCustomerSource(){
            let customerSelect = new CustomerSelect(null,this.getCustomerSource,this);
            customerSelect.setParam({business:'customerSource'}).load();
        },
        getAreaProvinces(data){
            this.cusData['provinces'] = data;
        },
        setAreaProvinces(){
            let areaSelect = new AreaSelect({pid:1},this.getAreaProvinces,this);
            areaSelect.load();
        },
        rowCellClick(row){
            this.model=row;
        },
        hasCurrentRow(){
            if (this.model) {
                return true;
            } else {
                return false;
            }
        },
        selectRowCheck(){
            if (!this.hasCurrentRow()) {
                this.$alert('请选择一行', '警告', {
                    confirmButtonText: '确定',
                })
                return false;
            } else {
                return true;
            }
        },

        resetB(){
            this.searchForm.user_business = "";
            this.searchForm.type = "";
            this.searchForm.source="";
        },
        setBusiness(value){
            this.resetB();
            this.searchForm.user_business = value;
            
            this.onSearchChange(this.searchForm);
        },
        setType(value){
            this.resetB();
            this.searchForm.type = value;
            this.onSearchChange(this.searchForm);
        },
        setSourceType(value){
            this.resetB();
            this.searchForm.source = value;
            this.onSearchChange(this.searchForm);
        },
        addComplain(){
            if (this.selectRowCheck()) {
                this.$modal.show('add-complain', { model: this.model,
                    extra:this.complainType});
            }
        },
        setPlan(){
            if (this.selectRowCheck()) {
                this.$modal.show('plan', {model: this.model});
            }
        },
	    preCheck(){
            this.$modal.show('preCheck');
        },

        barEnter(event){
            if (this.isbaractive) {
                if (this.mainHeight >= 100 && this.mainHeight <= 500) {
                    this.mainHeight = this.mainHeight + event.movementY;
                    if (this.mainHeight< 100) {
                        this.mainHeight = 100;
                        // this.$message('到顶了');
                    } 

                    if (this.mainHeight > 500) {
                        this.mainHeight = 500;
                        // this.$message('到顶了');
                    }
                } 
                
            }
        },

        activeMove(event){
            this.isbaractive = true;
        },
        deactiveMove(event){
            this.isbaractive = false;
        }

    },
    created(){
        this.setCustomerType();
        this.setCustomerSource();
        this.setAreaProvinces();
        this.setComplainType();
    }  
};

export default mix;
