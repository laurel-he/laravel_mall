<template>
    <div >
        <MyDialog title="修改货架" :name="name" :width="width" :height="height" >
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="货架编号" prop="production_in_number" >
                            <el-input class="name-input" v-model="number"  auto-complete="off" :disabled="true" placeholder="请填写入放入数量"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="货架状态" prop="production_in_number" >
                            <el-input class="name-input" v-model="text"  auto-complete="off" :disabled="true" placeholder="请填写入放入数量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="已放数量" prop="production_in_number" >
                            <el-input class="name-input" v-model="putNumber"  auto-complete="off" :disabled="true" placeholder="请填写入放入数量"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="面編数量" prop="production_in_number" >
                            <el-input class="name-input"  v-model="allNumber" auto-complete="off" :disabled="true" placeholder="请填写入放入数量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="goods_type_id"  label="商品类型">
                            <el-select
                                    v-model="addForm.goods_type_id"

                                    placeholder="商品类型">
                                <el-option v-for="v in types" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="product_id"  label="商品种类">
                            <el-select
                                    v-model="addForm.product_id"
                                    placeholder="商品种类">
                                <el-option v-for="v in productNames" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品名称" prop="goods_name" >
                            <el-input class="name-input" v-model="addForm.goods_name"  auto-complete="off" placeholder="请填写商品名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="goods_number" >
                            <el-input class="name-input" v-model="addForm.goods_number"  auto-complete="off" placeholder="请填写商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
               <el-row>
                   <el-col :span="12">
                       <el-form-item label="放入数量" prop="production_in_number" >
                           <el-input class="name-input" v-model="addForm.production_in_number"  auto-complete="off" placeholder="请填写入放入数量"></el-input>
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
                text:'满',
                number:21354,
                allNumber:50,
                putNumber:20,
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
                    product_id: "",
                    warehouse_number: "",
                    production_in_number: "",
                    goods_type_id: '',
                    goods_number: '',
                    storage_id: '',
                    production_in_time: '',
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

