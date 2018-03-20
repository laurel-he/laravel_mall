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
        /* mainTableLoad(data) {
            this.toggleTableLoad();
            let res_data = data.items;
            for(var x in res_data){
                // console.log(res_data[x]);
                res_data[x].new_goods = res_data[x].new_goods ==1 ? true : false;
                res_data[x].hot_goods = res_data[x].hot_goods ==1 ? true : false;
                res_data[x].recommend_goods = res_data[x].recommend_goods ==1 ? true : false;
                res_data[x].status = res_data[x].status ==1 ? true : false;

            }
                console.log(res_data);
            this.tableData = res_data;
            this.total = data.total;
        }, */
        getAjaxProxy(){
            return this.ajaxProxy;
        },
        initCateOptions(data){
            this.cateOptions = data.items;
            this.setTypeMap(this.cateOptions);

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
            // param.with = ['category'];
            this.mainparam = JSON.stringify(param);
        },
        showAdd(){
            this.$modal.show('add-goods-details',{model:this.UnitTypes});
        },
        showEdit(id){
            // let fileList = [];
            // row.del_imgs = [];
            // row.img_path = [];
            // row.cate_id = [];
            
            // for (let index = 0; index < row.category.length; index++) {
            //     row.cate_id.push(row.category[index].id);
            // }
            // for (let index = 0; index < row.imgs.length; index++) {
            //     fileList.push({name:row.imgs[index].url, url:row.imgs[index].full_url});  
            // }

            this.$modal.show('edit-goods-details', {
              id: id,
              extra: this.UnitTypes,
            //   fileList: fileList,
            });
        },
        showSpec(row){
            this.$modal.show('edit-goods-spec', {
              model: row
            });
        },
        handleCateChange(v){
            //console.log(v);
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
            console.log(arguments);
            // row.del_imgs = [];
            // row.img_path = [];
            // row.cate_id = [];
            this.ajaxProxy.update(row.id, {status:row.status}).catch((response)=>{
                this.$message.error('更新失败');
                row.status = row.status == 1 ? 2 : 1 ;
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