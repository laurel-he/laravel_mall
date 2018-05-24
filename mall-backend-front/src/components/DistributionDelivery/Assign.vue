<template>
        <div>
            <MyDialog title="发货单" :name="name" :width="width" :height="height" @before-open="onBeforeOpen" @before-close="onBeforeClose">
            <h1 class="text-center">发货单据</h1>
            <div></div>
            <table border="1" cellspacing="0"  >
                <caption class="text-right">编号:{{ row.sn }}</caption>
                    <tr>
                        <th>发货单位</th>
                        <td>{{ row.entrepot_name }}</td>
                        <th>
                            发货人
                        </th>
                        <td>
                            {{ row.user_name }}
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <th>发货单号</th>
                        <td>{{ row.assign_sn }}</td>
                        <th>
                                发货时间
                        </th>
                        <td>
                            {{ row.assign_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>收货人姓名</th>
                        <td>{{ row.deliver_name }}</td>
                        <th>
                            联系方式
                        </th>
                        <td>
                            {{ row.deliver_phone }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            收货地址
                        </th>
                        <td colspan="3">
                            {{ row.deliver_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            发货清单
                        </th>
                        <td colspan="3">
                            {{ row.goods }}
                        </td>
                    </tr>
                </table>
                <!-- <el-row type="flex" justify="space-between">
                    <el-col>打印操作员:李四</el-col>
                    <el-col class="text-right">打印时间:2018-02-02 12:12:12</el-col>
                </el-row> -->
                <br>
                <el-row type="flex" justify="space-around">
                    <el-col :span="6" class="text-center">
                        <el-button @click="print" type="info">打印</el-button>
                    </el-col>
                </el-row>
            </MyDialog>
        </div>
</template>

<script>
    import DialogForm from '../../mix/DialogForm';
    import ExpressInvoices from "@/ajaxProxy/AssignInvoices";
    export default {
        name: 'Express',
        mixins:[DialogForm],
        data () {
            return {
                row:{}
            }
        },
        methods:{
            print(){
                window.open("/admin/assign-invoices/1?id="+this.row.id, "","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=400, height=400")
            },
            onBeforeOpen(param){
                let vmthis = this;
                ExpressInvoices.get({assign_sn: param.params.assign_sn}).then((response)=>{
                    // console.log(response);
                    if (response.data.items.length == 0) {
                        ExpressInvoices.create(param.params).then(response2=>{
                            // console.log(response2);
                            vmthis.row = response2.data;
                        })
                    } else {
                        vmthis.row = response.data.items[0];
                    }
                })
            },
            onBeforeClose(){
                this.row = {};
            }
        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    .text-center {
        text-align: center;
    }
    .text-right {
        text-align: right;
    }
    table {
        width: 100%;
    }
    th {
        width: 100px;
    }
    th,td{
        text-indent: 5px;
    }
</style>
      