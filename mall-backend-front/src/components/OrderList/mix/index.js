import SearchTool from '../../../mix/SearchTool';
import DataTable from '../../../mix/DataTable';
import SubDetail from '../SubDetail';

import rowInfo from "../rowInfo";
import ReturnGoods from '../ReturnGoods';
import ExchangeGoods from '../ExchangeGoods';
import CheckOrder from '../checkOrder';
import RefundCheck from '../Rcheck';

const ORDER_ASSIGN = 3;

const mix = {
    mixins: [SearchTool,DataTable,],
    components: {
        SubDetail,
        rowInfo,
        ReturnGoods,
        ExchangeGoods,
        CheckOrder,
        RefundCheck
    },
    data(){
        return {
            pickerOptions2: {
                shortcuts: [{
                    text: '最近一周',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近三个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                        picker.$emit('pick', [start, end]);
                    }
                }],
                disabledDate(time) {
                    return time.getTime() > Date.now();//- 8.64e7
                }
            }
        }
    },
    methods:{
        openDialogCheck(){
            if (!this.hasCurrentRow()) {
                this.$alert('请选择一行', '警告', {
                    confirmButtonText: '确定',
                })
                return false;
            } else {
                return true;
            }
        },
        hasCurrentRow(){
            if (this.row_model) {
                return true;
            } else {
                return false;
            }
        },
        rowCellClick(row){
            this.row_model=row;
            if(!(this.row_model.after_sale_status == 10 || this.row_model.after_sale_status == 20)){
                this.reFundCheckShow = true;
            }else{
                this.reFundCheckShow = false;
            }
        },



        //发起换货弹窗
        showExchange(){
            if (this.openDialogCheck()) {
                this.$modal.show('exchangeGoods', this.row_model);
            }
        },
        /** 发起退款弹窗  */
        open2() {
            if (this.openDialogCheck()) {
                 this.$modal.show('returnGoods', this.row_model);
            }
        },
        
        // hyf 添加
        singlbutton(status, product_status, after_sale_status){
            this.searchForm.status = status,
            this.searchForm.product_status = product_status;
            this.searchForm.after_sale_status = after_sale_status;

            this.searchToolChange('searchForm');
        },
        //取消订单
        cancelOrder(){
            // console.log(row.status);

            if (this.openDialogCheck()){
                if (this.row_model.status >= ORDER_ASSIGN) {
                    this.$alert('不能取消', '警告', {
                        confirmButtonText: '关闭',
                    });
                } else {
                    this.$confirm('确定取消, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        this.getAjaxProxy().cancel(this.row_model.id).then(() => {
                            this.$message.info('取消成功');
                            this.handleReload();
                        })

                    });
                }
            }
        },
        //订单审核
        checkOrder(){
            if (this.openDialogCheck()) {
                this.$modal.show('checkOrder', {row: this.row_model});
            }
        },

        RefundCheck() {
            if (this.openDialogCheck()){
                this.$modal.show('refundcheck', {row: this.row_model});
            }
        },
        resetHiddenFields(){
            this.searchForm.status = '',
            this.searchForm.product_status = '';
            this.searchForm.after_sale_status = '';
            
        }
    },
    mounted(){
        this.$refs['searchForm'].$on('reset', this.resetHiddenFields);
    }
};

export default mix;