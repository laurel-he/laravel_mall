<template>
    <div >
        <MyDialog title="添加" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm"  ref="addForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="单位名" prop="name">
                            <el-input  class="name-input" v-model="addForm.name"  auto-complete="off" placeholder="请填写单位名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="类型"  prop="type">
                            <el-select  v-model="addForm.type"  placeholder="请选择类型"  >
                                <el-option  v-for='(item,key) in typeList' :label="item" :value="key" :key="key"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="部门经理"  prop="manager_id">
                            <el-select v-model='addForm.manager_id'>
                                <el-option label="请选择" :value="0"></el-option>
                                <el-option v-for="user in computedusers" 
                                           :label="user.realname"
                                           :value="user.id" :key="user.id">
                                    <span class="pull-right">{{ user.department ? user.department.name : ''}}</span>
                                    <span class="pull-left">{{ user.realname }}</span>
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="配送中心" prop="entrepot_id">
                            <el-select v-model.number='addForm.entrepot_id'>
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
                            <el-radio-group v-model="addForm.status">
                                <el-radio :label="1">启用</el-radio>
                                <el-radio :label="0">禁用</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="24">
                        <el-form-item label="备注"  prop="remarks">
                            <el-input type="textarea" auto-complete="off" v-model="addForm.remarks" placeholder="请填写备注"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
    
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        @click="formSubmit('addForm')"
                        :observer="dialogThis">
                    保 存
                </submit-button>
            </div>

        </MyDialog>
    </div>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
import DataProxy from '../../packages/DataProxy';
import DepartCandidateProxy from '../../packages/DepartCandidateProxy';

export default {
    name: 'Add',
    mixins:[DialogForm],
    props:{
        typeList:{
            type:Array,
        },
        entrepotList:{
            type:Array,
            default:[]
        }

    },
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            computedusers:[
                
            ],
            addForm:{
                name:"",
                type:"",
                manager_id:0,
                remarks:"",
                status:1,
                entrepot_id:""
            },
            rules:{
                name:[
                    { required: true, message: '请输入部门名称', trigger: 'blur' }
                ],
                type:[
                    { required: true, message:'请选择类型', type: 'number', trigger:'change'}
                ],
                remarks:[
                    { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                ],
                entrepot_id:[
                    { required: true ,type :'number',message:'请选择配送中心', trigger:'change'}
                ]
            },


        }
    },
    methods:{
        getAjaxPromise(model){
            return this.ajaxProxy.create(model);
        },
        onBeforeOpen(){
            this.depart_candidate.load();
        },
        loadmanagers(data){
            // console.log(data);
            this.computedusers = data.items;
        }

    },
    created(){
        this.depart_candidate = new DepartCandidateProxy({}, this.loadmanagers, this);
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      
