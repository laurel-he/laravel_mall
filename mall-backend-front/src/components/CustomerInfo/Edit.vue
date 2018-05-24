<template>
    <div >
        <MyDialog title="修改客户资料" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm" ref="editForm"  :label-width="labelWidth" :rules="rules"  :label-position="labelPosition">
                <el-tabs v-model="activeName">
                    <el-tab-pane label="核心资料" name="first">
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="客户姓名" prop="name" >
                                    <el-input  class="name-input" v-model="editForm.name"  auto-complete="off" placeholder="请填写客户姓名"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="客户年龄"  prop="age">
                                    <el-input  class="name-input" v-model.number="editForm.age"  auto-complete="off" placeholder="请填写客户年龄"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="客户类型" prop="type">
                                    <el-select v-model="editForm.type" placeholder="请选择客户类型" >
                                        <el-option v-for="(type, key) in customerType" :label="type" :value="key" :key="key"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="客户来源" prop="source">
                                    <el-select v-model="editForm.source" placeholder="请选择客户来源" >
                                        <el-option v-for="(type, key) in customerSource" :label="type" :value="key" :key="key"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <!-- <el-row>
                            <el-col :span="12">
                                <el-form-item label="QQ号"  prop="qq">
                                    <el-input class="name-input" v-model.number="editForm.qq"  auto-complete="off" placeholder="请填写QQ"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="QQ昵称"  prop="qq_nickname">
                                    <el-input class="name-input" v-model="editForm.qq_nickname"  auto-complete="off" placeholder="请填写QQ昵称"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="微信号"  prop="weixin">
                                    <el-input class="name-input" v-model="editForm.weixin"  auto-complete="off" placeholder="请填写微信号"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="微信昵称"  prop="weixin_nickname">
                                    <el-input class="name-input" v-model="editForm.weixin_nickname"  auto-complete="off" placeholder="请填写微信昵称"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row> -->
                        <el-row>
                            <!-- <el-col :span="12">
                                    <el-form-item label="手机号"  prop="phone">
                                        <el-input class="name-input" v-model.number="editForm.phone"  auto-complete="off" placeholder="请填写客户手机号"></el-input>
                                    </el-form-item>
                            </el-col> -->
                            <el-col :span="12">
                                <el-form-item label="性别" prop="sex">
                                    <el-radio-group v-model="editForm.sex">
                                        <el-radio :label="1">男</el-radio>
                                        <el-radio :label="2">女</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-tab-pane>
                    <el-tab-pane label="一般资料" name="second">
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="省份" prop="area_province">
                                    <el-select v-model="editForm.area_province" :filterable="true"
                                         @change="provinceChange" placeholder="请选择省份" >
                                        <el-option v-for="province in provinces" :label="province.name" 
                                            :value="province.id" :key="province.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item  label="市/县" prop="area_city">
                                    <el-select v-model="editForm.area_city" placeholder="请选择城市" >
                                        <el-option v-for="city in cities" :label="city.name"
                                         :value="city.id" :key="city.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="14">
                                <el-form-item label="身份证号" prop="id_card">
                                    <el-input v-model="editForm.id_card" placeholder="身份证号"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="详细地址" prop="cus_address">
                                    <el-input type="textarea" :rows="2" v-model="editForm.cus_address" placeholder="填写地址"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="兴趣爱好" prop="hobby">
                                    <el-input type="textarea" :rows="2" v-model="editForm.hobby" placeholder="兴趣爱好"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="常用产品" prop="commonly_production">
                                    <el-input type="textarea" :rows="2" v-model="editForm.commonly_production" placeholder="常用产品"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="备注" prop="remark">
                                    <el-input type="textarea" :rows="2" v-model="editForm.remark" placeholder="备注"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-tab-pane>
                </el-tabs>
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
import AreaSelect from '../../packages/AreaSelectProxy';
export default {
    name: 'Edit',
    mixins:[DialogForm],
    props:{
        ajaxProxy:{
            required:true,
            type: Object,
            default: null
        }
    },
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            editForm:{
                id:'',
                name:"",
                age:'',
                // qq:'',
                // qq_nickname:"",
                // weixin:"",
                // weixin_nickname:'',
                sex:1,
                // phone:'',
                type:'',
                source:'',
                area_province:'',
                area_city:'',
                id_card:'',
                cus_address:'',
                hobby:'',
                commonly_production:'',
                remark:'',
            },
            customerType:{},
            customerSource:{},
            provinces:[],
            cities:[],
            activeName:'first',
            rules:{
                name:[
                    { required: true, message: '请输入姓名', trigger: 'blur' },
                    { min:1,   max: 10, message: '长度不能超过10个字符', trigger: 'blur'  }
                ],
                age:[
                    { required: true, message:'请输入正确格式的年龄', trigger: 'blur', type: 'number'},
                    {min:1,  max: 120, message: '请输入合理的年龄', trigger: 'blur' ,type: 'number' }
                ],
                qq:[
                    { required: true,message:'请输入正确格式的QQ号', type: 'number', trigger:'blur'},
                    {min:1, max: 999999999999999, message: '请输入合理的QQ',type: 'number', trigger: 'blur'  }

                ],
                qq_nickname:[
                    { required: true,message:'请输入QQ昵称', type: 'string', trigger:'blur'},
                    {min:1, max: 20, message: '长度不能超过20个字符', trigger: 'blur'  }

                ],
                weixin:[
                    { required: true, message:'请输入微信号', type: 'string', trigger:'blur'},
                    {   max: 20, message: '长度不能超过20个字符', trigger: 'blur'  }
                ],
                weixin_nickname:[
                    { required: true, message:'请输入微信昵称', type: 'string', trigger:'blur'},
                    {   max: 20, message: '长度不能超过20个字符', trigger: 'blur'  }
                ],
                phone:[
                    { required: true,max: 99999999999, message:'请输入正确的手机号', type: 'number', trigger:'blur'},
                ],
            },
            model:''
        }
    },
    methods:{
        getAjaxPromise(model){
            return this.ajaxProxy.update(model.id, model);
        },
        onOpen(param){
             // console.log(param);
            this.model = param.params.model;
            this.model.qq = parseInt(param.params.model.contacts[0].qq);
            this.model.qq_nickname = param.params.model.contacts[0].qq_nickname;
            this.model.weixin = param.params.model.contacts[0].weixin;
            this.model.weixin_nickname = param.params.model.contacts[0].weixin_nickname;
            this.model.phone = parseInt(param.params.model.contacts[0].phone);

            this.customerType = param.params.extra.type;
            this.customerSource = param.params.extra.source;
            this.provinces = param.params.extra.provinces;
            this.provinceChange(param.params.model.area_province);
        },
        getAreaCities(data){
            this.cities = data;
        },
        provinceChange(id){
            this.editForm.area_city = '';
            let areaSelect = new AreaSelect({pid:id,business:'city'},this.getAreaCities,this);
            areaSelect.load();
        },

    },
    watch:{
        model:function(val, oldVal){
            for (const key in this.editForm) {
                if (this.editForm.hasOwnProperty(key)) {
                    this.editForm[key] = val[key]
                }
                if(key == 'type'){
                    this.editForm[key] = this.editForm[key].toString();
                }
                if(key == 'source'){
                    this.editForm[key] = this.editForm[key].toString();
                }
                if(key == 'age'){
                    this.editForm[key] = parseInt(this.editForm[key]);
                }
            }
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
      