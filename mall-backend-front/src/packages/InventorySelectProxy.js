import SelectProxy from './SelectProxy';
// let departProxy = new SelectProxy("/departments");

const inventorySelect = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy("/inventorylist", callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

inventorySelect.prototype.setParam = function(param){
    // this.extraParm = param;
    if (!param.fields) {
        param.fields = ['id','goods_name','goods_type', 'goods_version', 'goods_batch'];
    }
    if (!param.business) {
        param.business = 'select';
    }
    this.departProxy.setExtraParam(param);
    return this;
}

inventorySelect.prototype.load = function(){
    this.departProxy.load();
}

export default inventorySelect;