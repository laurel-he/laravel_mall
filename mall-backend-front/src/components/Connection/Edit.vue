<template>
        <div >
            <MyDialog title="查看" :name="name" :width="width" :height="height" @before-open="onOpen">
                <el-row>
                    <el-col :span="12">
                        姓名：{{editForm.name}}
                    </el-col>
                    <el-col :span="12">
                        电话：{{editForm.phone}}
                    </el-col>
                </el-row>
                <el-row style="word-wrap: break-word;">
                    <el-col :span="24">
                        内容：{{editForm.content}}
                    </el-col>
                </el-row>
                <div slot="dialog-foot" class="dialog-footer">
                    <el-button @click="handleClose">确 定</el-button>
                </div>
            </MyDialog>
        </div>
    </template>
    
    <script>
        import DialogForm from '../../mix/DialogForm';

        export default {
            name: 'edit-connection',
            mixins:[DialogForm],
            components:{

            },
            data () {
                return {
                    dialogThis:this,
                    labelPosition:"right",
                    labelWidth:'80px',
                    imageUrl:"",
                    editForm:{
                        name:'',
                        phone:'',
                        content:'',
                    },
                }
            },
    
            methods:{
                onOpen(param){
                    this.editForm = param.params.model;
                },
            },
            created(){

            }
            
        }
    </script>
    
    <!-- Add "scoped" attribute to limit CSS to this component only -->
    <style scoped>
        .name-input{
            max-width: 217px;
        }
    </style>
    
    