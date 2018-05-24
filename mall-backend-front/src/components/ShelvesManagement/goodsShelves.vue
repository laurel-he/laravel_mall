<template>
    <div >
        <MyDialog title="货架上货" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm"  :label-width="labelWidth"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="货架编号" prop="shelves_num" >
                            {{model.shelves_num}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="货架状态" prop="shelves_status" >
                                <span v-if="model.shelves_status==0">空</span>
                                <span v-if="model.shelves_status==1">满</span>
                                <span v-if="model.shelves_status==2">坏</span>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="已放数量" prop="deposit_num" >
                            {{model.deposit_num}}
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="满編数量" prop="full_num" >
                            <el-input class="name-input" v-model="full_num"  auto-complete="off" placeholder="请填写满編数量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="cate_type_id"  label="商品类型">
                            <el-select v-model="addForm.cate_type_id" size="small" placeholder="商品类型" clearable @change="cate_type_change">
                                <el-option v-for="v in CategoryList" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="cate_kind_id"  label="商品种类">
                            <el-select v-model="addForm.cate_kind_id" size="small" placeholder="商品品类" @change="setKindName">
                                <el-option v-for="v in CategoryChildrenList" :label="v.label"
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
                        <el-form-item label="商品编号" prop="sku_sn" >
                            <el-input class="name-input" v-model="addForm.sku_sn"  auto-complete="off" placeholder="请填写商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
               <el-row>
                   <el-col :span="12">
                       <el-form-item label="放入数量" prop="goods_num" >
                           <el-input class="name-input" v-model="addForm.goods_num"  auto-complete="off" placeholder="请填写入放入数量"></el-input>
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
                    @click="beforeFormSubmit('addForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import FormMix from '@/mix/Form';
    import Dialog from '@/mix/Dialog';
    import SelectProxy from  '../../packages/SelectProxy';
    import ShelvesManagementSelectProxy from '../../packages/ShelvesManagementSelectProxy';

    import { mapGetters } from 'vuex';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialog',
        mixins:[FormMix,Dialog],
        props:{
            CategoryList:{
                type:Array
            },
            ajaxProxy:{
                // required:true,
                type: Object,
                default: null
            }
        },

        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                computedusers:[],
                CategoryChildrenList:[],
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
                    shelves_id: "",
                    cate_type_id: "",
                    cate_type: "",
                    cate_kind_id: "",
                    cate_kind: "",
                    goods_name: '',
                    goods_num:'',
                    sku_sn: '',
                    remarks:'',
                    shelvesData:{}
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
                },
                model:"",
                full_num:'',
                deposit_num:'',
            }
        },
        computed:{

        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            setKindName(v){
                let item = '';
                for(item in this.CategoryChildrenList){
                    if(this.CategoryChildrenList[item]['id'] ==v){
                        this.addForm.cate_kind=this.CategoryChildrenList[item]['label']
                    }
                }
            },
            beforeFormSubmit(name){
                this.deposit_num =parseInt(this.addForm.goods_num) + parseInt(this.deposit_num) ;
                this.addForm.shelvesData={full_num:this.full_num,deposit_num:this.deposit_num};
                this.addForm.shelves_id=this.model.id;

                // console.log(this.addForm);
                // return false;

                this.formSubmit(name)
                this.full_num='';
                this.deposit_num='';
                let data ={shelves_id:this.model.id};
                let that = this;
                this.ajaxProxy.get(data).then(function(response){
                    that.$emit('add-submit',response.data)
                })
            },
            cate_type_change(v){
                this.addForm.cate_kind_id = '';
                if(v){
                    let selectProxy = new SelectProxy('/getCategorys/'+ v, this.getCategoryChildrenList, this);
                    selectProxy.load();
                    let item = '';
                    for(item in this.CategoryList){
                        if(this.CategoryList[item]['id'] ==v){
                            this.addForm.cate_type=this.CategoryList[item]['label']
                        }
                    }
                }
            },
            getCategoryChildrenList(data){
                this.CategoryChildrenList=data;
            },
            onBeforeOpen(model) {
                this.model =  model.params.model;
                this.full_num =this.model.full_num;
                this.deposit_num =this.model.deposit_num;
            }
        },
        watch:{
            model:function(val, oldVal){
                this.initObject(val, this.addForm);
            }
        },
        created(){

        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

