<template>
    <div >
        <MyDialog title="生产入库" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="addForm"  :label-width="labelWidth" :rules="addFormRules"  ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="entry_sn"  label="入库单号">
                            <el-input v-model="addForm.entry_sn" placeholder="自动生成"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="entry_at"  label="入库时间">
                            <el-date-picker
                              v-model="addForm.entry_at"
                              type="datetime"
                              placeholder="默认当前时间" @change="setEntyAt">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="user_id"  label="入库人">
                            <el-select v-model="addForm.user_id" placeholder="默认当前员工">
                                <el-option v-for="v in users" :label="v.realname"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="entrepot_id"  label="配送中心">
                            <el-select v-model="addForm.entrepot_id" placeholder="配送中心">
                                <el-option v-for="v in distributors" :label="v.name"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="16">
                        <el-form-item prop="comment"  label="备注">
                            <el-input type="textarea" v-model="addForm.comment" placeholder="备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-table :data="addForm.childrenData" border style="width: 100%" max-height="250">
                    <el-table-column prop="goods_name" label="商品名称"></el-table-column>
                    <el-table-column prop="sku_sn" label="商品编号"></el-table-column>
                    <el-table-column prop="num" label="输入数量"></el-table-column>
                    <el-table-column label="操作">
                        <template slot-scope="scope">
                            <el-button type="danger" size="small" @click="handleFormDel(scope.row)">删除</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </el-form>
            <br>
            <el-form :model="productForm"  :label-width="labelWidth" :rules="productFormRules" ref="productForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="cate_type_id"  label="商品类型">
                            <el-select v-model="productForm.cate_type_id" placeholder="商品类型" @change="setCateKind">
                                <el-option v-for="v in types" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="cate_kind_id"  label="商品品类">
                            <el-select v-model="productForm.cate_kind_id" placeholder="商品品类" @change="setKindName">
                                <el-option v-for="v in typesKind" :label="v.label"
                                           :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="销售类型" prop="product_sale_type" >
                            <el-select v-model="productForm.product_sale_type" placeholder="试用装、赠品、成品">
                                <el-option label="试用装" value="0"></el-option>
                                <el-option label="赠品" value="1"></el-option>
                                <el-option label="成品" value="2"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="商品名称" prop="goods_name" >
                            <el-input class="name-input" v-model="productForm.goods_name" placeholder="商品名称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品编号" prop="sku_sn" >
                            <el-input class="name-input" v-model="productForm.sku_sn" placeholder="商品编号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="商品数量" prop="num" >
                            <el-input-number v-model="productForm.num" :min="1" placeholder="商品数量"></el-input-number>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <div style="text-align:center">
                <el-button type="info" @click="handelAdd">添加</el-button>
            </div>
            
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="formSubmit('addForm')">
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import FormMix from '../../mix/Form';
    import DialogMix from '../../mix/Dialog';
    import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';
    import { mapGetters } from 'vuex';

    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialogTwo',
        mixins:[FormMix, DialogMix],
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
            ajaxProxy:{
                // required:true,
                type: Object,
                default: null
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
                typesKind:[],
                addForm:{
                    entry_sn:'',
                    entry_at:'',
                    user_id:'',
                    entrepot_id:'',
                    comment:'',
                    user_name:'',
                    childrenData:[],
                },
                productForm:{
                    cate_type:'',
                    cate_kind:'',
                    cate_type_id:'',
                    cate_kind_id:'',
                    product_sale_type:'2',
                    goods_name:'',
                    sku_sn:'',
                    num:1,
                },
                tableData1:[],
                users:{},
                productFormRules:{
                    cate_type_id:[
                        {required: true, type: 'number',  message: '请选择商品类型', trigger:'change'}
                    ],
                    cate_kind_id:[
                        {required: true, type: 'number',  message: '请选择商品品类', trigger:'change'}
                    ],
                    product_sale_type:[
                        {required: true,  message: '请选择销售类型', trigger:'change'}
                    ],
                    goods_name:[
                        {required: true,  message: '请填写商品名称', trigger:'blur'}
                    ],
                    sku_sn:[
                        {required: true,  message: '请填写商品编号', trigger:'blur'}
                    ],
                    num:[
                        {required: true, type: 'number',  message: '请填写商品数量', trigger:'change'}
                    ],
                },

                addFormRules:{
                    entrepot_id:[
                        { required:true, type: 'number', message:'请选择配送中心', trigger:'change'}
                    ],
                    comment:[
                        {max:100, message:'最大支持100个字符', trigger:'blur'}
                    ]
                }
            }
        },
        computed:{
            ...mapGetters([
                'getUser',
            ]),
        },
        methods:{
            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            getDistributionCenter(data){
                this.distributors = data.items;
            },
            getTypes(data){
                this.types = data.items;
            },
            setCateKind(pid){
                this.productForm.cate_kind_id = '';
                for (let i = 0; i < this.types.length; i++) {
                    if (this.types[i].id == pid) {
                        this.typesKind = this.types[i].children;// && this.types[i].children
                        this.productForm.cate_type = this.types[i].label;
                    }
                }
            },
            setKindName(id){
                if(id){
                    for (let i = 0; i < this.typesKind.length; i++) {
                        if (this.typesKind[i].id == id) {
                            this.productForm.cate_kind = this.typesKind[i].label;
                        }
                    }
                }

            },
            setEntyAt(v){
                this.addForm.entry_at = v;
            },
            handelAdd(){
                let vmThis = this;
                let data = Object.assign({}, this.productForm);

                data.entry_at = this.addForm.entry_at;
                this.$refs['productForm'].validate((valid)=>{
                    if (valid) {
                        this.addForm.childrenData.push(data);
                        this.$refs.productForm.resetFields();
                    } else {
                        this.$message.error("请填写必填项");
                        return false;
                    }
                })
            },
            handleFormDel(row){
                let index = this.addForm.childrenData.indexOf(row);
                if( index > -1){
                    this.addForm.childrenData.splice(index,1);
                }
            },

            clearChidren(){
                this.addForm.childrenData = [];
            },
            onOpen(){
                this.addForm.entry_at = new Date();
            }
        },
        created(){
            // console.log(this.getUser);
            this.users.users = this.getUser;
            this.addForm.user_id = this.getUser.id;
            this.addForm.user_name = this.getUser.realname;

            this.$on('submit-success', this.clearChidren);

        },
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

