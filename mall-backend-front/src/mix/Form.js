// import SubmitButtonMix from './SubmitButton';
import SubmitButton from '../components/common/SubmitButton';

const config = {

    components:{
        SubmitButton
    },
    methods:{
        formSubmit(name){
            let model = this[name];
            if (this.$refs[name].rules) {
                this.$refs[name].validate((valid)=>{
                    if (valid) {
                        this.realSubmit(model, name);
                    } else {
                        console.log('error submit!!', name);
                        this.$emit('valid-error', name);
                        return false;
                    }
                })
            } else {
                this.realSubmit(model, name);
            }
        },
        //需要实现一个
        getAjaxPromise(model){
            // return this.ajaxProxy.create(model) 
            // return this.ajaxProxy.update(id,model) 
            // this.$message.error("你需要定义一个 getAjaxPromise 方法 ")
            this.$alert('你需要定义一个 getAjaxPromise 方法，详见mix/Form.js', '错误', {
                confirmButtonText: '确定',
            });
            return false;
        },
        realSubmit(model, name){
            let ajaxPromise =  this.getAjaxPromise(model);
            let vmthis = this;

            ajaxPromise.then(function(response){
                if (response.data.status==0) {
                    vmthis.$message.error(response.data.msg ? response.data.msg : "操作失败" );
                    vmthis.$emit('submit-error', name);
                    
                } else {
                    vmthis.$message.success('操作成功');
                    vmthis.$refs[name].resetFields();
                    vmthis.$emit('submit-success', name);
                }
                
            })
            .catch(function(error){
                if(error.response){
                    //存在请求，但是服务器的返回一个状态码
                    //他们都在2xx之外
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                }else{
                    //一些错误是在设置请求时触发的
                    console.log('Error',error.message);
                }
                console.log(error);
                vmthis.$message.error('出错了');
            })
            .then(function(){
                // vmthis.setSubmited(); // SubmitButtonMix
                vmthis.$emit('submit-final', name);
            });
        }
        
    },
    created(){
        // console.log( typeof this.visible );
        // if ( typeof this.dialogVisible != undefined ) {
        //     this.$on('submit-success', this.handleClose);
        // }
    }
};

export default config;