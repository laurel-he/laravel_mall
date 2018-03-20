<template>
    <MyDialog title="商品入库" :name="name" :width="width" :height="height">
        <el-form :model="intoForm" :inline="true" class="demo-form-inline" ref="intoForm">
            <el-row>
                <el-col :span="12">
                    <el-form-item label="商品类型">
                        <el-select v-model="intoForm.goods_type" placeholder="请选择商品类型" clearable>
                            <el-option v-for="type in goodsType" :label="type.name" :value="type.name" :key="type.id"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="商品名称">
                        <el-input v-model="intoForm.goods_name"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="12">
                    <el-form-item label="商品数量">
                        <el-input-number v-model="intoForm.goods_sum" :min="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="商品型号">
                        <el-input v-model="intoForm.goods_version"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :span="12">
                    <el-form-item label="商品批次">
                        <el-input v-model="intoForm.goods_batch"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="入库时间">
                        <el-date-picker
                                v-model="intoForm.create_time"
                                type="date"
                                format="yyyy-MM-dd"
                                @change="getTime"
                                placeholder="选择日期时间">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col>
                    <el-form-item label="入库人">
                        <el-select v-model="intoForm.user_id" placeholder="请选择入库人">
                            <el-option v-for="user in users" :label="user.realname" :value="user.id" :key="user.id"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row> 
        </el-form>
        <div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">取 消</el-button>
                <submit-button
                    :observer="dialogThis"
                    @click="formSubmit('intoForm')" >
                    确 定
                </submit-button>
        </div>
    </MyDialog>
</template>

<script>
    import DialogForm from '../../mix/DialogForm'

    export default {
        name:'intoStorage',
        mixins:[DialogForm],
        props:{
            goodsType:{
                type: Array,
                default:[]
            },
            users:{
                type:Array,
                default:function(){
                    return [];
                }
            }
        },
        data(){
            return{
                dialogThis:this,
                intoForm:{
                    type:'1',
                    goods_name: '',
                    goods_type:'',
                    goods_sum:'',
                    goods_version:'',
                    goods_batch:'',
                    create_time:'',
                    user_id:'',
                    // creator:""
                }

            }
        },
        methods:{
            // addStorage:function () {
            //     this.intoForm.types='入库';
            //     this.$emit('addStorage',this.intoForm)
            //     this.$modal.hide(this.name)
            //     //console.log(this.intoForm)
            // },
            getTime:function (val) {
                this.intoForm.create_time=val
            },

            getAjaxPromise (model){
                return this.ajaxProxy.create(model);
            }
        }
    }
</script>

<style>
</style>