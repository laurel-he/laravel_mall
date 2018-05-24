import SelectProxy from './SelectProxy';

const OrderAddressProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.addressProxy = new SelectProxy("/order-address", callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

OrderAddressProxy.prototype.setParam = function (param) {
  this.addressProxy.setExtraParam(param);
  return this;
}

OrderAddressProxy.prototype.load = function () {
  return this.addressProxy.load();
}

export default OrderAddressProxy;