<template>

    <div>

        <!-- 下面这些事件怎么写一个通用的？ -->
            <!-- @select="selectChange" 
            select 当用户手动勾选数据行的 Checkbox 时触发的事件	selection, row
            @selection-change="selectionChange" 	
            select-all	当用户手动勾选全选 Checkbox 时触发的事件	selection
            selection-change	当选择项发生变化时会触发该事件	selection
            cell-mouse-enter	当单元格 hover 进入时会触发该事件	row, column, cell, event
            cell-mouse-leave	当单元格 hover 退出时会触发该事件	row, column, cell, event
            cell-click	当某个单元格被点击时会触发该事件	row, column, cell, event
            cell-dblclick	当某个单元格被双击击时会触发该事件	row, column, cell, event
            row-click	当某一行被点击时会触发该事件	row, event, column
            row-contextmenu	当某一行被鼠标右键点击时会触发该事件	row, event
            row-dblclick	当某一行被双击时会触发该事件	row, event
            header-click	当某一列的表头被点击时会触发该事件	column, event
            sort-change	当表格的排序条件发生变化的时候会触发该事件	{ column, prop, order }
            filter-change	当表格的筛选条件发生变化的时候会触发该事件，参数的值是一个对象，对象的 key 是 column 的 columnKey，对应的 value 为用户选择的筛选条件的数组。	filters
            current-change	当表格的当前行发生变化的时候会触发该事件，如果要高亮当前行，请打开表格的 highlight-current-row 属性	currentRow, oldCurrentRow
            header-dragend	当拖动表头改变了列的宽度的时候会触发该事件	newWidth, oldWidth, column, event
            expand -->
        <el-table
            ref="proxyTable"
            :data="mainData"
            v-loading="dataLoad"
            border
            highlight-current-row
            style="width: 100%"
            @sort-change="sortChange"
            @cell-dblclick="dbclick"
            @cell-click="cellclick"
	    element-loading-text="拼命加载中"
            >
            <slot></slot>
        </el-table>
        <br>
        <el-row >
            <el-col :span="12">
                <slot name="buttonbar"></slot>            
            </el-col>
            <el-col :span="12">
                <div class="pull-right">
                    <el-pagination
                        :current-page="currentPage"
                        :page-size="pageSize"
                        layout="total, prev, pager, next, jumper"
                        :total="total"
                        @current-change="currentChange">
                    </el-pagination>   
                </div>
            </el-col>
        </el-row>
    </div>
  </template>
  
  <script>
  import DataProxy from '../../packages/DataProxy';

  export default {
      name: 'TableProxy',
      props:{

            param:{
                type: String,
                default: ''
            },
            url:{
                type: [String, Object],
                default:''
            },
            pageSize:{
                type:Number,
                default: 100
            },
            bubble:{
                type: Object,
                default:function(){
                    return null
                }
            },
            reload:{
                type:Number,
                default:0
            }
      },
      data () {
          return {
              currentPage:1,
              msg:'asdf',
              mainData:[],
              dataLoad:false,
              realParam:null,
              total:0,

              multipleSelection: []
          }
      },
      methods:{
          dataLoaded(data){
              this.dataLoad = false;
              this.mainData = data.items;
              this.total = data.total
          },
          toggleTableLoad(){
              this.dataLoad = !this.dataLoad;
          },
          currentChange(v){
              this.dataLoad = true;
              this.mainProxy.setPage(v).load();
          },

          sortChange(prop){
              this.mainProxy.setOrder(prop.prop, prop.order).load();
          },

          handleSelectionChange(val) {

              this.multipleSelection = val;
              this.$emit('selection-change', this.multipleSelection);
          },

          dbclick(row){
              this.$emit('dbclick',row);
          },
          cellclick(row){
              this.$emit('cellclick',row);
          },
          bubleEvents(){
              console.log(arguments);

          },
          onError(){
              this.dataLoad = true;
          },
          setParamAndLoad(){
              if (this.realParam) {
                  this.mainProxy.setExtraParam(this.realParam);
              }
              this.toggleTableLoad();
              this.mainProxy.load();
          }
      },
      watch:{
          param:function(val, oldVal){
              this.realParam = JSON.parse(val);

              if (this.realParam) {
                  this.mainProxy.setExtraParam(this.realParam);
              }
              this.toggleTableLoad();
              this.mainProxy.load();

          },
          reload:function(val, oldVal){
              this.dataLoad = true;
              this.mainProxy.load();
          }
      },
      created(){
          if (this.param) {
              this.realParam = JSON.parse(this.param);
          }

          let mainProxy = new DataProxy(this.url, this.pageSize, this.dataLoaded, this, this.onError);
          this.mainProxy = mainProxy;
          this.setParamAndLoad();

          // 这么写不行 如果有多个表 这么写 一次 就触发多次事件处理
          // this.$parent.$on('dataReload', 'xx')
          //



      },

      mounted(){
          // refs 在 created里还没有
          // 查看这的 答案 https://segmentfault.com/q/1010000010145270 在mounted之后才有对象
          if(this.bubble){
              for (const key in this.bubble) {
                  if (this.bubble.hasOwnProperty(key)) {
                      this.$refs.proxyTable.$on(key, this.bubble[key]);
                  }
              }
              // for (let index = 0; index < this.bubble.length; index++) {
              //     console.log(this.bubble[index]);
              //     // const element = array[index];
              //     console.log(this.$refs);
              //     this.$refs.proxyTable.$on(this.bubble[index], this.bubleEvents, this.bubble[index]);
              // }

          }
      }
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
    .pull-right {
        float: right;
    }
  </style>
  
