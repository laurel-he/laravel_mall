<template>
  <div>
    <el-dialog title="高级查询" :visible.sync="status" @close="handleClose">
      <el-form ref="advancedQueryForm" :model="advancedQueryForm" size="small" label-width="140px">
        <el-row>
          <el-col :span="12">
            <el-form-item prop="name" label="客户姓名">
              <el-input v-model="advancedQueryForm.name" size="small" placeholder="客户姓名" style="max-width:170px;"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item prop="phone" label="手机号">
              <el-input v-model="advancedQueryForm.phone" size="small" placeholder="手机号" style="max-width:170px;"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row>
          <el-col :span="12">
            <el-form-item prop="start" label="锁定起始时间">
              <el-date-picker v-model="advancedQueryForm.start" size="small" :editable="false" placeholder="请选择起日期">
              </el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :span="12" >
            <el-form-item prop="end" label="锁定截止时间">
              <el-date-picker v-model="advancedQueryForm.end" size="small" :editable="false" placeholder="请选择止日期">
              </el-date-picker>
            </el-form-item>
          </el-col>
        </el-row>

        <el-row>
          <el-col :span="12">
            <el-form-item prop="track_start" label="最后跟踪起始时间">
              <el-date-picker v-model="advancedQueryForm.track_start" size="small" :editable="false" placeholder="请选择起日期" >
              </el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :span="12" >
            <el-form-item prop="track_end" label="最后跟踪截止时间">
              <el-date-picker v-model="advancedQueryForm.track_end" size="small" :editable="false" placeholder="请选择止日期" >
              </el-date-picker>
            </el-form-item>
          </el-col>
        </el-row>

        <el-row>
          <el-col :span="12">
            <el-form-item prop="type" label="客户类型">
              <el-select v-model="advancedQueryForm.type" size="small" placeholder="请选择客户类型" >
                <el-option v-for="(type, key) in customerType" :label="type" :value="key" :key="key"></el-option>
              </el-select>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="advancedQueryReset">重置</el-button>
        <el-button type="primary" @click="advanceSearch">查询</el-button>
        <el-button type="primary" @click="advanceSearch">查询中</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    name:'advancedQuery',
    props:{
      advanceQuery:{
        type:Boolean,
        default:false
      }
    },
    data(){
      return {
        status:this.advanceQuery,
        advancedQueryForm:{
          name:'',
          phone:'',
          start:'',
          end:'',
          track_start:'',
          track_end:'',
          type:'',
        },
        customerType:{
    	    "A":"A.准客户",
          "B":"B.意向客户",
          "C":"C.一般客户",
          "D":"D.未有意向客户",
          "E":"本地化客户",
          "F":"F.黑名单（同行）",
          "N":"N.无效客户",
          "V":"V.成交客户",
          "VX":"VX.审核未通过",
          "VT":"VT.有意见并投诉"
        }
      }
    },
    methods:{
      handleClose:function(){
        this.$emit('update:advance-query', false);
      },
      advanceSearch:function(){
        this.handleClose();
      },
      advancedQueryReset:function(){
        this.$refs.advancedQueryForm.resetFields();
      },
    },
    watch:{
      advanceQuery(val, oldVal){
        this.status = val;
      }
    }
  }
</script>
