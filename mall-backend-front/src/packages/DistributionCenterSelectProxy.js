import SelectProxy from './SelectProxy';
import DistributionCenter from '../ajaxProxy/DistributionCenter';

const DistributionCenterSelectProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.DcProxy = new SelectProxy(DistributionCenter.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

DistributionCenterSelectProxy.prototype.setParam = function (param) {
  this.DcProxy.setExtraParam(param);
  return this;
}

DistributionCenterSelectProxy.prototype.load = function () {
  this.DcProxy.load();
}

export default DistributionCenterSelectProxy;