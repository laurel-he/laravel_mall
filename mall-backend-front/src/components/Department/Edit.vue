<template>
    <div >
        <MyDialog title="编辑" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form ref="editForm"  :label-width="labelWidth" :rules="rules" :model="editForm" :label-position="labelPosition" >
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="单位名" prop="name">
                            <el-input v-model="editForm.name"  auto-complete="off"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="类型" prop="type">
                            <el-select  v-model="editForm.type"  :disabled="true" >
                                <el-option  v-for='(item,key) in typeList' :label="item" :value="key" :key="key"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="部门经理"  prop="contact" >
                            <el-select v-model='editForm.manager_id'>
                                <el-option
                                v-for="user in computedusers"
                                :label="user.realname"
                                :value="user.id"
                                :key="user.id">
                                <span class="pull-right">{{ user.department ? user.department.name : ''}}</span>
                                <span class="pull-left">{{ user.realname }}</span>
                            </el-option>
                                <el-option label="撤消负责人" :value="0"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="配送中心" prop="entrepot_id">
                            <el-select v-model.number='editForm.entrepot_id'>
                                <el-option v-for="entrepot in entrepotList" 
                                            :label="entrepot.name"
                                            :value="entrepot.id" :key="entrepot.id">
                                </el-option>
                            </el-select>
                            
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="是否启用" prop="status">
                            <el-radio-group v-model="editForm.status">
                                <el-radio :label="1">启用</el-radio>
                                <el-radio :label="0">禁用</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="remarks">
                            <el-input type="textarea"  auto-complete="off" v-model="editForm.remarks" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <div slot="dialog-foot">
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
    import DepartCandidateProxy from '../../packages/DepartCandidateProxy';


    export default {
        name: 'editDialog',
        mixins:[DialogForm],
        props:{
            typeList:{
                type:Array,
                default:['销售部','推广部','风控部','人事部']
            },
            ajaxProxy:{
                required:true,
                type: Object,
                default: null
            },
            entrepotList:{
                type:Array,
                default:[]
            }
        },
        data () {
            return {
                dialogThis:this,
                labelWidth:'80px',
                labelPosition:"right",

                computedusers:[],

                editForm:{
                    id:'',
                    type:'',
                    name:'',
                    remarks:'',
                    manager_id:'',
                    status:'',
                    entrepot_id:''
                },
                rules:{
                    remarks:[
                        { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                    ]
                },
                model:null

            }
        },

        methods:{
            onOpen(param){
                // console.log(param);
                this.model = param.params.model;

                this.depart_candidate.setParam({id: this.model.manager_id});
                this.depart_candidate.load();
            },

            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id, model);
            },

            loadmanagers(data){
                // console.log(data);
                this.computedusers = data.items;
            }

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
            this.depart_candidate = new DepartCandidateProxy({}, this.loadmanagers, this);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

