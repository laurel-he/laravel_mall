import SelectProxy from './SelectProxy';
import CustomerTrackLog from '../ajaxProxy/CustomerTrackLog';

const CustomerTrackLogProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.partProxy = new SelectProxy(CustomerTrackLog.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

CustomerTrackLogProxy.prototype.setParam = function (param) {
  this.partProxy.setExtraParam(param);
  return this;
}

CustomerTrackLogProxy.prototype.load = function () {
  this.partProxy.load();
}

export default CustomerTrackLogProxy;