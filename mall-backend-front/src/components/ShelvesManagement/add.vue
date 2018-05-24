<template>
    <div >
        <MyDialog title="添加货架" :name="name" :width="width" :height="height" >
            <el-form :model="addForm"  :label-width="labelWidth" :rules="rules" ref="addForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="货架名称" prop="shelves_name" >
                            <el-input class="name-input" v-model="addForm.shelves_name"  auto-complete="off"  placeholder="请填写货架名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="货架编号" prop="shelves_num" >
                            <el-input class="name-input" v-model="addForm.shelves_num"  auto-complete="off"  placeholder="请填写货架编号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="配送中心" prop="distributor_id" >
                            <el-select v-model="addForm.distributor_id" placeholder="请选择配送中心" @change="distributorChange">
                                <el-option v-for="v in distributors" :label="v.name" :value="v.id" :key="v.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="负责人" prop="shelves_manager_id" >
                            {{getUser.realname}}
                            <!--<el-select v-model="addForm.shelves_manager_id" placeholder="请选择负责人" @change="managerChange">-->
                                <!--<el-option v-for="v in managers" :label="v.name" :value="v.id" :key="v.id"></el-option>-->
                            <!--</el-select>-->
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
                    @click="formSubmit('addForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import { mapActions,mapGetters } from 'vuex';
    // import Dialog from '../common/Dialog';
    export default {
        name: 'addDialog',
        mixins:[DialogForm],
        props:{
            distributors:{
                type: Array,
                default:function(){
                    return [];
                }
            },
            managers:{
                type: Array,
                default:function(){
                    return [];
                }
            },
        },
        computed:{
            ...mapGetters([
                'getUser'
            ])
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                addForm:{
                    shelves_name: "",
                    shelves_status:0,
                    shelves_num: "",
                    distributor_id: "",
                    distributor_name: "",
                    shelves_manager_id: '',
                    shelves_manager_name: "",
                    remark: '',
                },

                rules:{
                    shelves_name:[
                        { required: true, message: '请输入货架名称', trigger: 'blur' },
                        { max:20, message: '输入的内容不能超过20个字符', trigger: 'blur' }
                    ],
                    shelves_num:[
                        { required: true, message:'请输入货架编号', trigger: 'blur', },
                        { max:20, message: '输入的内容不能超过20个字符', trigger: 'blur' }
                    ],
                    distributor_id:[
                        { required: true,message:'请选择配送中心', type: 'number', trigger:'change'}
                    ],
                    shelves_manager_id:[
                        { required: true,message:'请选择货架负责人', type: 'number', trigger:'change'}
                    ],

                }
            }
        },
        methods:{

            getAjaxPromise(model){
                return this.ajaxProxy.create(model);
            },
            loadUsers(data){
                this.computedusers = data.items;
            },
            // formSubmit(){
            //     console.log(this.addForm);
            // },
            distributorChange(id){
                let items = this.distributors;
                for(let v in items){
                    if(items[v]['id'] == id){
                      this.addForm.distributor_name = items[v]['name'];
                    }
                }
            },
            managerChange(id){
                let items = this.managers;
                for(let v in items){
                    if(items[v]['id'] == id){
                        this.addForm.shelves_manager_name = items[v]['name'];
                    }
                }
            },

            onDepartChange(v){
                this.employeeSelect.setParam({department_id:v, role:'group-captain', group_candidate:1})
                this.employeeSelect.load();
                this.addForm.manager_id = "";
            },
        },
        created(){
            this.addForm.shelves_manager_id = this.getUser.id;
            this.addForm.shelves_manager_name = this.getUser.realname;

        }
        
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

