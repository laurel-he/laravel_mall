import SelectProxy from './SelectProxy';
// let departProxy = new SelectProxy("/departments");

const DepartSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy("/orderlist", callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

DepartSelectProxy.prototype.setParam = function(param){
    // this.extraParm = param;
    if (!param.fields) {
        param.fields = ['id','order_sn'];
    }
    if (!param.business) {
        param.business = 'select';
    }
    this.departProxy.setExtraParam(param);
    return this;
}

DepartSelectProxy.prototype.load = function(){
    return this.departProxy.load();
}

export default DepartSelectProxy;