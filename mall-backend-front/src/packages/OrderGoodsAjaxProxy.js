import SelectProxy from './SelectProxy';

const OrderGoodsProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.goodsProxy = new SelectProxy("/ordergoods", callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

OrderGoodsProxy.prototype.setParam = function (param) {
  this.goodsProxy.setExtraParam(param);
  return this;
}

OrderGoodsProxy.prototype.load = function () {
  return this.goodsProxy.load();
}

export default OrderGoodsProxy;