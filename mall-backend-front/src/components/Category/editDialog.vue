<template>
    <div >
        <MyDialog title="编辑" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="editForm"  ref="editForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="分类名称" prop="label">
                            <el-input class="name-input" v-model="editForm.label"  auto-complete="off" placeholder="请填写分类名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <!-- <el-col :span="12">
                        <el-form-item label="分类级别" prop="level">
                            <el-select @change="categoryChange"  v-model="editForm.level">
                                <el-option v-for="v in levels" :value="v.level" :label="v.label" :key="v.level"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col> -->
                </el-row>
                <el-row>
                    <!-- <el-col :span="12">
                        <el-form-item label="上级名称" prop="pid">
                            <el-select  v-model="editForm.pid" :disabled="showLevel">
                                <el-option
                                        v-for="item in Categorys"
                                        :key="item.id"
                                        :label="item.label"
                                        :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col> -->
                    <el-col :span="12">
                        <el-form-item label="商品类型" prop="type_id">
                            <el-select   v-model="editForm.type_id">
                                <el-option v-for="v in goodsTypeList" :value="v.id" :label="v.name" :key="v.id"></el-option>
                            </el-select>
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
    export default {
        mixins:[DialogForm],
        name: 'editDialog',
        data () {
            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                showLevel:false,
                showPid:false,
                url:'/categorys',
                Categorys:'',
                goodsTypeListUrl:'/goodstypelist',
                goodsTypeList:[],
                levels:[
                    {level:1,label:'顶级'},
                    {level:2,label:'二级'},
                    {level:3,label:'三级'},
                ],
                rules:{
                    label: [
                        { required: true, message: '请输入分类名称', trigger: 'blur' },
                    ],
                    level: [
                        { required: true, message: '请选择分类级别', trigger: 'blur',type: 'number', },
                    ],
                    pid: [
                        { required: true , message: '请选择上级名称',type: 'number', },
                    ],
                    type_id: [
                        { required: true , message: '请选择商品类型',type: 'number', },
                    ],
                },
                editForm:{
                    id:'',
                    label:"",
                    pid:'',
                    level:'',
                    type_id:''
                },
                model:''

            }
        },

        methods:{
            onOpen(param){
                this.model = param.params.model;
                this.categoryChange(this.model.level)
            },
            getGoodsTypeList:function(){
                let categoryProxy = new DataProxy(this.goodsTypeListUrl, this.pageSize, this.goodsTypeListDataLoaded, this,);
                categoryProxy.load();

            },
            goodsTypeListDataLoaded(data){
                this.goodsTypeList = data.items;
            },
            getData:function (lel) {
                let categoryProxy = new DataProxy(this.url+'/'+lel,this.pageSize,this.levelLoaded, this,);
                categoryProxy.load();
            },
            levelLoaded:function (res) {
                this.Categorys=res;
            },
            categoryChange:function (v) {
                if(v==1){
                    this.showLevel=true;
                    this.editForm.pid= 0;
                }
                if(v >= 2){
                    this.showLevel=false;
                    v = v-1;
                }
                this.getData(v)
            },
            getAjaxPromise(model){
                return this.ajaxProxy.update(model.id, model);
            },

        },
        watch:{
            model:function(val, oldVal){
                for (const key in this.editForm) {
                    if (this.editForm.hasOwnProperty(key)) {
                        this.editForm[key] = val[key]
                    }
                }
            }
        },
        created(){
            this.getGoodsTypeList();
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>

