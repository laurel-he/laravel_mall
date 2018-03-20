import SelectProxy from './SelectProxy';
import employee from '../ajaxProxy/Customer';
//从depart 复制过来的
const DepartSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy(employee.getUrl(), callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

DepartSelectProxy.prototype.setParam = function(param){
    // this.extraParm = param;
    if (!param.fields) {
        param.fields = ['id','name'];
    }

    // if (!param.business) {
    //     param.business = 'select';
    // }
    this.departProxy.setExtraParam(param);
    return this;
}

DepartSelectProxy.prototype.load = function(){
    this.departProxy.load();
}

export default DepartSelectProxy;