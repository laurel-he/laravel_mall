<template>
    <!-- 只有销售经理有权 处理这个页面 -->
    <MyDialog title="转让" :name="name" :width="width" :height="height" @before-open="onBeforeOpen">
        <el-form :model="transForm" ref="transForm" label-position="top" :rules="rules">
            <el-form-item label="来源－目标" prop="user_id">
                <el-cascader class="cas-width" size="small" :options="options" @change="sourceChange" v-model="source">
                </el-cascader><span class="text-align-center splite">-</span><el-cascader 
                class="cas-width" 
                size="small" 
                :options="options" 
                v-model="target"
                @change="targetChange">
                </el-cascader>
            </el-form-item>

            <el-form-item label="选择客户">
                
                <el-transfer
                    filterable
                    :filter-method="filterMethod"
                    :data="source_customer"
                    :titles="['来源', '要转让的']"
                    :props="{
                        key: 'id',
                        label: 'name'
                      }"
                    v-model="transForm.cus_ids"
                    filter-placeholder="请输入">
                </el-transfer>
                <span v-show="loadingCustomer"> 加载中 <i class="el-icon-loading"></i> </span>
            </el-form-item>
        </el-form>
        <div slot="dialog-foot" class="dialog-footer">
            <el-button @click="handleClose">取 消</el-button>
            <submit-button
                    @click="formSubmit('transForm')"
                    :observer="dialogThis">
                保 存
            </submit-button>
        </div>
    </MyDialog>
</template>
  
<script>
    import DialogForm from '../../mix/DialogForm';

    import CustomerTransferAjaxProxy from '../../ajaxProxy/CustomerTransfer';
    import GroupSelect from '../../packages/GroupSelectProxy';
    import CustomerSelect from '../../packages/CustomerSelectProxy';
    import LocalMix from './mix';

    import { mapGetters } from 'vuex';

    export default {
        name: 'Transfer',
        mixins:[DialogForm,LocalMix],
        data () {
            return {
                dialogThis:this,
                loadingCustomer:false,
                transForm:{
                    cus_ids:[],
                    user_id:"",
                    from_id:"",
                },
                options:[],
                source:[],
                target:[],
                source_customer:[],
                rules:{
                    user_id:[
                        {required:true, message:'必须选择要转让的目标员工'}
                    ]
                }
            }
        },
        computed:{
            ...mapGetters({
                'user_department_id' : 'department_id'
            }),
        },
        methods:{
            filterMethod(query, item){
                return item.name.indexOf(query) > -1;
            },
            
            loadDatas(data){
                // console.log(data);
                this.options = this.trasnGroupToOptions(data.items);
            },
            loadCustomers(data){
                this.loadingCustomer = false;
                this.source_customer = data.items;

            },
            onBeforeOpen(){
                // 如果有异就 去掉判断
               // if (this.options.length==0) {
                    this.groupSelect.load();
                //}
            },
            sourceChange(arr){ //[1,2];
                this.loadingCustomer = true;
                this.customerSelect.setParam( {user_id:arr[1],pageSize: 2000} ).load();
                this.transForm.from_id = arr[1];
                this.transForm.cus_ids = [];
            },
            targetChange(arr){
                if (arr[1] == this.source[1]) {
                    this.$message.error('不能把客户转给自己');
                    this.target = [];
                    return ;
                }
                this.transForm.user_id = arr[1];
            },
            getAjaxPromise(model){
                return CustomerTransferAjaxProxy.updates(model);
            },

            reset(){
                this.source = [];
                this.target = [];
                this.source_customer = [];
                this.transForm.cus_ids = [];
            }
        },
        created(){
            this.groupSelect = new GroupSelect(
                { department_id:this.user_department_id, with:['users']},
                // { department_id: 1, with:['users']},
                this.loadDatas,
                this );

            this.customerSelect =  new CustomerSelect(null, this.loadCustomers, this);

            this.$on('submit-success', this.reset);
            
        }
    }
</script>
<style scoped>
    .cas-width {
        width: 200px;
    }
    .splite{
        display: inline-block;
        width: 58px;
    }
    
</style>
  