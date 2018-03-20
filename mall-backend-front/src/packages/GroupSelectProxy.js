import SelectProxy from './SelectProxy';
// let departProxy = new SelectProxy("/departments");

const DepartSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy("/groups", callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

DepartSelectProxy.prototype.setParam = function(param){
    // this.extraParm = param;
    this.departProxy.setExtraParam(param);
    return this;
}

DepartSelectProxy.prototype.load = function(){
    this.departProxy.load();
}

export default DepartSelectProxy;