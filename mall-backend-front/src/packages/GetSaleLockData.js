import SelectProxy from './SelectProxy';
import DistributionCenter from '../ajaxProxy/GetSaleLockData';

const GetSaleLockDataSelectProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.GetSaleLockData = new SelectProxy(DistributionCenter.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

GetSaleLockDataSelectProxy.prototype.setParam = function (param) {
  this.GetSaleLockData.setExtraParam(param);
  return this;
}

GetSaleLockDataSelectProxy.prototype.load = function () {
  this.GetSaleLockData.load();
}

export default GetSaleLockDataSelectProxy;