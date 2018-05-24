<template>
    <MyDialog title="录入计划" :name="name" :width="width" :height="height" @before-open="onOpen">
        <el-form  ref="addPlanForm" :label-width="labelWidth"   :label-position="labelPosition"  :model="addPlanForm">
            <el-row>
                <el-col :span="12">
                    <el-form-item label="客户姓名"  prop="cus_name">
                        <el-input class="name-input" v-model="cus_name" :disabled="true"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="计划下次跟踪时间" prop="plan">
                        <el-date-picker
                                v-model="addPlanForm.plan"
                                type="datetime"
                                placeholder="选择日期时间"
                                :editable="false" :picker-options="setPicker" @change="timeChange">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>

        <div slot="dialog-foot" class="dialog-footer">
            <el-button @click="handleClose">取 消</el-button>
            <submit-button
                    @click="formSubmit('addPlanForm')"
                    :observer="dialogThis">
                保 存
            </submit-button>
        </div>

    </MyDialog>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    export default {
        name: 'Plan',
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
                setPicker:{
                    disabledDate:function(time) {
                        return time.getTime() < Date.now() - 8.64e7;
                    }
                },
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'125px',
                addPlanForm:{
                    id:'',
                    plan:''
                },
                cus_name:'',
                model:''
            }
        },
        methods:{
            onOpen(param){
                this.model = param.params.model;
                this.addPlanForm.id = this.model.id;
                this.cus_name = this.model.name;
            },
            timeChange(v){
               this.addPlanForm.plan = v;
            },

            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id, model);
            },

        },
        watch:{
            model:function(val, oldVal){
                for (const key in this.addPlanForm) {
                    if (this.addPlanForm.hasOwnProperty(key)) {
                        this.addPlanForm[key] = val[key]
                    }
                }
            }
        },
    }
</script>

<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>