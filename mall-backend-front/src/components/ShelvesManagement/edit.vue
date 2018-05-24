<template>
    <div >
        <MyDialog title="修改货架" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm"  :label-width="labelWidth" :rules="rules" ref="editForm" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="货架名称" prop="shelves_name" >
                            <el-input class="name-input" v-model="editForm.shelves_name"  auto-complete="off"  placeholder="请填写货架名称"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="货架编号" prop="shelves_num" >
                            <el-input class="name-input" v-model="editForm.shelves_num"  auto-complete="off"  placeholder="请填写货架编号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="配送中心" prop="distributor_id" >
                            <el-select v-model="editForm.distributor_id" placeholder="请选择配送中心" @change="distributorChange">
                                <el-option v-for="v in distributors" :label="v.name" :value="v.id" :key="v.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="负责人" prop="shelves_manager_id" >
                            {{editForm.shelves_manager_name}}
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="remark">
                            <el-input type="textarea"  auto-complete="off" v-model="editForm.remark" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="formSubmit('editForm')" >
                    保 存
                </submit-button>
            </div>
        </MyDialog>
    </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import { mapGetters } from 'vuex';
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
        components:{
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                editForm:{
                    id:'',
                    shelves_name: "",
                    shelves_num: "",
                    distributor_id: "",
                    distributor_name: "",
                    shelves_manager_id: "",
                    shelves_manager_name: "",
                    remark: '',
                },
                model:'',
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
                return this.ajaxProxy.update(model.id, model);
            },
            loadUsers(data){
                this.computedusers = data.items;
            },
            // formSubmit(){
            //     console.log(this.editForm);
            // },
            onOpen(param){
                this.model = param.params.model;
            },
            distributorChange(id){
                let items = this.distributors;
                for(let v in items){
                    if(items[v]['id'] == id){
                      this.editForm.distributor_name = items[v]['name'];
                    }
                }
            },
            managerChange(id){
                let items = this.managers;
                for(let v in items){
                    if(items[v]['id'] == id){
                        this.editForm.shelves_manager_name = items[v]['name'];
                    }
                }
            },

            onDepartChange(v){
                this.employeeSelect.setParam({department_id:v, role:'group-captain', group_candidate:1})
                this.employeeSelect.load();
                this.editForm.manager_id = "";
            },
        },
        watch:{
            model:function(val, oldVal){
                for (const key in this.editForm) {
                    if (this.editForm.hasOwnProperty(key)) {
                        this.editForm[key] = val[key]
                    }
                }

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

