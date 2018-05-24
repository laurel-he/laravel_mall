import SelectProxy from './SelectProxy';
import OrderlistStore from '../ajaxProxy/ReturnRecord';

const OrderlistSelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.orderProxy = new SelectProxy(OrderlistStore.getUrl(), callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

OrderlistSelectProxy.prototype.setParam = function(param){
    
    this.orderProxy.setExtraParam(param);
    return this;
}

OrderlistSelectProxy.prototype.load = function(){
    this.orderProxy.load();
}

export default OrderlistSelectProxy;