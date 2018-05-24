<template>
	<div>
		<MyDialog title="编辑规格" :name="name" :width="width" :height="height" @before-open="onOpen" @before-close="onClose">
			<el-form :model="skuForm" :rules="skuFormRules" ref="skuForm" :label-width="labelWidth"  :label-position="labelPosition">
				<el-table :data="skulist" @row-click="handRowClick">
					<el-table-column type="index" label="序号" width="80">
					</el-table-column>
					<el-table-column prop="name" label="名称" width="80">
					</el-table-column>
					<el-table-column  label="规格小项" >
						<template slot-scope="scope">
							{{ displayAttr(scope.row.attr)|stringSuffix(10) }}
						</template>
					</el-table-column>
					<el-table-column type="expand">
						<template slot-scope="scope">
							<el-form label-position="left" inline class="table-expand " >
								<el-form-item v-for="item in scope.row.attr" :key="item.value" :label="item.name + '：'">
									<span>{{ item.value }}</span>
									<img v-if="item.addon_value && item.addon_value.length > 1" :src="item.addon_value" width="50" height="50" class="vertical-middle" >
								</el-form-item>
							</el-form>
						</template>
					</el-table-column>
					<el-table-column prop="price" label="价格" width="80">
					</el-table-column>
					<el-table-column prop="sku_sn" label="商品编号" width="80">
					</el-table-column>
					<el-table-column label="操作">
						<template slot-scope="scope">
							<!-- <el-button size="small" type="danger" @click="deleteAttrItem(scope.$index)">删除</el-button> -->
							<el-button type="danger" size="small" @click="handleDelete(scope.row.id)">删除</el-button>
						</template>
					</el-table-column>
				</el-table>
				<br>
				<el-button @click="resetSkuForm">添加</el-button>
				<AttrItem :form-object="attrForm"></AttrItem>
			
				<el-form-item label="名称"  prop="name">
					<el-col :span="10">
						<el-input v-model="skuForm.name" placeholder="请输入内容"></el-input>
					</el-col>
				</el-form-item>

				<el-form-item label="商品编号"  prop="sku_sn">
					<el-col :span="10">
						<el-input v-model="skuForm.sku_sn" placeholder="请输入商品编号"></el-input>
					</el-col>
				</el-form-item>
			
				<el-form-item label="价格"  prop="price">
					<el-col :span="10">
						<el-input v-model="skuForm.price" placeholder="0.00"></el-input>
					</el-col>
				</el-form-item>
			
				<!-- <el-form-item label="数量"  prop="num">
					<el-col :span="10">
						<el-input  v-model="skuForm.num" placeholder="请输入内容"></el-input>
					</el-col>
				</el-form-item> -->
			
				<el-form-item>
					<el-button @click="addSku">{{ button_label }}</el-button>
				</el-form-item>
			</el-form>

			<div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">关 闭</el-button>
            </div>
		</MyDialog>
	</div>
</template>

<script>
	// todo 改造成 TableProxy
// import DialogForm from '../../mix/DialogForm';

import FormMix from '@/mix/Form';
import Dialog from '@/mix/Dialog';
import AttrItem from '../../common/AttrFormItem';
import localMix from '../mix';
import goodsSkuAjax from '@/ajaxProxy/GoodsSku';
import GoodsTypeSelectProxy from '@/packages/GoodsTypeSelectProxy';


const SET_BUTTON_LABLE_ADD  = '添加SKU';
const SET_BUTTON_LABLE_EDIT = '编辑SKU';


export default {
    name: 'Spec',
    mixins:[FormMix,Dialog,localMix],
    components: {
		AttrItem,
    },
    props:{
		cateMap:{
            type: Object,
            default: {}
        }
    },
    data(){
		return{
            dialogThis:this,
            labelPosition:"right",
			labelWidth:'80px',
			skulist:[],
			// specForm:{
			// 	name:"",
            //     price:"",
            //     num:""
			// },
			attrForm:[],
			skuForm:{
                name:"",
                price:"",
				num:0,
				goods_id:"",
				sku_sn:"",
			},
			
			button_label:SET_BUTTON_LABLE_ADD,
			skuFormRules:{
                price:[
                    {required: true,pattern:/^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/,  message: '价格格式为88:88', trigger:'blur'}
                ],
                // num:[
                //     {required: true,pattern:/^([0-9]\d{0,9})$/,  message: '数量必须为数字', trigger:'blur'}
				// ],
				sku_sn:[
                    {required: true, message: '请填写商品编号', trigger:'blur'}
                ],
            },
		}
    },
    methods:{
		onOpen(param){
			
			let category = param.params.model.category;
			this.goods_id = param.params.model.id;

			this.reloadData();

			let re = null;
            if (category instanceof Array) {
                re = category[category.length-1].id;
            } else { 
                re = 0;
            }
            
            if (this.cateMap[re]) {
                this.goodsTypeProxy.setParam({id:this.cateMap[re]}).find();
            } 

		},
		getAjaxPromise(model){
			//console.log(model);
			//return this.ajaxProxy.update(model.id, model);
			if(model.id){
                return goodsSkuAjax.update(model.id, model);
            }else  {
                return goodsSkuAjax.create(model);
            }
		},
		getAjaxProxy(){
			return goodsSkuAjax;
		},
		addSku(){
            // console.log(this.attrForm);
            // this.skuForm.attr  = this.attrForm.concat(); //concat 一个空的数组 返回一个新数组;
            this.skuForm.attr = [];
			this.copy(this.attrForm, this.skuForm.attr);
			
			this.skuForm.goods_id = this.goods_id;
			this.formSubmit('skuForm');
		},
        deleteAttrItem(index){
            this.addForm.skus.splice(index,1);
		},
		onClose(){
			this.skulist = [];
		},
		resetSkuForm(){
			this.attrForm = [];
            this.copy(this._attrForm, this.attrForm);
            this.skuForm.name = "";
            this.skuForm.price = "";
			this.skuForm.num = 0;
			delete this.skuForm.id;

			this.button_label = SET_BUTTON_LABLE_ADD;
		},
		reloadData(){
			goodsSkuAjax.get({goods_id:this.goods_id}).then((data)=>{
				this.skulist = data.data.items;

				for (let index = 0; index < this.skulist.length; index++) {
                    const element = this.skulist[index];
                    // console.log(element);
                    element.attr.forEach(item => {
                        item.value = item.pivot.value;
                        item.addon_value = item.pivot.addon_value;
                    });
                    
				}
				// console.log(this.skulist);

			});
		},
		handleReload(){
			this.reloadData();
		},
		handRowClick(row, event, column){
			this.button_label = SET_BUTTON_LABLE_EDIT;

			// console.log(row);

			this.skuForm.name  = row.name;
            this.skuForm.price = row.price;
			this.skuForm.num   = row.num;
			this.skuForm.id    = row.id;

			this.attrForm = [];

			row.attr.forEach(item => {
				item.value = item.pivot.value;
				if (item.pivot.addon_value) {
					item.addon_value = item.pivot.addon_value;
					item.fullurl = item.pivot.addon_value;
				}
			});
			this.attrForm = row.attr;    
		}
	},
	created(){
		
		this.goodsTypeProxy  = new GoodsTypeSelectProxy({}, this.loadGoodsAttr, this);

		this.$on('submit-success', this.resetSkuForm);
		this.$on('submit-success', this.reloadData);
	}
}
</script>
