import SelectProxy from './SelectProxy';
import ShelvesPick from '../ajaxProxy/ShelvesPick';

const ShelvesPickProxy = function(param, callback, scope){
    this.extraParm = param || null;
    this.departProxy = new SelectProxy(ShelvesPick.getUrl(), callback, scope);

    if (this.extraParm){
        this.setParam(this.extraParm);
    }
}
ShelvesPickProxy.prototype.setParam = function (param) {
    this.departProxy.setExtraParam(param);
    return this;
}


ShelvesPickProxy.prototype.load = function(){
    this.departProxy.load();
}

export default ShelvesPickProxy;