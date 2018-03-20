<template>
    <div >
        <MyDialog title="聊天记录" :name="name" :width="width" :height="height">
            <el-table
                    :data="talkRecords"
                    style="width: 100%">
                <el-table-column
                        prop="path"
                        label="路经">
                </el-table-column>
                <el-table-column
                        prop="created_at"
                        label="上传时间">
                </el-table-column>
                <el-table-column
                        label="操作"
                        width="180">
                    <template slot-scope="scope">
                        <el-button size="small" @click="deleteRecords(scope.row.id,scope.$index)"   type="danger">删除</el-button>
                        <a>下载</a>
                    </template>
                </el-table-column>
            </el-table>
    
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
export default {
    name: 'Chat',
    mixins:[DialogForm],
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            talkRecords:[
                {id:1,path:'www.test.com',created_at:'2017-12-19'},
                {id:2,path:'www.test.com',created_at:'2017-12-19'},
            ],


        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .name-input{
        max-width: 217px;
    }
</style>
      