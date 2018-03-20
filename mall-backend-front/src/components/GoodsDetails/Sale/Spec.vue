<template>
	<div>
		<MyDialog title="规格" :name="name" :width="width" :height="height" @before-open="onOpen" @before-close="onClose">			
				<el-table :data="skulist">
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
					<el-table-column prop="sku_sn" label="商品编号" width="120">
					</el-table-column>
					
				</el-table>
			<div slot="dialog-foot" class="dialog-footer">
                <el-button @click="handleClose">关 闭</el-button>
            </div>
		</MyDialog>
	</div>
</template>

<script>
	// todo 改造成 TableProxy
// import DialogForm from '../../mix/DialogForm';

import FormMix from '../../../mix/Form';
import Dialog from '../../../mix/Dialog';
import AttrItem from '../../common/AttrFormItem';
import localMix from '../mix';
import goodsSkuAjax from '../../../ajaxProxy/GoodsSku';
import GoodsTypeSelectProxy from '../../../packages/GoodsTypeSelectProxy';




export default {
    name: 'Spec',
    mixins:[FormMix,Dialog,localMix],
    components: {
		AttrItem,
    },
    props:{

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
				num:"",
				goods_id:""
			},
			
			
		}
    },
    methods:{
		onOpen(param){
			// model = param.params.model;
			this.goods_id = param.params.model.id;
			this.reloadData();

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
		
       
		onClose(){
			this.skulist = [];
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
			});
		},
		handleReload(){
			this.reloadData();
		},
	},
	created(){
		this.goodsTypeProxy  = new GoodsTypeSelectProxy({}, this.loadGoodsAttr, this);
	}
}
</script>
