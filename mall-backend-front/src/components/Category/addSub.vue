<template>
    <div >
        <MyDialog title="添加子类" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
            <el-form :model="addForm"  ref="addForm" :rules="rules" :label-width="labelWidth"   :label-position="labelPosition">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="分类名称" prop="label">
                            <el-input class="name-input" v-model="addForm.label"  auto-complete="off" placeholder="请填写分类名称"></el-input>
                        </el-form-item>
                    </el-col>
                    <!-- <el-col :span="12">
                        <el-form-item label="分类级别" prop="level">
                            <el-select @change="categoryChange"  v-model="addForm.level">
                                <el-option v-for="v in levels" :value="v.level" :label="v.label" :key="v.level"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col> -->
                    <el-col :span="12">
                        <el-form-item label="上级名称" >
                            {{ parentName }}
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    
                    <el-col :span="12">
                        <el-form-item label="商品类型" prop="type_id">
                            <el-select   v-model="addForm.type_id">
                                <el-option v-for="v in goodsTypeList" :value="v.id" :label="v.name" :key="v.id"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                </el-row>
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
    export default {
        mixins:[DialogForm],
        name: 'addDialog',
        data () {


            var changeLevel = (rule, value, callback) => {

                if (this.addForm.level == 3 ) {
                    value === '';
                    callback(new Error('请选择商品类型'));
                } else {
                    callback();
                }
            };


            return {
                dialogThis:this,
                labelPosition:"right",
                labelWidth:'80px',
                showLevel:false,
                showPid:false,
                url:'/categorys',
                goodsTypeListUrl:'/goodstypelist',
                Categorys:'',
                goodsTypeList:[],
                parentName:"",
                rules:{
                    label: [
                        { required: true, message: '请输入分类名称', trigger: 'blur' },
                    ],
                    
                    type_id: [
                        // { validator: changeLevel, message:'请选择商品类型', trigger:'blur'},
                        { required: true , message: '请选择商品类型',type: 'number', },
                    ],
                },
                addForm:{
                    label:"",
                    pid:'',
                    level:'',
                    type_id:''
                },


            }
        },

        methods:{
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
              this.addForm.pid= 0;
                }
                if(v >= 2){
                    this.showLevel=false;
                    v = v-1;
                }
                this.getData(v)
            }, 
            getAjaxPromise(model){
               return this.ajaxProxy.create(model);
            },
            onBeforeOpen(param){
                let parent = param.params.parent;
                this.parentName = parent.label;
                this.addForm.level = parent.level+1;
                this.addForm.pid = parent.id;
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

