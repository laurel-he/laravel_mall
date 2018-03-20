import Spec from './Spec';
import Edit from './Edit';

//import DataProxy from '../../packages/DataProxy';
import SearchTool from '../../../mix/SearchTool';
import DataTable from '../../../mix/DataTable';
import SelectProxy from  '../../../packages/SelectProxy';
import GoodsDetailsAjaxProxy from '../../../ajaxProxy/GoodsDetails';
import { quillRedefine } from 'vue-quill-editor-upload';
import URL_CONST from '../../../config';

export default {
    // name: 'AdminIndex',
    // pageTitle: "商品详情",
    mixins: [SearchTool,DataTable,GoodsDetailsAjaxProxy],
    components:{
        Edit,
        Spec,
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

        }
    },
    methods: {
       
        getAjaxProxy(){
            return this.ajaxProxy;
        },
        initCateOptions(data){
            this.cateOptions = data.items;
            //console.log(this.cateOptions);
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
            param.with = ['category'];
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
            this.$modal.show('edit-goods-spec', {
              model: row
            });
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
            console.log(row);
            row.del_imgs = [];
            row.img_path = [];
            row.cate_id = [];
            this.ajaxProxy.update(row.id, row);
        }

    },

    created() {
        this.$on('search-tool-change', this.onSearchChange);
        this.getCateCascader();
        this.getUnitTypes();

        this.mainparam = JSON.stringify({with:['category'], orderField:'id',orderWay:'desc'});
        
    },

}