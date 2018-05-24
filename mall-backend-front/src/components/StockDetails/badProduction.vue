<template>
    <div >
        <MyDialog title="坏货登记" :name="name" :width="width" :height="height" >
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="cate_type_id"  label="商品类型">
                            <el-select
                                    v-model="addForm.cate_type_id"
                                    placeholder="商品类型"
                                    @change="typeChange">
                                <el-option v-for="v in types" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="cate_kind_id"  label="商品品类">
                            <el-select
                                    v-model="addForm.cate_kind_id"
                                    placeholder="商品品类"
                                    @change="kindChange">
                                <el-option v-for="v in cate_kinds" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="product_sale_type"  label="销售类型">
                            <el-select
                                    v-model="addForm.product_sale_type"
                                    placeholder="商品品类">
                                <el-option v-for="v in sale_type" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="坏货数量" prop="num" >
                            <el-input class="name-input" v-model="addForm.num"  auto-complete="off" placeholder="请填写坏货入库数量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="sku_sn" >
                            <el-input class="name-input" v-model="addForm.sku_sn"  auto-complete="off" placeholder="请填写商品编号"></el-input>
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
                        <el-form-item prop="user_id"  label="入库人">
                            {{ user_name }}
                            <!-- <el-select
                                    v-model="addForm.user_id"
                                    placeholder="入库人">
                                <el-option v-for="v in storageUsers" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select> -->
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="入库时间" prop="reg_at" >
                            <el-date-picker
                                    v-model="addForm.reg_at"
                                    type="datetime"
                                    placeholder="选择入库时间"
                                    @change="regChange">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="remark">
                            <el-input type="textarea"  auto-complete="off" v-model="addForm.remark" placeholder="请填写备注"></el-input>
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
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    import BadGoodsAjaxProxy from '@/ajaxProxy/BadGoods';
    import { mapGetters } from 'vuex';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            types:{
                type: Array,
                default:[]
            },
            distributors:{
                type: Array,
                default:[]
            }
        },
        // components:{
        //     Dialog
        // },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                computedusers:[],
                goodsStates: [
                    {id:1,name:'完好'},
                    {id:2,name:'损坏'},
                ],
                
                productNames: [
                    {id:1,name:'面膜 6张'},
                    {id:2,name:'爽肤水 200ml'},
                ],
                storageUsers: [
                    {id:1,name:'张三'},
                    {id:2,name:'李四'},
                ],
                departments:[
                    {id:1,name:'面膜'},
                    {id:2,name:'爽肤水'},
                ],
                
                addForm:{
                    cate_type_id: "",
                    cate_type:"",
                    cate_kind_id:"",
                    cate_kind:"",
                    product_sale_type:2,
                    num:"1",
                    sku_sn:"",
                    entrepot_id:"",
                    user_id:"",
                    user_name:"",
                    reg_at:"",
                    remark:""
                },
                
                cate_kinds:[],

                rules:{
                    // name:[
                    //     { required: true, message: '请输入小组名称', trigger: 'blur' }
                    // ],
                    // department_id:[
                    //     { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                    // ],
                    // remarks:[
                    //     { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                    // ]
                }
            }
        },
        computed:{
            ...mapGetters({
                'sale_type':'saleType',
                'user_id':'user_id',
                'user_name':'realname'
            }),

        },
        methods:{
            getAjaxPromise(model){
                return BadGoodsAjaxProxy.create(model);
            },
            loadUsers(data){
                this.computedusers = data.items;
            },
            onDepartChange(v){
                this.employeeSelect.setParam({department_id:v, role:'group-captain', group_candidate:1})
                this.employeeSelect.load();
                this.addForm.manager_id = "";
            },
            typeChange(v){
                for (let index = 0; index < this.types.length; index++) {
                    const element = this.types[index];
                    if (element.id == v) {
                        this.addForm.cate_type = element.label;
                        this.cate_kinds = element.children;
                    }
                }
            },
            kindChange(v){
                for (let index = 0; index < this.cate_kinds.length; index++) {
                    const element = this.cate_kinds[index];
                    if (element.id == v) {
                        this.addForm.cate_kind = element.label;
                    }
                }
            },
            beforeSubmit(){
                this.addForm.user_id = this.user_id;
                this.addForm.user_name = this.user_name;
                this.formSubmit('addForm');
            },
            regChange(v){
                this.addForm.reg_at = v;
            }
        },
        created(){
            this.employeeSelect = new EmployeeSelectProxy({}, this.loadUsers, this);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

