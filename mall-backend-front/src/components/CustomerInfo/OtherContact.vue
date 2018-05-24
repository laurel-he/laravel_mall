<template>
    <div >
        <MyDialog title="添加联系方式" :name="name" :width="width" :height="height" @before-open="onOpen" @before-close="onBeforeClose">
            <el-table
             :data="cusContactData"
             border
             style="width: 100%">
                <el-table-column label="序号" type="index" width="80"></el-table-column>
                <el-table-column prop="phone" label="客户电话" width="170"></el-table-column>
                <el-table-column prop="qq" label="客户QQ" width="170"></el-table-column>
                <el-table-column prop="qq_nickname" label="QQ昵称" width="170"></el-table-column>
                <el-table-column prop="weixin" label="微信" width="170"></el-table-column>
                <el-table-column prop="weixin_nickname" label="微信昵称" width="170"></el-table-column>
                <el-table-column  label="操作" fixed="right" width="100">
                    <template slot-scope="scope">
                        <el-button size="small" type="primary" @click="handleCurrentChange(scope.row)">编 辑</el-button>
                        <!-- <el-button size="small" type="danger" @click="deleteAddress(scope.row)">删 除</el-button> -->
                    </template>
                </el-table-column>
            </el-table>
            
            <br>
            <el-button v-show="showAddButton" type="info" icon="plus" size="small" @click="handleAdd">联系方式</el-button>

            <el-form v-show="contactFormvisible" ref="addContactForm" :rules="rules" :model="addContactForm" 
              :label-width="labelWidth">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="手机号"  prop="phone">
                            <el-input class="name-input" v-model="addContactForm.phone" auto-complete="off" placeholder="请填写客户手机号"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="QQ号"  prop="qq">
                            <el-input class="name-input" v-model.number="addContactForm.qq" auto-complete="off" placeholder="请填写QQ"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="QQ昵称"  prop="qq_nickname">
                            <el-input class="name-input" v-model="addContactForm.qq_nickname" auto-complete="off" placeholder="请填写QQ昵称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="微信号"  prop="weixin">
                            <el-input class="name-input" v-model="addContactForm.weixin" auto-complete="off" placeholder="请填写微信号"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="微信昵称"  prop="weixin_nickname">
                            <el-input class="name-input" v-model="addContactForm.weixin_nickname" auto-complete="off" placeholder="请填写微信昵称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                
                <el-form-item >
                    <submit-button
                            @click="handleSubmit"
                            :observer="dialogThis">
                        {{ formstate }}
                    </submit-button>
                    <el-button @click="handleCancel">取 消</el-button>
                </el-form-item>
            </el-form>
        </MyDialog>
    </div>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
import CustomerContact from '../../ajaxProxy/CustomerContact';
import CustomerContactProxy from  '../../packages/CustomerContactProxy';
import { PHONE_REG,QQ_REG } from '@/config/index';

const maxLengthContacts = 2;
const FORMSTATE_ADD = '确 定';
const FORMSTATE_EDIT = '编 辑';
export default {
    name: 'other-contact',
    mixins:[DialogForm],
    props:{

    },
    data(){
        return {
            dialogThis:this,
            labelWidth:'100px',
            formstate:'',
            contactFormvisible:false,
            cus_id:null,
            id:'',
            addContactForm:{
                phone:'',
                qq:'',
                qq_nickname:'',
                weixin:'',
                weixin_nickname:'',
                cus_id:'',
                id:""
            },
            cusContactData:[],
            model:'',
            rules:{
                qq:[
                    { required: true, message:'请输入正确格式的QQ号',  pattern: QQ_REG, trigger:'blur'},
                ],
                qq_nickname:[
                    // { required: true,message:'请输入QQ昵称', type: 'string', trigger:'blur'},
                    {min:1, max: 20, message: '长度不能超过20个字符', trigger: 'blur'  }

                ],
                weixin:[
                    // { required: true, message:'请输入微信号', type: 'string', trigger:'blur'},
                    {   max: 20, message: '长度不能超过20个字符', trigger: 'blur'  }
                ],
                weixin_nickname:[
                    // { required: true, message:'请输入微信昵称', type: 'string', trigger:'blur'},
                    {   max: 20, message: '长度不能超过20个字符', trigger: 'blur'  }
                ],
                phone:[
                    { required: true, message:'请输入正确的手机号', pattern: PHONE_REG, trigger:'blur'},
                ],
            },
            dev:[],
            contactsLength:1,
        }
    },
    computed:{
        showAddButton(){
            return this.contactsLength != maxLengthContacts;
        },
        mainparam(){
            return JSON.stringify({cus_id: this.cus_id });
        }
    },
    methods:{
        onOpen(param){
            this.contactsLength = 1;
            this.cus_id = param.params.model.id;
            this.setContactData(this.cus_id);
        },
        handleSubmit(){
            this.addContactForm.cus_id=this.cus_id;
            this.formSubmit('addContactForm');
        },
        getAjaxProxy(){
            return  CustomerContact;
        },
        getAjaxPromise(model){
            if(this.formstate == FORMSTATE_EDIT){
                return CustomerContact.update(model.id, model);
            }else if(this.formstate == FORMSTATE_ADD){
                return CustomerContact.create(model);
            }
        },
        handleCurrentChange(row){
            this.showForm();
            this.formstate = FORMSTATE_EDIT;
            // this.addContactForm = row;
            this.initObject(row, this.addContactForm);
        },
        showForm(){
            this.contactFormvisible = true;
        },
        hideForm(){
            this.contactFormvisible = false;
            this.formstate='';
        },
        handleAdd(){
            this.formReset();
            this.showForm();
            this.formstate = FORMSTATE_ADD;
        },
        handleCancel(){
             this.formReset();
             this.hideForm();
             this.setContactData(this.cus_id);
        },
        formReset(){
            this.$refs.addContactForm.resetFields();
            if(this.formstate == FORMSTATE_ADD){
                this.addContactForm.id = '';
            }else if(this.formstate == FORMSTATE_EDIT){
                this.addContactForm.id = this.id;
            }
            this.addContactForm.cus_id = this.cus_id;
            this.formstate='';
        },
        deleteAddress(row){
            this.cus_id=row.cus_id;
            this.handleDelete(row.id);
        },
        handleDelete(id){
            let vmthis = this;
            let ajaxProxy = this.getAjaxProxy();
            if(!ajaxProxy){
                return ;
            }
            this.$confirm('确定删除?', '警告',{
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(()=>{
                ajaxProxy.delete(id).then(function(response){
                    vmthis.$message.success("操作成功");
                    vmthis.setContactData(vmthis.cus_id);
                }).catch(function(error){
                    vmthis.$message.error("出错了")
                });
            });
        },
        setContactData(cus_id){
            let param = {
                cus_id:cus_id,
                business:'theCus'
            };
            let customerContactProxy = new CustomerContactProxy(param,this.getContactData, this);
            customerContactProxy.load();
        },
        getContactData(data){
            this.cusContactData=data;
            if(data.length >=2){
                this.contactsLength = 2;
            }
        },
        onBeforeClose(){
            this.formReset();
            this.hideForm();
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      
