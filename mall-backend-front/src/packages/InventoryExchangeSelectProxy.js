import SelectProxy from './SelectProxy';
import InventoryExchangeProxy from '@/ajaxProxy/InventoryExchange';

const InventoryExchangeSelectProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.InventoryExchange = new SelectProxy(InventoryExchangeProxy.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

InventoryExchangeSelectProxy.prototype.setParam = function (param) {

  this.InventoryExchange.setExtraParam(param);
  return this;
}

InventoryExchangeSelectProxy.prototype.load = function () {
  this.InventoryExchange.load();
}

export default InventoryExchangeSelectProxy;