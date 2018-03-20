import SelectProxy from './SelectProxy';
import UsersStore from '../ajaxProxy/Users';
//employees的同名
const UsersSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.orderProxy = new SelectProxy(UsersStore.getUrl(), callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

UsersSelectProxy.prototype.setParam = function(param){
    // this.extraParm = param;
    if (!param.fields) {
        param.fields = ['id','realname'];
    }
    if (!param.business) {
        param.business = 'select';
    }
    this.orderProxy.setExtraParam(param);
    return this;
}

UsersSelectProxy.prototype.load = function(){
    this.orderProxy.load();
}

export default UsersSelectProxy;