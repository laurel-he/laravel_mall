import SelectProxy from './SelectProxy';
// let departProxy = new SelectProxy("/departments");

const DepartSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy("/employees", callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

DepartSelectProxy.prototype.setParam = function(param){
    // this.extraParm = param;
    if (!param.fields) {
        param.fields = ['id','realname']; // 'department_id'
    }
    if (!param.business) {
        param.business = 'depart-candidate';
        // param.logic = 'depart-candidate';
    }
    // if (!param.with) {
    //     param.with = ['department'];
    // }
    this.departProxy.setExtraParam(param);
    return this;
}

DepartSelectProxy.prototype.load = function(){
    this.departProxy.load();
}

export default DepartSelectProxy;