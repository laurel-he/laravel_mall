<template>
    <div>
        <MyDialog title="编辑/设置" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm" ref="editForm" :rules="rules" :label-width="labelWidth" :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="配送中心" prop="entrepot_id" >
                            <el-select
                                v-model="editForm.entrepot_id"
                                size="small" disabled
                                placeholder="配送中心">
                                <el-option v-for="v in distributors" :label="v.name"
                                        :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="商品名称"  prop="goods_name">
                            <el-input v-model="editForm.goods_name" disabled auto-complete="off" placeholder="商品名称"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品类型"  prop="cate_type_id">
                            <el-select
                                v-model="editForm.cate_type_id"
                                size="small" disabled
                                placeholder="商品类型"
                                @change="typeChange">
                                <el-option v-for="v in types" :label="v.label"
                                        :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="商品品类"  prop="cate_kind_id">
                            <el-select
                                v-model="editForm.cate_kind_id"
                                size="small" disabled
                                placeholder="商品品类">
                                <el-option v-for="v in cate_kinds" :label="v.label"
                                        :value="v.id" :key="v.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>
                <!-- <el-row>
                    <el-col :span="12">
                        <el-form-item label="商品剩余数量"  prop="rest_goods_number">
                            <el-input v-model="editForm.rest_goods_number"  auto-complete="off" placeholder="商品剩余数量"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="累记库存总量"  prop="total_goods_number">
                            <el-input v-model="editForm.total_goods_number"  auto-complete="off" placeholder="累记库存总量"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row> -->
                <!-- <el-row>
                    <el-col :span="12">
                        <el-form-item label="库存状态"  prop="warehouse_status">
                            <el-input v-model="editForm.warehouse_status"  auto-complete="off" placeholder="库存状态"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row> -->
                <el-row>
                    <el-col :span="12">
                       <el-form-item label="库存最大量"  prop="inventory_max">
                            <el-input-number v-model="editForm.inventory_max" :min="0">
                            </el-input-number>
                        </el-form-item> 
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="库存最小量"  prop="inventory_min">
                            <el-input-number v-model="editForm.inventory_min" :min="0">
                            </el-input-number>
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
export default {
    name: 'edit-dialog',
    mixins:[DialogForm],
    props:{
        distributors:{
            type:Array,
            default:[],
        },
        types:{
            type:Array,
            default:[],
        },
    },
    data(){
        let validateMax = (rule, value, callback)=>{
            if (value === '') {
                callback(new Error('请设置预警最大值'));
            } else if (value < this.editForm.inventory_min) {
                callback(new Error('最大值应大于最小值'));
            } else {
                callback();
            }
        };
        let validateMin = (rule, value, callback)=>{
            if (value === '') {
                callback(new Error('请设置预警最大值'));
            } else if (value > this.editForm.inventory_max) {
                callback(new Error('最小值小于最大值'));
            } else {
                callback();
            }
        };
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'110px',
            editForm:{
                entrepot_id:'',
                goods_name:'',
                cate_type_id:'',
                cate_kind_id:'',

                rest_goods_number:'',
                total_goods_number:'',
                warehouse_status:'',
                inventory_max:'',
                inventory_min:'',
                id:'',
            },
            model:null,
            cate_kinds:[],
            rules:{
                inventory_max:[
                    {required:true , validator:validateMax,trigger:'blur'},
                ],
                inventory_min:[
                    {required:true , validator:validateMin,trigger:'blur'},
                ],
            },
        }
    },
    methods:{
        onOpen(param){
            console.log(param);
            this.model = param.params.model;
            this.typeChange(this.model.cate_type_id);
        },
        getAjaxPromise(model){
            console.log(model);
            return this.ajaxProxy.update(model.id, model);
        },
        typeChange(v){
            this.cate_kinds = [];
            this.editForm.cate_kind_id = '';
            for (let index = 0; index < this.types.length; index++) {
                const element = this.types[index];
                if (element.id == v) {
                    this.cate_kinds = element.children;
                }
            }
        },
        setMaxChange(v){
            let max = v;
            let min = this.editForm.inventory_min;
            if(max < min){
                this.$message.error('错了哦，这是一条错误消息');
            }
        },
        setMinChange(v){

        },
    },
    created(){

    },
    watch:{
        model:function(val, oldVal){
            for (const key in this.editForm) {
                if (this.editForm.hasOwnProperty(key)) {
                    this.editForm[key] = val[key];
                }
            }
        }
    }
}
</script>

<style scoped>

</style>


