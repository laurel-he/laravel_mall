<template>
    <div >
        <MyDialog title="添加客户收货地址" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-table
             :data="addressData"
             border
             style="width: 100%">
                <el-table-column label="序号" type="index" width="80 px"></el-table-column>
                <el-table-column prop="name" label="收货人姓名"></el-table-column>
                <el-table-column prop="phone" label="收货人手机号"></el-table-column>
                <el-table-column prop="zip_code" label="收货邮编"></el-table-column>
                <el-table-column prop="address" label="收货地址"></el-table-column>
                <el-table-column  label="操作" align="center">
                    <template slot-scope="scope">
                        <el-button size="small" type="primary" @click="handleCurrentChange(scope.row)">编 辑</el-button>
                        <el-button size="small" type="danger" @click="deleteAddress(scope.row)">删 除</el-button>
                    </template>
                </el-table-column>
            </el-table>
            
            <br/>
                <el-button v-show="showAddButton" type="primary" size="small" @click="handleAdd"> 添加地址 </el-button> <span></span>
            <el-form v-show="contactFormvisible" ref="addDeliveryAddressForm" :model="addDeliveryAddressForm"  :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item prop="name" label="收货人姓名">
                            <el-input class="name-input" v-model="addDeliveryAddressForm.name" size="small" placeholder="收货人姓名" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="phone" label="收货人手机号">
                            <el-input class="name-input" v-model="addDeliveryAddressForm.phone" size="small" placeholder="收货人手机号" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="zip_code" label="收货邮编">
                            <el-input class="name-input" v-model="addDeliveryAddressForm.zip_code" size="small" placeholder="收货邮编" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="default_address" label="是否为默认地址">
                            <el-radio-group v-model="addDeliveryAddressForm.default_address">
                                <el-radio :label="1">是</el-radio>
                                <el-radio :label="0">否</el-radio>
                            </el-radio-group>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item prop="address" label="收货地址">
                            <el-input type="textarea" class="name-input"  v-model="addDeliveryAddressForm.address"  placeholder="收货地址" ></el-input>
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
import DataProxy from '../../packages/DataProxy';
import SelectProxy from  '../../packages/SelectProxy';

const maxLengthContacts = 20;
const FORMSTATE_ADD = '确 定';
const FORMSTATE_EDIT = '编 辑';
export default {
     name: 'addAddress',
     mixins:[DialogForm],
     props:{
    },
    data(){
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            formstate:'',
            contactFormvisible:false,
            cus_id:'',
            id:'',
            addDeliveryAddressForm:{
                name:'',
                phone:'',
                address:'',
                default_address:1,
                zip_code:'',
                cus_id:'',
            },
            addressData:[],
            model:'',
            dev:[]
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
        handleSubmit(){
            this.addDeliveryAddressForm.cus_id=this.cus_id;
            this.formSubmit('addDeliveryAddressForm');
        },
        getAjaxProxy(){
            return  this.ajaxProxy;
        },
        formSubmit(name){
            let model = this[name];
            if (this.$refs[name].rules) {
                this.$refs[name].validate((valid)=>{
                    if (valid) {
                        this.realSubmit(model, name);
                    } else {
                        console.log('error submit!!', name);
                        this.$emit('valid-error', name);
                        return false;
                    }
                })
            } else {
                this.realSubmit(model, name);
            }
        },
        getAjaxPromise(model){
            if(this.formstate == FORMSTATE_EDIT){
                return this.ajaxProxy.update(model.id, model);
            }else if(this.formstate == FORMSTATE_ADD){
                return this.ajaxProxy.create(model);
            }
        },
        realSubmit(model, name){
            let ajaxPromise =  this.getAjaxPromise(model);
            let vmthis = this;
            ajaxPromise.then(function(response){
                vmthis.$message.success('操作成功');
                vmthis.$refs[name].resetFields();
                vmthis.getAddress(vmthis.cus_id);
                vmthis.hideForm();
            }).catch(function(error){
                if(error.response){
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                }else{
                    console.log('Error',error.message);
                }
                vmthis.$message.error('出错了');
            }).then(function(){
                vmthis.$emit('submit-final', name);
            });
        },
        onOpen(param){
            this.cus_id = param.params.model.contacts[0].cus_id;
            this.id = param.params.model.id;
            this.getAddress(this.cus_id);
        },
        handleCurrentChange(row){
            this.showForm();
            this.formstate = FORMSTATE_EDIT;
            this.addDeliveryAddressForm = row;
            this.initObject(row, this.addDeliveryAddressForm);
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
             this.getAddress(this.cus_id);
        },
        formReset(){
            if(this.formstate == FORMSTATE_ADD){
                this.$refs.addDeliveryAddressForm.resetFields();
                this.addDeliveryAddressForm.id = '';
            }else if(this.formstate == FORMSTATE_EDIT){
                this.$refs.addDeliveryAddressForm.resetFields();
                this.addDeliveryAddressForm.id = this.id;
            }
            this.addDeliveryAddressForm.cus_id = this.cus_id;
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
                    vmthis.getAddress(vmthis.cus_id);
                }).catch(function(error){
                    vmthis.$message.error("出错了")
                });
            });
        },

        getAddress(cus_id){
            let selectProxy = new SelectProxy(this.ajaxProxy.getUrl()+'?cus_id='+cus_id, this.getAddressData, this);
            selectProxy.load();
        },
        getAddressData(data){
            this.addressData=data.items;
        },

    },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      
