<template>
    <div >
        <MyDialog title="客户预查" :name="name" :width="width" :height="height" >
            <el-row>
                <el-col :span="24">
                    <el-form :model="searchForm" class="search-bar" :inline="true" ref="searchForm"  >
                        <el-form-item prop="qq">
                            <el-input v-model="searchForm.qq" placeholder="QQ号" size="small"></el-input>
                        </el-form-item>
                        <el-form-item prop="phone">
                            <el-input v-model="searchForm.phone" placeholder="手机号" size="small"></el-input>
                        </el-form-item>
                        <el-form-item prop="weixin">
                            <el-input v-model="searchForm.weixin" placeholder="微信号" size="small"></el-input>
                        </el-form-item>

                        <el-form-item>
                            <el-button type="primary" size="small"  @click="searchChange()">查询</el-button>
                            <el-button type="primary" size="small"  @click="searchReset()">重置</el-button>
                        </el-form-item>
                    </el-form>

                </el-col>
            </el-row>
            <el-row>
                <el-col :span="24">
                    <el-table :data="datas" border v-loading="loading">
                        <el-table-column prop="name" label="客户姓名" align="center"></el-table-column>
                        <el-table-column prop="mid_relative.user_name" label="所属员工" align="center"></el-table-column>
                    </el-table>
                </el-col>
            </el-row>
        </MyDialog>
    </div>
</template>

<script>
import DialogForm from '../../mix/DialogForm';
import CustomerSelectProxy from '@/packages/CustomerSelectProxy';

export default {
    name: 'Edit',
    mixins:[DialogForm],
    data () {
        return {
            datas:[],
            searchForm:{
                qq:'',
                weixin:"",
                phone:'',
                with:['midRelative'],
                id:""
            },
            loading:false
        }
    },
    methods:{
        searchChange(){
            if (this.pro != JSON.stringify(this.searchForm)) {
                this.customProxy.setParam(this.searchForm).load();
                this.loading = true;
            }
            
        },
        searchReset(){
            this.$refs['searchForm'].resetFields();
            this.searchForm.id = 0;
            this.searchChange();
        },
        loadCustomer(data) {
            this.loading = false;
            this.datas = data.items;
        }
    },
    watch:{
        'searchForm.qq':function(val, oldVal){
            this.searchForm.id = "";
        },
        'searchForm.weixin':function(val, oldVal){
            this.searchForm.id = "";
        },
        'searchForm.phone':function(val, oldVal){
            this.searchForm.id = "";
        },
    },
    created(){
        this.customProxy = new CustomerSelectProxy(null, this.loadCustomer, this);
        this.pro = JSON.stringify(this.searchForm);
    }
    

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      