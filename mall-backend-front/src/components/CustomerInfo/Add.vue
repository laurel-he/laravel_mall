<template>
    <div >
        <MyDialog title="添加客户" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="addForm" ref="addForm"  :label-width="labelWidth" :rules="rules"  :label-position="labelPosition">
                <el-tabs v-model="activeName">
                    <el-tab-pane label="核心资料" name="first">
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="客户姓名" prop="name" >
                                    <el-input  class="name-input" v-model="addForm.name"  auto-complete="off" placeholder="请填写客户姓名"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="客户年龄"  prop="age">
                                    <el-input  class="name-input" v-model.number="addForm.age"  auto-complete="off" placeholder="请填写客户年龄"></el-input>

                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="客户类型" prop="type">
                                    <el-select v-model="addForm.type" placeholder="请选择客户类型" >
                                        <el-option v-for="(type, key) in customerType" :label="type" :value="key" :key="key"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="客户来源" prop="source">
                                    <el-select v-model="addForm.source" placeholder="请选择客户来源" >
                                        <el-option v-for="(type, key) in customerSource" :label="type" :value="key" :key="key"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="QQ号"  prop="qq">
                                    <el-input class="name-input" v-model.number="addForm.qq"  auto-complete="off" placeholder="请填写QQ"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="QQ昵称"  prop="qq_nickname">
                                    <el-input class="name-input" v-model="addForm.qq_nickname"  auto-complete="off" placeholder="请填写QQ昵称"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                <el-form-item label="微信号"  prop="weixin">
                                    <el-input class="name-input" v-model="addForm.weixin"  auto-complete="off" placeholder="请填写微信号"></el-input>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="微信昵称"  prop="weixin_nickname">
                                    <el-input class="name-input" v-model="addForm.weixin_nickname"  auto-complete="off" placeholder="请填写微信昵称"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="12">
                                    <el-form-item label="手机号"  prop="phone">
                                        <el-input class="name-input" v-model.number="addForm.phone"  auto-complete="off" placeholder="请填写客户手机号"></el-input>
                                    </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item label="性别" prop="sex">
                                    <el-radio-group v-model="addForm.sex">
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
                                    <el-select v-model="addForm.area_province" :filterable="true"
                                         @change="provinceChange" placeholder="请选择省份" >
                                        <el-option v-for="province in provinces" :label="province.name" 
                                            :value="province.id" :key="province.id">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                            <el-col :span="12">
                                <el-form-item  label="市/县" prop="area_city">
                                    <el-select v-model="addForm.area_city" placeholder="请选择城市" >
                                        <el-option v-for="city in cities" :label="city.name"
                                         :value="city.id" :key="city.id"></el-option>
                                    </el-select>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="14">
                                <el-form-item label="身份证号" prop="id_card">
                                    <el-input v-model="addForm.id_card" placeholder="身份证号"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="详细地址" prop="cus_address">
                                    <el-input type="textarea" :rows="2" v-model="addForm.cus_address" placeholder="填写地址"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="兴趣爱好" prop="hobby">
                                    <el-input type="textarea" :rows="2" v-model="addForm.hobby" placeholder="兴趣爱好"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="常用产品" prop="commonly_production">
                                    <el-input type="textarea" :rows="2" v-model="addForm.commonly_production" placeholder="常用产品"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-col :span="18">
                                <el-form-item label="备注" prop="remark">
                                    <el-input type="textarea" :rows="2" v-model="addForm.remark" placeholder="备注"></el-input>
                                </el-form-item>
                            </el-col>
                        </el-row>
                    </el-tab-pane>
                </el-tabs>
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
import AreaSelect from '../../packages/AreaSelectProxy';
import { PHONE_REG,QQ_REG } from '@/config/index';
export default {
    name: 'Add',
    mixins:[DialogForm],
    props:{
        ajaxProxy:{
            type:Object,
        }
    },
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            state7: this.addOpen,
            addForm:{
                name:"",
                age:'',
                qq:'',
                qq_nickname:"",
                weixin:"",
                weixin_nickname:'',
                sex:1,
                phone:'',
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
            customerType:null,
            customerSource:null,
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
                    { required: true,message:'请输入正确格式的QQ号',pattern: QQ_REG, trigger:'blur'},
                    // {min:1, max: 999999999999999, message: '请输入合理的QQ',type: 'number', trigger: 'blur'  }

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
                    {required: true, message:'请输入正确的手机号',pattern: PHONE_REG,trigger:'blur'},
                ],
            }

        }
    },

    methods:{
        getAjaxPromise(model){
            return this.ajaxProxy.create(model);
        },
        onOpen(param){
            this.customerType = param.params.extra.type;
            this.customerSource = param.params.extra.source;
            this.provinces = param.params.extra.provinces;
        },
        getAreaCities(data){
            this.cities = data;
        },
        provinceChange(id){
            this.addForm.area_city = '';
            let areaSelect = new AreaSelect({pid:id,business:'city'},this.getAreaCities,this);
            areaSelect.load();
        },

    },

}
</script>
<!--客户添加项：姓名、客户类型、联系方式及昵称(QQ、手机、微信)、联系方式2及昵称、
客户来源、性别、年龄、省、市、县、地址、身份证、兴趣爱好、常用产品、备注等。 -->
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      