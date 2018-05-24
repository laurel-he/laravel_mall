<template>
        <div>
            <MyDialog title="发起换货" :name="name" :width="width" :height="height" @before-open="onOpen" @before-close="onBeforeClose">
                <el-form ref="rowInfoForm" :model="rowInfoForm" :label-width="labelWidth" :label-position="labelPosition">
                    <el-steps :space="250" :active="active" finish-status="success" :center="true" :align-center="true">
                        <el-step title="选择退回的商品"></el-step>
                        <el-step title="添加更换的商品"></el-step>
                        <el-step title="填写备注"></el-step>
                    </el-steps>
                    <div v-show="active == 0">
                        <h5>订单信息</h5>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="订单号" prop="id">
                                    {{ model.order_sn }}
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="总金额" prop="order_all_money">
                                    {{ model.order_all_money }} 元
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="订单状态" prop="status">
                                    {{　model.status_text }}
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <h5>勾选要替换的商品</h5>
                        <el-row>
                            <el-col :span="24">
                                <el-table :data="goods" @selection-change="handleSelectionChange">
                                    <el-table-column type="selection" width="55"></el-table-column>
                                    <el-table-column label="商品名称" prop="goods_name"></el-table-column>
                                    <el-table-column label="商品编号" prop="sku_sn" width="120"></el-table-column>
                                    <el-table-column label="数量"     prop="goods_number" width="160">
                                            <template slot-scope="scope">
                                                <el-input-number size="small" :min="1" :controls="false" :max="scope.row.goods_number"  v-model="scope.row.goods_num" @change="numberChange"></el-input-number>
                                            </template>
                                    </el-table-column>
                                    <el-table-column label="单价" prop="price" width="100"></el-table-column>
                                </el-table>
                            </el-col>
                        </el-row>
                    </div>
    
                    <div v-show="active == 1">
                        <h5>将更换成以下商品</h5>
                        <el-row>
                            <el-col :span="24">
                                <el-table :data="rowInfoForm.goods" >
                                    <el-table-column label="商品名称" prop="goods_name"></el-table-column>
                                    <el-table-column label="商品编号" prop="sku_sn" width="120"></el-table-column>
                                    <el-table-column label="数量"    prop="goods_number"  width="160">
                                        <template slot-scope="scope">
                                            <el-input-number size="small" :min="1" :controls="false" :max="scope.row.goods_num"  v-model="scope.row.goods_number" @change="numberChange"></el-input-number>
                                        </template>
                                    </el-table-column>
                                    <el-table-column label="单价"  prop="price" width="100"></el-table-column>
                                    <el-table-column label="操作"  width="100">
                                        <template slot-scope="scope">
                                            <el-button type="danger" @click="del_row(scope.$index)" size="small">删除</el-button>
                                        </template>
                                    </el-table-column>
                                </el-table>
                            </el-col>
                        </el-row>
                        <br>
                        <el-row>
                            <el-col :span="24">
                                <el-button size="small" @click="changeNew">直接换新</el-button>
                                <el-button size="small" @click="changeOther">添加新商品</el-button>
                            </el-col>
                        </el-row>
                        <div v-show="addOther">
                            <br>
                             <el-form ref="exchangeForm" :model="exchangeForm">
                                
                                     <el-row>
                                         <el-col :span="12">
                                                 <el-form-item label="商品分类" prop="dev">
                                                     <el-cascader
                                                             v-model="exchangeForm.dev"
                                                             :options="CategoryList"
                                                             @change="categoryChange">
                                                     </el-cascader>
                                                 </el-form-item>
                                         </el-col>
                                         <el-col :span="12">
                                             <el-form-item prop="goods_id" label="商品名称">
                                                 <el-select v-model="exchangeForm.goods_id" @change="getGoodsInfo">
                                                     <el-option v-for="(value, item) in data2" :value="item" :key="item" :label="value.goods_name+'-'+value.sku_name+'-'+value.price">
                                                         <span>{{value.goods_name}}{{value.sku_name.length > 0 ? '-'+value.sku_name: ''  }}-{{value.price}}</span>
                                                     </el-option>
                                                 </el-select>
                                             </el-form-item>
                                         </el-col>
                                     </el-row>
                                     <el-row>
                                         <el-col :span="12">
                                             <el-form-item prop="goods_number" label="商品数量">
                                                 <el-input-number size="small" :min="1"   v-model="exchangeForm.goods_number" ></el-input-number>
                                             </el-form-item>
                                         </el-col>
                                         <el-col :span="12">
                                             <el-form-item prop="remark" label="备注">
                                                 <el-input type="textarea" class="name-input"  v-model="exchangeForm.remark"  placeholder="备注" ></el-input>
                                             </el-form-item>
                                         </el-col>
                                     </el-row>
                                     <el-row type="flex" justify="center">
                                         <el-col :span="5">
                                            <el-button size="small" type="info" @click="addOrder">添加</el-button>
                                         </el-col>
                                     </el-row>
                                 
                             </el-form>
                        </div>
                        
                    </div>
                    <div v-show="active == 2">
                        <h5>备注</h5>
                        <!-- <el-row>
                            <el-col :span="20">
                                <el-form-item label="差价计算">
                                    <el-col :span="8">
                                        <el-input size="small" v-model="this.difference_money" :disabled="true"></el-input>
                                    </el-col>
                                    <el-col :span="2">&nbsp;</el-col>
                                    <el-col :span="4">
                                            <el-button size="small"  @click="difference_price">计算</el-button>
                                    </el-col>
                                </el-form-item>
                            </el-col>
                            
                        </el-row> -->
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="备注" prop="remark">
                                    <el-input type="textarea" :rows="2" v-model="rowInfoForm.remark" placeholder="请输入内容">
                                    </el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>

                                <el-row>
                                    <el-col :span="16">
                                        <el-form-item v-for="(items,index) in rowInfoForm.express" :label="'快递号'+(index+1)"
                                                      :key="index" :prop="'express.'+index+'.express_sn'">

                                                    <el-col :span="12">
                                                        <el-input placeholder="快递号" size="small" v-model="items.express_sn">
                                                        </el-input>
                                                    </el-col>
                                                    <el-col :span="1">&nbsp;</el-col>
                                                    <el-col :span="5">
                                                        <el-button v-if="index!==0" size="small"   @click.prevent="removeExpress(items)">
                                                            删除
                                                        </el-button>
                                                    </el-col>
                                        </el-form-item>
                                        <el-form-item>
                                            <el-button   size="small" type="info" icon="plus" @click="addExpress">添加快递号
                                            </el-button>
                                        </el-form-item>
                                        
                                    </el-col>
                                </el-row>
                    </div>
                </el-form>
    
                <div slot="dialog-foot" class="dialog-footer">
                    <el-row type="flex" justify="space-between">
                        <el-col :span="12" class="button_step">
                            <el-button v-if="active>0"  @click="prev" class="pull-left">上一步</el-button>
                            <el-button v-if="active==0 || active==1" @click="next" class="pull-left">下一步</el-button>
                        </el-col>
                        <el-col :span="12">
                            <el-button @click="handleClose">取 消</el-button>
                            <submit-button v-show="active==2" :observer="dialogThis" @click="formSubmit('rowInfoForm')">
                                保 存
                            </submit-button>
                        </el-col>
                    </el-row>
                    
    
                    
                </div>
            </MyDialog>
        </div>
    </template>
    
    <script>
        import DialogForm from '../../mix/DialogForm';
        import OrderGoodsAjaxProxy from '@/ajaxProxy/Ordergoods';
        import SelectProxy from  '../../packages/SelectProxy';
        import EntrepotProductAjaxProxy from '@/ajaxProxy/EntrepotProduct';
        import GoodsSelectProxy from '../../packages/GoodsSelectProxy';

        import AfterSaleAjaxProxy from '@/ajaxProxy/AfterSale';

        import { mapGetters } from 'vuex';
        export default {
            name: 'ExchangeGoods',
            mixins: [DialogForm],
            props: {
    
            },
            ajaxProxy: {
                required: true,
                type: Object,
                default: null
            },
            data() {
                return {
                    addOther:false,
                    dialogThis: this,
                    labelPosition: "right",
                    labelWidth: '70px',
                    CategoryList:[],
                    CategoryChildrenList:[],
                    difference_money:0,
                    rowInfoForm: {
                        cus_id:"",
                        order_id: "",
                        goods: [],
                        refund:0.00,
                        express:[
                            {express_sn:''}
                        ],
                        remark:'',
                        type:1,
                        user_id:'',
                        user_name:'',
                        group_id:'',
                        department_id:'',
                        entrepot_id:''

                    },
                    exchangeForm:{
                        dev:[],
                        goods_id:'',
                        goods_number:'',
                        remark:'',
                    },
                    goods:[],
                    pop_goods_index:[],
                    model: {},
                    data2:{},
                    totalMoney:0,
                    selected_money:0,
                    multipleSelection:[],
                    goods_data:[],
                    active:0
                }
            },
            computed:{
                ...mapGetters([
                    'getUser'
                ]),
            },
            methods: {
                
                removeExpress(item){
                    var index = this.rowInfoForm.express.indexOf(item);
                    if (index !== -1) {
                        this.rowInfoForm.express.splice(index, 1);
                    }
                },
                sum_price(arr){
                    if (arr.length > 0) {
                        let total = 0;
                        for(let v in arr){
                            total += parseInt(arr[v]['goods_number']) * parseInt(arr[v]['price']);
                        }
                        return   total;
                    }

                },
                difference_price(){
                    this.difference_money = (this.sum_price(this.rowInfoForm.goods) - this.model.order_all_money).toFixed(2);
                    this.rowInfoForm.refund = this.difference_money;
                    return   this.difference_money;
                },
                addExpress(){
                    this.rowInfoForm.express.push({ express_sn: '' });
                },
                addOrder(){
                    var vmthis = this;
                    let moneyNotes =parseInt(this.data2[this.exchangeForm.goods_id].price) * parseInt(this.exchangeForm.goods_number);
                    let item = vmthis.data2[vmthis.exchangeForm.goods_id];
                    let addData ={
                        goods_id:    item.goods_id,
                        sku_id:      item.sku_id,
                        sku_name:    item.sku_name,
                        goods_name:  item.goods_name,
                        price:       item.price,
                        goods_number:vmthis.exchangeForm.goods_number,
                        remark:      vmthis.exchangeForm.remark,
                        moneyNotes:  moneyNotes,
                        sku_sn:      item.sku_sn,
                        unit_type:   item.unit_type,
                        type:       2
                    };
                    this.totalMoney += moneyNotes;
                    this.rowInfoForm.goods.push(addData);
                    console.log(this.rowInfoForm.goods);
                    this.$refs['exchangeForm'].resetFields();
                },

                loadGoods(data){
                    this.data2 = {};
                    for (let i = 0; i < data.items.length; i++) {
                        let gid1 = data.items[i].id;
                        let goods_name1 = data.items[i].goods_name;
                        let goods_price1 = data.items[i].goods_price;
                        let goods_number1 = data.items[i].goods_number;
                        let unit_type1 = data.items[i].unit_type;
                        let vv1 = this.contactItem(gid1, goods_price1, goods_name1, goods_number1, 0, '',  data.items[i].sku_sn,unit_type1);
                        let kk1 = 'goods_id_'+gid1+'_sku_id_0';
                        this.data2[kk1] = vv1;
                        if (data.items[i].skus.length > 0) {
                            this.contactChildren(data.items[i].skus, gid1, goods_name1,unit_type1);
                        }
                    }
                },
                contactItem(goods_id, price, name, num, sku_id, sku, sku_sn,unit_type){
                    return {goods_id: goods_id, price: price, goods_name: name,  num: num, sku_id:sku_id, sku_name:sku, sku_sn:sku_sn,unit_type:unit_type};
                },
                contactChildren(children, goods_id, goods_name,unit_type){
                    for (let i = 0; i < children.length; i++) {
                        const item = children[i];
                        let vv1 = this.contactItem(goods_id, item.price, goods_name, item.num, item.id, item.name, item.sku_sn,unit_type);
                        let kk1 = 'goods_id_'+goods_id+'_sku_id_'+ item.id;
                        this.data2[kk1] = vv1;
                    }
                },
                getCategory(){
                    let selectProxy = new SelectProxy('/tree', this.getCategoryList, this);
                    selectProxy.load();
                },
                getCategoryList(data){
                    this.CategoryList=data.items;
                },
                categoryChange(cate_id){
                    this.exchangeForm.goods_id = '';
                    this.goodsProxy.setParam({
                        cate_id:cate_id,
                        with:['skus'],
                        fields:['id','goods_name','goods_price','goods_number','sku_sn','unit_type']
                    }).load();
                },
                getGoodsInfo(goods_id){
                    if(this.data2[goods_id]){
                        EntrepotProductAjaxProxy.getEntrepotCount(this.data2[goods_id].sku_sn).then((data)=>{
                            this.gdsInpurNum = parseInt(data.data.num);
                            this.alertNum = parseInt(data.data.num);
                            this.allNum = this.alertNum;
                        })
                    }

                },
                onOpen(param) {
                    this.model = param.params;
                    this.goods_data =[];
                    OrderGoodsAjaxProxy.get({order_id: this.model.id}).then((response)=>{
                        response.data.items.forEach(element => {
                            element.goods_num = parseInt(element.goods_number);
                            element.type = 2;
                        });
                        this.goods = response.data.items;
                        this.rowInfoForm.goods=this.goods.slice(0);
                    });
                    this.rowInfoForm.order_id = this.model.id;
                    this.rowInfoForm.entrepot_id = this.model.entrepot_id;
                    this.rowInfoForm.user_id = this.getUser.id;
                    this.rowInfoForm.user_name = this.getUser.realname;
                    this.rowInfoForm.group_id = this.getUser.group_id;
                    this.rowInfoForm.department_id = this.getUser.department_id;
                    this.rowInfoForm.cus_id = this.model.cus_id;
                },
                onBeforeClose(){
                    this.multipleSelection = [];
                    this.active = 0;
                    this.addOther = false;
                },
                // getAjaxPromise(model) {
                //     return this.ajaxProxy.update(model.id, model);
                // },
                getAjaxPromise(model) {
                    for (let i = 0; i < model.goods.length; i++) {
                        let element = model.goods[i];
                        element.goods_num = element.goods_number;
                    }
                    return AfterSaleAjaxProxy.create(model);
                },
                handleSelectionChange(v){
                    for(let i in v){
                        let index =  this.rowInfoForm.goods.indexOf(v[i]);
                        if(index > -1){
                            this.rowInfoForm.goods.splice(index,1)
                        }
                    }
                    this.multipleSelection = v;
                    this.multipleSelection.forEach(element => {
                        element.type = 2;
                        element.type_text = '替换商品';
                    });
                },
                next(){
                    this.active ++ ;
                },
                prev(){
                    if (this.active > 1) {
                        this.active --;
                    } else {
                        this.active = 0;
                    } 
                },
                del_row(index){
                    this.rowInfoForm.goods.splice(index,1);
                },
                numberChange(){
                    this.$nextTick(function(){
                        this.sumPrice();
                    });
                },
                sumPrice(){
                    if (this.multipleSelection.length > 0) {
                        let goods_price = this.multipleSelection.map(element=>{
                            return element.goods_num * parseFloat(element.price);
                        });
                        this.rowInfoForm.refund = goods_price.reduce((ac, cu)=>{
                            return ac+cu;
                        }).toFixed(2);
                    } else {
                        this.rowInfoForm.refund ='0.00';
                    }  
                },
                changeNew(){
                    if(this.rowInfoForm.goods.length < this.goods.length){
                        for (let i = 0; i < this.multipleSelection.length; i++) {
                            let element = this.multipleSelection[i];
                            element.type = 2;
                        }
                        this.rowInfoForm.goods= this.rowInfoForm.goods.concat(this.multipleSelection);
                    }else{
                        return false;
                    }
                },
                changeOther(){
                    this.addOther = true;
                }
            },
            watch: {
                multipleSelection:function(val, oldVal){
                    //this.sumPrice();
                }
            },
            created(){
                this.getCategory();
                this.goodsProxy = new GoodsSelectProxy({}, this.loadGoods, this);
            }
    
        }
    </script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
        .button_step {
            text-align: left;
        }
        .name-input{
            max-width: 217px;
        }
    </style>
