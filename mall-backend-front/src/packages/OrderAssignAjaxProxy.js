import SelectProxy from './SelectProxy';

const OrderAssignProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.assignProxy = new SelectProxy("/order-assign", callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

OrderAssignProxy.prototype.setParam = function (param) {
  this.assignProxy.setExtraParam(param);
  return this;
}

OrderAssignProxy.prototype.load = function () {
  return this.assignProxy.load();
}

export default OrderAssignProxy;