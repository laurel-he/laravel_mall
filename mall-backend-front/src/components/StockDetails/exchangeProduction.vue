<template>
    <div >
        <MyDialog title="换货登记" :name="name" :width="width" :height="height" >
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="old_goods_type_id"  label="原类型">
                            <el-select
                                    v-model="addForm.old_goods_type_id"
                                    placeholder="请选择原商品类型">
                                <el-option v-for="v in types" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="old_product_id"  label="原品类">
                            <el-select
                                    v-model="addForm.old_product_id"
                                    placeholder="请选择原商品品类">
                                <el-option v-for="v in productNames" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="数量" prop="production_in_number" >
                            <el-input class="name-input" v-model="addForm.production_in_number"  auto-complete="off" placeholder="请填写换货数量"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="department_id"  label="配送中心">
                            <el-select
                                    v-model="addForm.distribution_id"
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
                        <el-form-item prop="new_goods_type_id"  label="新的类型">
                            <el-select
                                    v-model="addForm.old_goods_type_id"
                                    placeholder="请选择新的商品类型">
                                <el-option v-for="v in types" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="new_product_id"  label="新的品类">
                            <el-select
                                    v-model="addForm.new_product_id"
                                    placeholder="请选择新的商品品类">
                                <el-option v-for="v in productNames" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>

                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="goods_number" >
                            <el-input class="name-input" v-model="addForm.goods_number"  auto-complete="off" placeholder="请填写商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="storage_id"  label="操作人">
                            <el-select
                                    v-model="addForm.storage_id"
                                    placeholder="操作人">
                                <el-option v-for="v in storageUsers" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="操作时间" prop="operation_time" >
                            <el-date-picker
                                    v-model="addForm.operation_time"
                                    type="datetime"
                                    placeholder="选择操作时间">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
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
    import { mapGetters } from 'vuex';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        // props:{
        //
        // },
        // components:{
        //     Dialog
        // },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                computedusers:[],
                types: [
                    {id:1,name:'面膜'},
                    {id:2,name:'爽肤水'},
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
                distributors: [
                    {id:1,name:'顺丰'},
                    {id:2,name:'圆通'},
                ],
                addForm:{
                    old_product_id: "",
                    new_product_id: "",
                    warehouse_number: "",
                    production_in_number: "",
                    old_goods_type_id: '',
                    new_goods_type_id: '',
                    goods_number: '',
                    storage_id: '',
                    operation_time: '',
                    distribution_id: '',
                    remarks:''
                },

                rules:{
                    name:[
                        { required: true, message: '请输入小组名称', trigger: 'blur' }
                    ],
                    department_id:[
                        { required: true, message:'请选择所属部门', trigger: 'blur', type: 'number'}
                    ],
                    remarks:[
                        { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                    ]
                }
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id':'department_id'
            }),

        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            loadUsers(data){
                this.computedusers = data.items;
            },
            onDepartChange(v){
                this.employeeSelect.setParam({department_id:v, role:'group-captain', group_candidate:1})
                this.employeeSelect.load();
                this.addForm.manager_id = "";
            },
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

