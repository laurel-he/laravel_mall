import SelectProxy from './SelectProxy';
import VolumeRatio from '../ajaxProxy/VolumeRatio';

const VolumeRatioSelectProxy = function (param, callback, scope) {
    this.extraParm = param || null;
    this.VolumeRatioProxy = new SelectProxy(VolumeRatio.getUrl(), callback, scope);

    if (this.extraParm) {
      this.setParam(this.extraParm);
    }
}

VolumeRatioSelectProxy.prototype.setParam = function (param) {
    this.VolumeRatioProxy.setExtraParam(param);
    return this;
}

VolumeRatioSelectProxy.prototype.load = function () {
    this.VolumeRatioProxy.load();
}


export default VolumeRatioSelectProxy;