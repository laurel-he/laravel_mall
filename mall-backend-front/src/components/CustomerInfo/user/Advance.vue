<template>
        <div >
            <MyDialog title="高级查询" :name="name" :width="width" :height="height" >
                <el-form :model="queryForm" ref="queryForm"  :label-width="labelWidth" 　  :label-position="labelPosition">
                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="客户姓名" prop="name" >
                                <el-input  class="name-input" v-model="queryForm.name"  auto-complete="off" placeholder="请填写客户姓名"></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="客户类型" prop="type" >
                                <el-select v-model="queryForm.type" clearable>
                                    <el-option v-for="(value, key) in cusType" :label="value" :key="key" :value="key"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>

                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="手机" prop="phone">
                                <el-input class="name-input" v-model="queryForm.phone" ></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="QQ" prop="qq">
                                <el-input class="name-input" v-model="queryForm.qq" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="微信" prop="weixin">
                                <el-input class="name-input" v-model="queryForm.weixin" ></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :span="12">
                            <el-form-item label="身份证号" prop="id_card">
                                <el-input class="name-input" v-model="queryForm.id_card" ></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row>
                        <el-col :span="12">
                            <el-form-item label="住址" prop="cus_address">
                                <el-input
                                    type="textarea"
                                    :rows="2"
                                    placeholder="请输入内容"
                                    v-model="queryForm.cus_address">
                                  </el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </el-form>
        
                <div slot="dialog-foot" class="dialog-footer">
                    <el-button @click="handleClose">取 消</el-button>
                    <el-button @click="handleReset">重 置</el-button>
                    <el-button type="primary" @click="handleSubmit">查 询</el-button>

                    <!-- <submit-button
                            @click="formSubmit('queryForm')"
                            :observer="dialogThis">
                        查 询
                    </submit-button> -->
                </div>
    
            </MyDialog>
        </div>
    </template>
    
    <script>
    import DialogForm from '@/mix/DialogForm';
    
    export default {
        name: 'Advance',
        mixins:[DialogForm],
        props:{
            cusType:{
                type:Object,
                default:function(){
                    return {};
                }
            },
            userId:{
                
            }
        },
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                state7: this.addOpen,
                departments:[],
                groups:[],
                users:[],
                queryForm:{
                    user_id:"",
                    name:"",
                    qq:'',
                    weixin:"",
                    phone:'',
                    type:'',
                    id_card:'',
                    cus_address:'',
                }
            }
        },
    
        methods:{
            handleReset(){
                this.$refs.queryForm.resetFields();
                this.$parent.$emit('search-tool-change', {});
            },
            handleSubmit(){
                this.$parent.$emit('search-tool-change', this.queryForm);
                this.handleClose();
            },
        },
        created(){
            this.searchForm.user_id = this.userId;      
        }
    
    }
    </script>
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
        .name-input{
            max-width: 217px;
        }
    </style>
          