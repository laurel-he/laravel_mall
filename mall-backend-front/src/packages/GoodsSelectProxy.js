import SelectProxy from './SelectProxy';
import GoodsAjaxProxy from '../ajaxProxy/GoodsDetails';

const DepartSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy(GoodsAjaxProxy, callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

DepartSelectProxy.prototype.setParam = function(param){
    this.departProxy.setExtraParam(param);
    return this;
}

DepartSelectProxy.prototype.load = function(){
    this.departProxy.load();
}

DepartSelectProxy.prototype.find = function(){
    this.departProxy.find();
}

export default DepartSelectProxy;