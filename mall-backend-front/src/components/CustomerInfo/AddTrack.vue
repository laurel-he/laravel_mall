<template>
	<div>
		<MyDialog title="添加跟踪记录" :name="name" :width="width" :height="height" @before-open="onOpen">
            <el-form :model="addForm" ref="addForm" :rules="rules" :label-width="labelWidth">
                <el-row>
                    <el-col :span="12">
                        <el-form-item label="客户姓名" prop="cus_name">
                            <el-input placeholder="客户姓名"
								v-model.number="addForm.cus_name" disabled>
							</el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col :span="20">
                        <el-form-item label="跟踪内容" prop="content" >
                            <el-input type="textarea" :autosize="{ minRows: 2, maxRows: 3}"
							 	size="small" placeholder="跟踪内容" v-model.number="addForm.content">
							</el-input>
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
import CustomerTrackLog from '../../ajaxProxy/CustomerTrackLog';
import { mapGetters } from "vuex";
export default {
    name: 'add-track',
    mixins:[DialogForm],
    props:{
        ajaxProxy:{
            type:Object,
        }
    },
    data () {
        return {
            dialogThis:this,
            labelPosition:"right",
            labelWidth:'80px',
            addForm:{
                cus_name:'',
                user_name:'',
				content:'',
				cus_id:'',
				user_id:'',
			},
			cus_id:null,
			rules:{},

        }
	},
	computed:{
		...mapGetters([
            'user_id',
            'realname'
		]),
	},
	methods:{
		getAjaxPromise(model){
            return CustomerTrackLog.create(model);
        },
        onOpen(param){
			this.cus_id = param.params.model.id;
			this.addForm.cus_id = this.cus_id;
			this.addForm.user_id = this.user_id;
			this.addForm.cus_name = param.params.model.name;
			this.addForm.user_name = this.realname;
        },
	},
}
</script>
