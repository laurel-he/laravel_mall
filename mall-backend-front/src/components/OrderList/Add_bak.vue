<template>
    <div>
        <MyDialog title="添加" :name="name" :width="width" :height="height">
            <el-steps :active="active" finish-status="success">
                <el-step title="选择用户"></el-step>
                <el-step title="选择商品"></el-step>
                <el-step title="收货信息"></el-step>
                <el-step title="确认订单"></el-step>
            </el-steps>
            <el-form :model="addOrderForm"  ref="addOrderForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">
                <div class="tabs" v-show="active==0">
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="销售员工"  prop="users">
                                <el-select v-model='addOrderForm.users'>
                                    <el-option v-for="user in users"
                                               :label="user.realname"
                                               :value="user.id"
                                               :key="user.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="购买客户"  prop="buyer">
                                <el-select v-model='addOrderForm.buyer'>
                                    <el-option v-for="buy in buyer" :label="buy.name"
                                               :value="buy.id" :key="buy.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </div>
                <div class="tabs" v-show="active==1">
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
                            <el-form-item label="商品类型" prop="dev">
                                <el-cascader
                                        v-model="dev"
                                        :options="CategoryList"
                                        change-on-select
                                        @change="categoryChange"
                                ></el-cascader>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="goods_id" label="商品名称">
                                <el-select v-model="addOrderForm.goods_id" @change="getGoodsInfo">
                                    <el-option v-for="v in goods" :value="v.id" :key="v.id" :label="v.goods_name"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="goods_number" label="商品数量">
                                <el-input-number size="small" :min="1" v-model="goods_number" ></el-input-number>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item prop="remark" label="备注">
                                <el-input type="textarea" class="name-input"  v-model="remark"  placeholder="备注" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-button @click="addOrder" type="primary" class="right" >添 加</el-button>
                </div>
                <div class="tabs" v-show="active==2">

                    <!--<el-row>-->
                        <!--<el-col :span="12">-->
                            <!--<el-form-item prop="addressID" label="请选择收货地址">-->
                                <!--<el-select v-model="addressID" placeholder="请选择收货地址" @change="addressChange">-->
                                    <!--<el-option v-for="v in address" :value="v.id" :key="v.id" :label="v.name" ></el-option>-->
                                <!--</el-select>-->
                            <!--</el-form-item>-->
                        <!--</el-col>-->
                        <!--<el-col :span="12">-->
                            <!--<el-form-item prop="deal_id" label="请选择成交员工">-->
                                <!--<el-select v-model="addOrderForm.deal_id" placeholder="请选择成交员工"  @change="userChange">-->
                                    <!--<el-option v-for="v in users" :value="v.id" :key="v.id" :label="v.realname" ></el-option>-->
                                <!--</el-select>-->
                            <!--</el-form-item>-->
                        <!--</el-col>-->
                    <!--</el-row>-->
                </div>
                <div class="tabs" v-show="active==3">
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
            <el-button  style="margin-top: 12px;" @click="prv">上一步</el-button>
            <el-button style="margin-top: 12px;" class="next" @click="next">下一步</el-button>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        @click="formSubmit('addOrderForm')"
                        :observer="dialogThis">
                    保 存
                </submit-button>
            </div>

        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import DataProxy from '../../packages/DataProxy';
    import GoodsDetails from '../../ajaxProxy/GoodsDetails';

    export default {
        name: 'add-orderBasic',
        mixins:[DialogForm],
        props:{
//            typeList:{
//                type:Array,
//                default:['销售部','推广部','风控部','人事部']
//            },
            users:{
                type:Array,
                default:[],
            },
            buyer:{
                type:Array,
                default:[],
            },
            CategoryList:'',

        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                active: 0,
                labelWidth:'80px',
                goodsIds:[],
                computedusers:[],
                goods:[],
                dev:[],
                moneyTotal:0,
                addOrderForm:{
                    cus_id:'',
                    deal_id:'',
                    deal_name:'',
                    goods_id:'',
                    address_id:"",
                    order_all_money:0,
                    order_pay_money:0,
                    order_goods:[],
                },
                orderData:[],
                goodsInfoData:[],
                rules:{
                    name:[
                        { required: true, message: '请输入部门名称', trigger: 'blur' }
                    ],
                    type:[
                        { required: true, message:'请选择类型', type: 'number', trigger:'change'}
                    ]
                },


            }
        },
        methods:{
            addOrder(){
                let moneyNotes =parseInt(this.goodsInfoData[this.goods_id].goods_price) * parseInt(this.goods_number);
                let addData ={
                    goods_id:this.goods_id,
                    goods_name:this.goodsInfoData[this.goods_id].goods_name,
                    price:this.goodsInfoData[this.goods_id].goods_price,
                    goods_number:this.goods_number,
                    remark:this.remark,
                    moneyNotes:moneyNotes,
                };
                this.totalMoney += moneyNotes;
                this.orderData.push(addData);
                this.goodsIds.push(this.goods_id);
                this.$refs.addOrderForm.resetFields();
                this.dev=[];
                this.remark='';
                this.goods_number='';
            },
            handleDelete(index, row) {
                this.$confirm('确定删除该商品？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    //删除数组中指定的元素
                    this.tableData.splice(index,1);
                    this.$message({
                        type: 'success',
                        message: '删除成功!'
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            handleInput:function(value){
                if(null==value.number || value.number==""){
                    value.number=1;
                }
                value.goodTotal=(value.number*value.price).toFixed(2);//保留两位小数
                //增加商品数量也需要重新计算商品总价
                this.selected(this.multipleSelection);
//                console.log(value.goodTotal);
            },

            add:function(addGood){
                //输入框输入值变化时会变为字符串格式返回到js
                //此处要用v-model，实现双向数据绑定
                if(typeof addGood.number=='string'){
                    addGood.number=parseInt(addGood.number);
                };
                addGood.number+=1;
                this.handleInput(addGood);
                console.log(111);
            },
            del:function(delGood){
                if(typeof delGood.number=='string'){
                    delGood.number=parseInt(delGood.number);
                };
                if(delGood.number>1){
                    delGood.number-=1;
                }
                this.handleInput(delGood);
            },
            //返回的参数为选中行对应的对象
            selected:function(selection){
                this.multipleSelection=selection;
                this.moneyTotal=0;
                //此处不支持forEach循环，只能用原始方法了
                for(var i=0;i<selection.length;i++){
                    //判断返回的值是否是字符串
                    console.log(111);
                    if(typeof selection[i].goodTotal=='string'){
                        selection[i].goodTotal=parseInt(selection[i].goodTotal);
                    };
                    this.moneyTotal+=selection[i].goodTotal;
                }
            },

            next() {
                if (this.active++ > 2) this.active = 3;

            },
            prv(){
                if (this.active-- < 1) this.active = 0;
            },
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            //加减号
            changeQuantity(row, type){
                if( type > 0 ){
                    row.count++;
                }else{
                    row.count > 1 ? row.count--: row.count = 1;
                }
                this.changeCount(row);
            },
            getOrderData(data) {
                this.goods=data.items;
                this.goodsInfoData=data.goods;
            },
            categoryChange(cate_id){
                let orderDataProxy = new DataProxy(GoodsDetails.getUrl(),this.pageSize,this.getOrderData, this);
                this.orderDataProxy = orderDataProxy;
                let cates = {cate_id:cate_id};
                this.orderDataProxy.setExtraParam(cates);
                this.orderDataProxy.load();
            },
            //数量文本框值改变
            changeCount (row) {
                if(null == row.count || row.count == ""){
                    row.count=1;
                }
                row.totalPrice = (row.count * row.price).toFixed(2);//保留两位小数
//                console.log(row.totalPrice+" = "+ row.count +" * "+ row.price)
                //增加商品数量也需要重新计算商品总价
            },

        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
