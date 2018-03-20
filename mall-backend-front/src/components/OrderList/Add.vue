<template>
    <div >
        <MyDialog title="添加订单" :name="name" :width="width" :height="height">
            <br>
            <el-steps :space="280" :active="active" process-status="finish" finish-status="success" center align-center>
                <el-step title="选择客户"></el-step>
                <el-step title="添加商品"></el-step>
                <el-step title="选择收货地址"></el-step>
                <el-step title="确认订单"></el-step>
            </el-steps>
            <el-form ref="addOrderForm" :model="addOrderForm" :label-width="labelWidth" :label-position="labelPosition">

                <div v-show="this.active==0">

                    <el-row>
                        <el-col :span="12">
                            <el-form-item prop="deal_id" label="成交员工">
                                <el-select v-model="deal_id" placeholder="请选择成交员工"  @change="usersChange">
                                    <el-option v-for="v in users" :value="v.id" :key="v.id" :label="v.realname" ></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="cus_id" label="员工客户">
                                <el-select v-model="cus_id" placeholder="请选择客户" @change="customerChange">
                                    <el-option v-for="v in customers" :value="v.id" :key="v.id" :label="v.name" ></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>

                </div>
                <div v-show="this.active==1">
                    <el-table
                            border
                            :data="orderData"
                            style="width: 100%">
                        <el-table-column label="序号" type="index" width="80 px"></el-table-column>
                        <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                        <el-table-column prop="price" label="商品单价"></el-table-column>
                        <el-table-column prop="goods_number" label="商品数量">
                        </el-table-column>
                        <el-table-column prop="moneyNotes" label="小 记"></el-table-column>
                        <el-table-column prop="remark" label="备注"></el-table-column>
                        <el-table-column  label="操作" align="center">
                            <template slot-scope="scope">
                                <el-button size="small" type="danger" @click="deleteAddress(scope.row)">删 除</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                    <br>
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="商品分类" prop="dev">
                                <el-cascader
                                        v-model="dev"
                                        :options="CategoryList"
                                        @change="categoryChange">
                                </el-cascader>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="goods_id" label="商品名称">
                                <el-select v-model="addOrderForm.goods_id" @change="getGoodsInfo">
                                    <el-option v-for="(value, item) in data2" :value="item" :key="item" :label="value.goods_name+'-'+value.sku_name+'-'+value.price">
                                        <span>{{value.goods_name}}-{{value.sku_name}}-{{value.price}}</span>
                                        <!-- <span style="float: right; color: #8492a6; font-size: 13px">{{value}}</span> -->
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="goods_number" label="商品数量">
                                <el-input-number size="small" :min="1" :max="gdsInpurNum" v-model="addOrderForm.goods_number" @change="gdsInpurNumChange">
                                </el-input-number>
                                <span style="color:red;">当前库存：{{alertNum}}</span>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="remark" label="备注">
                                <el-input type="textarea" class="name-input"  v-model="addOrderForm.remark"  placeholder="备注" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-button @click="addOrders" type="primary" class="right" >添 加</el-button>
                </div>
                <br>
                <div v-show="this.active==2">
                    <el-row>
                        <el-col :span="12">
                            <el-form-item prop="address_id" label="收货地址">
                                <!-- <el-select v-model="addressID" placeholder="请选择收货地址" @change="addressChange">
                                    <el-option v-for="v in address" :value="v.id" :key="v.id" :label="v.name" ></el-option>
                                </el-select> -->
                                <el-radio-group v-for="v in fullAddressData" :key="v.id" v-model="addOrderForm.address_id" @change="addressChange">
                                    <template slot-scope="scope">
                                        <el-radio  :label="v.id" >{{v.fullAddress}}</el-radio>
                                    </template>
                                </el-radio-group>
                            </el-form-item>
                        </el-col>

                    </el-row>

                </div>
                <br>
                <div v-show="this.active==3">
                    <el-table
                            border
                            :data="orderData"
                            style="width: 100%">
                        <el-table-column label="序号" type="index" width="80 px"></el-table-column>
                        <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                        <el-table-column prop="price" label="商品单价"></el-table-column>
                        <el-table-column prop="goods_number" label="商品数量"></el-table-column>
                        <el-table-column prop="moneyNotes" label="小 记"></el-table-column>
                        <el-table-column prop="remark" label="备注"></el-table-column>
                    </el-table>
                    <br>
                    <h3> <span>商品总金额:{{this.totalMoney}}</span></h3>
                    <br>
                    <el-table
                            border
                            :data="addressList"
                            style="width: 100%">
                        <el-table-column label="序号" type="index" width="80 px"></el-table-column>
                        <el-table-column prop="name" label="收货人姓名"></el-table-column>
                        <el-table-column prop="phone" label="收货人手机号"></el-table-column>
                        <el-table-column prop="address" label="收货地址"></el-table-column>
                        <el-table-column prop="deal_name" label="成交员工"></el-table-column>
                    </el-table>
                    <div slot="dialog-foot" class="right">
                        <el-button @click="handleClose">取 消</el-button>
                        <submit-button
                                @click="handleSubmit"
                                :observer="dialogThis">
                            保 存
                        </submit-button>
                    </div>
                </div>
            </el-form>
            <br>
            <el-button  style="margin-top: 12px;" v-show="this.active>0" @click="last">上一步</el-button>
            <el-button  style="margin-top: 12px;" v-show="this.active<3" @click="next">下一步</el-button>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import DataProxy from '../../packages/DataProxy';
    import SelectProxy from  '../../packages/SelectProxy';
    import GoodsDetailsAjax from '../../ajaxProxy/GoodsDetails';
    import EmployeeSelect from '@/packages/EmployeeSelectProxy'; 
    import GoodsSelectProxy from '../../packages/GoodsSelectProxy';
    import { mapGetters,mapMutations } from 'vuex';
    
    import APP_CONST from '../../config';
    export default {
        name: 'Add',
        mixins:[DialogForm],
        props:{
            CategoryList:'',
            width:'',
            customers:{
                type:Array,
                default:[],
            },
        },
        data(){
            return {
                dialogThis:this,
                address_id:"",
                labelPosition:"right",
                labelWidth:'80px',
                totalMoney:0,
                active:0,
                cus_id:'',
                deal_id:'',
                id:'',
                types:[],
                goods:[],
                users:[],
                address:[],
                addressList:[],
                usersListData:[],
                addressListData:[],
                addOrderForm:{
                    cus_id:'',
                    deal_id:'',
                    deal_name:'',
                    goods_id:'',
                    address_id:"",
                    order_all_money:0,
                    order_pay_money:0,
                    order_goods:[],
                    goods_number:'',
                    remark:'',
                },
                orderData:[],
                goodsIds:[],
                orderBasicData:[],
                model:'',
                deal_name:'',
                remark:'',
                addressID:'',
                dev:[],
                data2:{},
                gdsInpurNum:100000,
                alertNum:0,
                allNum:'',
                fullAddressData:[],
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id':'department_id'
            })
        },
        methods:{
            addOrders(){
                var vmthis = this;
                let moneyNotes =parseInt(this.data2[this.addOrderForm.goods_id].price) * parseInt(this.addOrderForm.goods_number);
                let addData ={
                    goods_id:vmthis.data2[vmthis.addOrderForm.goods_id].goods_id,
                    sku_id:vmthis.data2[vmthis.addOrderForm.goods_id].sku_id,
                    sku_name:vmthis.data2[vmthis.addOrderForm.goods_id].sku_name,
                    goods_name:vmthis.data2[vmthis.addOrderForm.goods_id].goods_name,
                    price:vmthis.data2[vmthis.addOrderForm.goods_id].price,
                    goods_number:vmthis.addOrderForm.goods_number,
                    remark:vmthis.addOrderForm.remark,
                    moneyNotes:moneyNotes,
                };
                this.totalMoney += moneyNotes;
                this.orderData.push(addData);
                this.goodsIds.push(addData.goods_id);
                this.$refs.addOrderForm.resetFields();
                this.alertNum = 0;
                this.dev = [];
            },
            customerChange(cus_id){
                this.cus_id = cus_id;
                this.addOrderForm.cus_id = cus_id;
                this.getAddress(this.cus_id);
            },
            getGoodsInfo(goods_id){
                //this.goods_id=goods_id;
                if(this.data2[goods_id]){
                    this.gdsInpurNum = parseInt(this.data2[goods_id].num);
                    this.alertNum = parseInt(this.data2[goods_id].num);
                    this.allNum = this.alertNum;
                }
            },
            gdsInpurNumChange(v){
                this.alertNum = this.allNum-v>0 ? this.allNum-v : 0;
            },
            usersChange(deal_id){
                this.deal_id=deal_id;
                this.addOrderForm.deal_id=deal_id;
                for (let i = 0; i < this.users.length; i++) {
                    if(this.users[i].id == deal_id){
                        this.deal_name = this.users[i].realname;
                        this.addOrderForm.deal_name = this.deal_name;
                    }  
                }
            },
            addressChange(address_id){
                this.address_id=address_id;
                this.addressList=[];
                let data={
                    name : this.addressListData[this.address_id].name,
                    phone : this.addressListData[this.address_id].phone,
                    address: this.addressListData[this.address_id].address,
                    deal_name:this.deal_name
                };
                this.addressList.push(data);
                //console.log(this.deal_id);return;
            },
            handleSubmit(){
                this.addOrderForm.goods_id = this.goodsIds.join(',');
                this.addOrderForm.order_all_money = this.totalMoney;
                this.addOrderForm.order_pay_money = this.totalMoney;
                this.addOrderForm.order_goods = this.orderData;
                this.addOrderForm.cus_id = this.cus_id;
                this.addOrderForm.deal_id= this.deal_id;
                // console.log(this.addOrderForm)
                this.formSubmit('addOrderForm');
            },
            handleClose(){
                this.$refs.addOrderForm.resetFields();
                this.addressList=[];
                this.orderData=[];
                this.goodsIds=[];
                this.deal_id='';
                this.cus_id = '',
                this.data2 = {},
                this.gdsInpurNum = 100000,
                this.alertNum = 0,
                this.allNum = '',
                this.deal_name = '',
                this.totalMoney=0;
                this.active=0;
                this.dev = [];
                this.fullAddressData = [];
                this.$modal.hide(this.name);

            },
            getAjaxProxy(){
                return  this.ajaxProxy;
            },
            formSubmit(name){
                let model = this[name];
                if (this.$refs[name].rules) {
                    this.$refs[name].validate((valid)=>{
                        if (valid) {
                            this.realSubmit(model, name);
                        } else {
                            console.log('error submit!!', name);
                            this.$emit('valid-error', name);
                            return false;
                        }
                    })
                } else {
                    this.realSubmit(model, name);
                }
            },
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            realSubmit(model, name){
                let ajaxPromise =  this.getAjaxPromise(model);
                let vmthis = this;
                ajaxPromise.then(function(response){
                    vmthis.$message.success('操作成功');
                    vmthis.$refs[name].resetFields();
                    vmthis.addressList=[];
                    vmthis.orderData=[];
                    vmthis.goodsIds=[];
                    vmthis.deal_id='';
                    vmthis.cus_id = '',
                    vmthis.data2 = {},
                    vmthis.gdsInpurNum = 100000,
                    vmthis.alertNum = 0,
                    vmthis.allNum = '',
                    vmthis.deal_name = '',
                    vmthis.totalMoney=0;
                    vmthis.active=0;
                    vmthis.dev = [];
                    vmthis.fullAddressData = [];
                    vmthis.$emit('submit-success', name);
                }).catch(function(error){
                    if(error.response){
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    }else{
                        console.log('Error',error.message);
                    }
                    vmthis.$message.error('出错了');
                }).then(function(){
                    vmthis.$emit('submit-final', name);
                });
            },
            onOpen(param){
                console.log(param);
                // this.cus_id = param.params.model.cus_id;
                // this.getAddress(this.cus_id);
            },
            deleteAddress(row){
                let index = this.orderData.indexOf(row);
                let goods_id = this.goodsIds.indexOf(row.goods_id);
                let vmThis = this;
                if( index > -1){
                    this.$confirm('确定删除?', '警告',{
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(()=>{
                        this.orderData.splice(index,1);
                        this.goodsIds.splice(goods_id,1);
                        this.totalMoney -= row.moneyNotes;
                        vmThis.$message.success("操作成功");
                    });
                }
            },
            last() {
                if (this.active-- < 1) this.active = 0;
            },
            next() {
                if (this.active++ > 2) this.active = 3;
            },
            categoryChange(cate_id){
                // let orderDataProxy = new DataProxy(GoodsDetailsAjax.getUrl(),this.pageSize,this.getOrderData, this);
                // this.orderDataProxy = orderDataProxy;
                // let cates = {cate_id:cate_id};
                // this.orderDataProxy.setExtraParam(cates);
                // this.orderDataProxy.load();

                this.goodsProxy.setParam({
                    cate_id:cate_id,
                    with:['skus.attr'],
                    fields:['id','goods_name','goods_price','goods_number','sku_sn']
                }).load();
            },
            getOrderData(data) {
                this.goods=data.items;
                this.goodsInfoData=data.items;
            },
            loadGoods(data){
                console.log(data);
                var vmThis = this;
                this.data2 = {};
                for (let i = 0; i < data.items.length; i++) {
                    if(data.items[i].skus.length < 1){
                        let gid1 = data.items[i].id;
                        let goods_name1 = data.items[i].goods_name;
                        let goods_price1 = data.items[i].goods_price;
                        let goods_number1 = data.items[i].goods_number;
                        let vv1 = {goods_id:gid1, price:goods_price1, goods_name:goods_name1, num:goods_number1,sku_id:0, sku_name:''};
                        let kk1 = 'goods_id_'+gid1+'_sku_id_0';
                        vmThis.data2[kk1] = vv1;
                    }else{
                        let gid2 = data.items[i].id;
                        let goods_name2 = data.items[i].goods_name;
                        for (let n = 0; n < data.items[i].skus.length; n++) {
                            let sku_id2 = data.items[i].skus[n].id;
                            let sku_name2 = data.items[i].skus[n].name;
                            let sku_num2 = data.items[i].skus[n].num;
                            let sku_price2 = data.items[i].skus[n].price;
                            let kk2 = 'goods_id_'+gid2+'_sku_id_'+sku_id2;
                            let vv2 = {goods_id:gid2, price:sku_price2, goods_name:goods_name2, num:sku_num2,sku_id:sku_id2, sku_name:sku_name2};
                            vmThis.data2[kk2] = vv2;
                        }
                    }
             
                }  
                
            },
            getAddress(cus_id){
                let selectProxy = new SelectProxy('/deliveryaddress?cus_id='+cus_id, this.getAddressData, this);
                selectProxy.load();
            },
            getAddressData(data){
                this.address=data.items;
                this.addressListData=data.address;
                this.fullAddressData=data.fullAddress;
            },
            getUsersData(data){
                this.users=data.items;
                //this.usersListData=data.users;
            },
        },
        created(){
            let orderDataProxy = new EmployeeSelect({department_id:this.user_department_id, role:'sale-department-member'}, this.getUsersData, this);
            this.orderDataProxy = orderDataProxy;
            this.orderDataProxy.load();

            this.goodsProxy = new GoodsSelectProxy({}, this.loadGoods, this);
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
    .right  {
        float:right
    }
</style>
