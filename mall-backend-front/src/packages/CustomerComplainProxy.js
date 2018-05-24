import SelectProxy from './SelectProxy';
import CustomerComplain from '../ajaxProxy/CustomerComplain';

const CustomerComplainProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.partProxy = new SelectProxy(CustomerComplain.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

CustomerComplainProxy.prototype.setParam = function (param) {
  this.partProxy.setExtraParam(param);
  return this;
}

CustomerComplainProxy.prototype.load = function () {
  this.partProxy.load();
}

export default CustomerComplainProxy;