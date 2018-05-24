<template>
    <span>
        <el-button v-if="!loading" @click="formSubmit" type="primary">
            <slot>
                确 定
            </slot>
        </el-button>
        <el-button v-else type="primary" :loading="true">提交中</el-button>
    </span>
</template>
  
<script>
    export default {
        name: 'SubmitButton',
        props:{
            observer:{
                required: true,
                type: Object
            }
        },
        data () {
            return {
                loading: false
            }
        },
        methods:{
            formSubmit(){
                // this.$emit('update:state', true);
                this.loading = true;
                this.$emit('click');
            },
            setSubmited(){
                this.loading = false;
            },
            setSubmiting(){
                this.loading = true;
            }
        },
        watch:{
            state:function(val, OldVal){
                this.loading = val;
            }
        },

        created(){
            this.observer.$on('valid-error', this.setSubmited);
            this.observer.$on('submit-final', this.setSubmited);
            this.$on('submit-ing', this.setSubmiting);
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
  