import Add from './Add';
import Edit from './Edit';
import Spec from './Spec';

//import DataProxy from '../../packages/DataProxy';
import SearchTool from '../../../mix/SearchTool';
import DataTable from '../../../mix/DataTable';
import SelectProxy from  '../../../packages/SelectProxy';
import GoodsDetailsAjaxProxy from '../../../ajaxProxy/GoodsDetails';
import { quillRedefine } from 'vue-quill-editor-upload';
import URL_CONST from '../../../config';

export default {
    name: 'AdminIndex',
    pageTitle: "商品详情",
    mixins: [SearchTool,DataTable,GoodsDetailsAjaxProxy],
    components:{
        Add,
        Edit,
        Spec,
        quillRedefine,
    },
    data() {
        return {
            ajaxProxy:GoodsDetailsAjaxProxy,
            mainparam:"",
            mainurl:GoodsDetailsAjaxProxy.getUrl(),
            cateOptions:[],
            UnitTypes:{},
            getCateCascaderUrl:"/tree",
            uploadUrl: URL_CONST.UPLOAD_URL,
            urlDomain: URL_CONST.DOMAIN,
            searchForm: {
                goods_name:'',
                goods_number:'',
                start:'',
                end:'',
                cate_id:[],
                with:['category'],
                orderField:'id',
                orderWay:'desc'
            },
            pickerOptions: {
                disabledDate(time) {
                    return time.getTime() > Date.now();//- 8.64e7
                }
            },
            cidMapTypeId:{}

        }
    },
    methods: {

        getAjaxProxy(){
            return this.ajaxProxy;
        },
        initCateOptions(data){
            this.cateOptions = data.items;
            this.setTypeMap(this.cateOptions);
        },
        initUnitTypes(data){
            this.UnitTypes = data;
        },
        getCateCascader(){
            let selectProxy = new SelectProxy(this.getCateCascaderUrl,this.initCateOptions,this);
            selectProxy.load();
        },
        getUnitTypes(){
            let selectProxy = new SelectProxy("/goodsdetails",this.initUnitTypes,this);
            selectProxy.setExtraParam({business:'UnitTypes'}).load();
        },
        setUnitTypes(v){
            return this.UnitTypes[v];
        },
        onSearchChange(param) {
            if (this.searchForm.start > this.searchForm.end) {
                this.$message.error("请选择正确的时间段");
                return ;
            }
            this.mainparam = JSON.stringify(param);
        },
        showAdd(){
            this.$modal.show('add-goods-details',{model:this.UnitTypes});
        },
        showEdit(id){
            this.$modal.show('edit-goods-details', {
              id: id,
              extra: this.UnitTypes,
            });
        },
        showSpec(row){
            // console.log('asdf');
            this.$modal.show('edit-goods-spec', {model: row});
            // console.log('asdf----------bbbbb');
        },
        handleCateChange(v){
            this.searchForm.cate_id = v;
        },
        getStartTime(v){
            this.searchForm.start = v;
        },
        getEndTime(v){
            this.searchForm.end = v;
        },

        displayCategory(category){
            let cate = [];
            for (let index = 0; index < category.length; index++) {
                cate.push(category[index].label);
            }
            return cate.join(" / ");
        },
        setStatusChange(row){
            this.ajaxProxy.update(row.id, {status:row.status}).catch((response)=>{
                this.$message.error('更新失败');
                row.status = row.status == 1 ? 2 : 1 ;
            });
        },
        setHotgoodsChange(row){
            this.ajaxProxy.update(row.id, {hot_goods:row.hot_goods}).catch((response)=>{
                this.$message.error('更新失败');
                row.hot_goods = row.hot_goods == 1 ? 0 : 1 ;
            });
        },
        setNewgoodsChange(row){
            this.ajaxProxy.update(row.id, {new_goods:row.new_goods}).catch((response)=>{
                this.$message.error('更新失败');
                row.new_goods = row.new_goods == 1 ? 0 : 1 ;
            });
        },
        setTypeMap(data){
            // this.cidMapTypeId = {};
            this.mapType(data);
        },

        mapType(data){
            if (data instanceof Array) {
                data.forEach(function(value, index, arr){
                    if (value.children) {
                        this.mapType(value.children);
                    }
                    for (let i = 0; i < arr.length; i++) {
                        const element = arr[i];
                        this.cidMapTypeId[element.id] = element.type_id;
                    }
                }, this);
            }
        }
    },

    created() {
        this.$on('search-tool-change', this.onSearchChange);
        this.getCateCascader();
        this.getUnitTypes();

        this.mainparam = JSON.stringify({with:['category'], orderField:'id',orderWay:'desc'});
        
    },

}