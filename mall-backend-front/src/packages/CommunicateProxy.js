import SelectProxy from './SelectProxy';
import DistributionDelivery from '../ajaxProxy/Communicate';

const DistributionDeliverySelectProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy(DistributionDelivery, callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}

DistributionDeliverySelectProxy.prototype.setParam = function(param){
    this.departProxy.setExtraParam(param);
    return this;
}

DistributionDeliverySelectProxy.prototype.load = function(){
    this.departProxy.load();
}

DistributionDeliverySelectProxy.prototype.find = function(){
    this.departProxy.find();
}

export default DistributionDeliverySelectProxy;