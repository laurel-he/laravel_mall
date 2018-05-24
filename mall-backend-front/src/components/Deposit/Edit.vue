<template>
    <div>
        <MyDialog title="编辑记录" :name="name" :width="width" :height="height"  @before-open="onOpen">
                <el-alert
                title="警告! 在这里修改金额并不会影响部门的保证金，仅仅只是修改充值记录．"
                type="warning"
                show-icon>
              </el-alert>
              <br>
            <el-form :model="editForm"  ref="editForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="部门" prop="department_name">
                            {{ editForm.department_name }}
                        </el-form-item>
                    </el-col>
                    
                    <el-col :span="12">
                        <el-form-item label="金额" prop="money" >
                            <el-input class="name-input"  placeholder="输入金额" v-model.number="editForm.money"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="充值方式" prop="charge_type" >
                            <el-select   placeholder="请选择充值方式"  v-model="editForm.charge_type" >
                                <el-option v-for="(v,index) in chargeTypes"
                                    :label="v.name"
                                    :value="v.id"
                                    :key="index">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                    <el-col :span="12">
                        <el-form-item label="充值时间" prop="charge_time" >
                            <el-date-picker
                                    v-model="editForm.charge_time"
                                    type="date"
                                     placeholder="选择充值时间"
                                    :picker-options="pickerOptions"
                                    :editable="false"
                                    @change="timeChange">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="备注" prop="remark" >
                            <el-input type="textarea" :rows="2" v-model="editForm.remark"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>
    
            <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                        @click="formSubmit('editForm')"
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

import DepartSelectProxy from '../../packages/DepartSelectProxy';
import GroupSelectProxy from '../../packages/GroupSelectProxy';
import EmployeeSelectProxy from '../../packages/EmployeeSelectProxy';

import { mapGetters } from 'vuex';

export default {
    name: 'Edit',
    mixins:[DialogForm],
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            departments:[],
            groups:[],
            users:[],
            chargeTypes:[
                {id:1,name:'微信'},
                {id:2,name:'支付宝'},
                {id:3,name:'银行转账'},
                ],
            departmentInput:'',
            groupInput:'',
            userInput:'',
            editForm:{
                id:"",
                //department_id:"",
                // group_id:"",
                // user_id:"",
                department_name:"",
                group_name:"",
                charge_type:'',
                charge_time:"",
                //realname:"",
                money:"",
                //creator_id:"",
                //creator:"",
                remark:"",
                //charge_department:""
            },
            rules:{
                money:[
                    { required: true, message:'金额未输入或输入的格式不正确', pattern:/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/ , trigger:'blur',min:0 }
                ],
                remark:[
                    { message:'输入内容最大长度为200', type: 'string', trigger:'blur', max:200}
                ]
            },
            pickerOptions: {
                disabledDate(time) {
                    return time.getTime() > Date.now() ;
                }
            },
            model:null
        }
    },
    computed:{
        ...mapGetters({
            'creator_id':'user_id',
            'creator':'realname',
            'departName':'departName'
        })
    },
    methods:{
        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
        },
        timeChange(v){
            this.editForm.charge_time=v;
        },
        loadDepartment(data){
            this.departments = data.items;
        },
        // onDepartChange(index){
        //     this.editForm.department_id=this.departments[index].id;
        //     this.editForm.department_name=this.departments[index].name;
        // },
        onOpen(param){
            // console.log(param);
            this.model = param.params.model;
        },
    },
    watch:{
        model:function(val, oldVal){
            this.initObject(val, this.editForm);
        }
    },
    created(){
        // let departProxy = new DepartSelectProxy(null, this.loadDepartment, this);
        // this.departProxy = departProxy;
        // this.departProxy.load();

        // this.editForm.creator_id = this.creator_id;
        // this.editForm.creator = this.creator;
        
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      