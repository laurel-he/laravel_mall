<template>
    <div >
        <MyDialog title="添加" :name="name" :width="width" :height="height" >
            <el-form :model="addForm" :rules="rules" :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="订单号" prop="order_sn" >
                            <!-- <el-input class="name-input" v-model="addForm.order_sn"  auto-complete="off" ></el-input> -->
                            <el-select
                                clearable
                                filterable
                                remote
                                :remote-method="remoteMethod"
                                :loading="loading"
                                v-model="addForm.order_sn"
                                @change="onOrderSnChange">
                                <el-option v-for="order in order_sns" :value="order.order_sn" :label="order.order_sn" :key="order.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="快递号" prop="express_sn" >
                            <el-input v-model="addForm.express_sn"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="物流公司"  prop="express_name">
                            <el-select v-model='addForm.express_name'>
                                <el-option label="顺风" value="顺风"></el-option>
                                <el-option label="韵达" value="韵达"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="收货联系人" prop="consignee">
                            <el-input v-model="addForm.consignee"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="12">
                        <el-form-item label="收货联系电话" prop="express_phone">
                            <el-input v-model="addForm.express_phone"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="收货地址"  prop="address">
                            <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="请输入内容"
                                v-model="addForm.address">
                            </el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="发货时间"  prop="express_time">
                            <el-date-picker
                                v-model="addForm.express_time"
                                type="datetime"
                                format="yyyy-MM-dd HH:mm:ss"
                                placeholder="选择日期时间" 
                                @change="onExpressTimeChange">
                              </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="备注"  prop="remarks">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.remarks" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="beforeSubmit" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>

    import DialogForm from '../../mix/DialogForm';
    import OrderSelectProxy from '../../packages/OrderSelectProxy';

    import { mapGetters } from 'vuex';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'Add',
        mixins:[DialogForm],
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                loading:false,
                
                addForm:{
                    consignee:"",
                    express_phone:"",
                    address:"",
                    express_time:"",

                    creator_id:"",
                    creator:"",
                },

                rules:{
                    // name:[
                    //     { required: true, message: '请输入小组名称', trigger: 'blur' }
                    // ],  
                    // department_id:[
                    //     { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                    // ]
                },

                order_sns:[]
            }
        },
        computed:{
            ...mapGetters({
                'creator_id':'user_id',
                'creator':'realname',
            })
        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            beforeSubmit(){
                this.addForm.creator = this.creator;
                this.addForm.creator_id = this.creator_id;
                this.formSubmit('addForm');
            },
            remoteMethod(query){
                if (query !== '') {
                    this.loading = true;
                    // param.fields = ['id','order_sn'];
                    this.orderSelect.setParam({sn:query,fields:['id','order_sn','users','address','det_address','user_phone']});

                    let p = this.orderSelect.load();
                    p.then(()=>{
                        this.loading = false;
                    })
                }
            },
            loadOrder(data){
                this.order_sns = data.items;
            },
            onOrderSnChange(v){
                for (let index = 0; index < this.order_sns.length; index++) {
                    var  element = this.order_sns[index];
                    if (element.order_sn == v) {
                        this.addForm.consignee = element.users;
                        this.addForm.express_phone = element.user_phone;
                        this.addForm.address = element.det_address;
                    }
                }
            },
            onExpressTimeChange(v){
                this.addForm.express_time = v;
            }
        },
        created(){
            let orderSelect  = new OrderSelectProxy({}, this.loadOrder, this);
            this.orderSelect = orderSelect;
        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
    
    