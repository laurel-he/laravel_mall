<template>
    <div >
        <MyDialog title="换货登记" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户名称" prop="cus_name" >
                            <el-input class="name-input" v-model="addForm.cus_name" placeholder="客户名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="entrepot_id"  label="配送中心">
                            <el-select
                                    v-model="addForm.entrepot_id"
                                    placeholder="配送中心">
                                <el-option v-for="v in distributors" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="原商品名称" prop="before_goods_name" >
                            <el-input class="name-input" v-model="addForm.before_goods_name" placeholder="原商品名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="原商品数量" prop="before_goods_num" >
                            <el-input-number class="name-input" v-model="addForm.before_goods_num" :min="1"></el-input-number>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="before_cate_type_id"  label="原商品类型">
                            <el-select
                                    v-model="addForm.before_cate_type_id"
                                    placeholder="原商品类型" @change="setBeforeCateKind">
                                <el-option v-for="v in types" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="before_cate_kind_id"  label="原商品品类">
                            <el-select
                                    v-model="addForm.before_cate_kind_id"
                                    placeholder="原商品品类" @change="setBeforeKindName">
                                <el-option v-for="v in typesKind" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="12">
                        <el-form-item label="新商品名称" prop="after_goods_name" >
                            <el-input class="name-input" v-model="addForm.after_goods_name" placeholder="新商品名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="新商品数量" prop="after_goods_num" >
                            <el-input-number class="name-input" v-model="addForm.after_goods_num" :min="1"></el-input-number>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="after_cate_type_id"  label="新商品类型">
                            <el-select
                                    v-model="addForm.after_cate_type_id"
                                    placeholder="新商品类型" @change="setAfterCateKind">
                                <el-option v-for="v in types" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="after_cate_kind_id"  label="新商品品类">
                            <el-select
                                    v-model="addForm.after_cate_kind_id"
                                    placeholder="新商品品类" @change="setAfterKindName">
                                <el-option v-for="v in typesKind" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="sku_sn" >
                            <el-input class="name-input" v-model="addForm.sku_sn"  auto-complete="off" placeholder="商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12"> 
                        <el-form-item label="退货是否入库" prop="in_inventory">
                            <el-select v-model="addForm.in_inventory" placeholder="退货是否入库">
                                <el-option label="是" value="1"></el-option>
                                <el-option label="否" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <!-- <el-col :span="12">
                        <el-form-item prop="storage_id"  label="操作人">
                            <el-select
                                    v-model="addForm.storage_id"
                                    placeholder="操作人">
                                <el-option v-for="v in storageUsers" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col> -->
                    <el-col :span="12">
                        <el-form-item label="操作时间" prop="exchange_at" >
                            <el-date-picker
                                    v-model="addForm.exchange_at"
                                    type="datetime"
                                    placeholder="操作时间" @change="setExchangeTime">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="20">
                        <el-form-item label="换货原因"  prop="exchange_reason">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.exchange_reason" placeholder="换货原因"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        :observer="dialogThis"
                        @click="formSubmit('addForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>

    import DialogForm from '../../mix/DialogForm';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    import InventoryExchangeAjaxProxy from '@/ajaxProxy/InventoryExchange';
    import { mapGetters } from 'vuex';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            types:{
                type: Array,
                default:function(){
                    return [];
                }
            },
            distributors:{
                type: Array,
                default:function(){
                    return [];
                }
            },
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'100px',
                computedusers:[],
                typesKind:[],
                addForm:{
                    cus_name:'',
                    sku_sn:'',
                    entrepot_id:'',
                    before_goods_name:'',
                    before_goods_num:'',
                    after_goods_name:'',
                    after_goods_num:'',
                    before_cate_type:'',
                    before_cate_kind:'',
                    before_cate_type_id:'',
                    before_cate_kind_id:'',
                    after_cate_type:'',
                    after_cate_kind:'',
                    after_cate_type_id:'',
                    after_cate_kind_id:'',
                    exchange_reason:'',
                    in_inventory:'',
                    user_name:'',
                    user_id:'',
                    exchange_at:'',
                },

                // rules:{
                //     name:[
                //         { required: true, message: '请输入小组名称', trigger: 'blur' }
                //     ],
                //     department_id:[
                //         { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                //     ],
                //     remarks:[
                //         { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                //     ]
                // }
            }
        },
        computed:{
            ...mapGetters([
                'getUser'
            ]),

        },
        methods:{
            onOpen(param){
                this.addForm.user_name = this.getUser.realname;
                this.addForm.user_id = this.getUser.id;
            },
            getAjaxPromise(model){
                // console.log(model);
                return InventoryExchangeAjaxProxy.create(model);
            },
            setBeforeCateKind(pid){
                this.addForm.before_cate_kind_id = '';
                for (let i = 0; i < this.types.length; i++) {
                    if (this.types[i].id == pid) {
                        this.typesKind = this.types[i].children;// && this.types[i].children
                        this.addForm.before_cate_type = this.types[i].label;
                    }
                }
            },
            setBeforeKindName(id){
                if(id){
                    for (let i = 0; i < this.typesKind.length; i++) {
                        if (this.typesKind[i].id == id) {
                            this.addForm.before_cate_kind = this.typesKind[i].label;
                        }
                    }
                }
                
            },
            setAfterCateKind(pid){
                this.addForm.after_cate_kind_id = '';
                for (let i = 0; i < this.types.length; i++) {
                    if (this.types[i].id == pid) {
                        this.typesKind = this.types[i].children;// && this.types[i].children
                        this.addForm.after_cate_type = this.types[i].label;
                    }
                }
            },
            setAfterKindName(id){
                if(id){
                    for (let i = 0; i < this.typesKind.length; i++) {
                        if (this.typesKind[i].id == id) {
                            this.addForm.after_cate_kind = this.typesKind[i].label;
                        }
                    }
                }

            },
            setExchangeTime(v){
                this.addForm.exchange_at = v;
            },
            // loadUsers(data){
            //     this.computedusers = data.items;
            // },
            // onDepartChange(v){
            //     this.employeeSelect.setParam({department_id:v, role:'group-captain', group_candidate:1})
            //     this.employeeSelect.load();
            //     this.addForm.manager_id = "";
            // },
        },
        created(){
            // this.employeeSelect = new EmployeeSelectProxy({}, this.loadUsers, this);

        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

