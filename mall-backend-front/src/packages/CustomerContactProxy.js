import SelectProxy from './SelectProxy';
import CustomerContact from '../ajaxProxy/CustomerContact';

const CustomerContactProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.partProxy = new SelectProxy(CustomerContact.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

CustomerContactProxy.prototype.setParam = function (param) {
  this.partProxy.setExtraParam(param);
  return this;
}

CustomerContactProxy.prototype.load = function () {
  this.partProxy.load();
}

export default CustomerContactProxy;