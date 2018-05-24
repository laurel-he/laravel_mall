import SelectProxy from './SelectProxy';
import ShelvesManagement from '../ajaxProxy/ShelvesManagement';

const ShelvesManagementSelectProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.DcProxy = new SelectProxy(ShelvesManagement.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

ShelvesManagementSelectProxy.prototype.setParam = function (param) {
  this.DcProxy.setExtraParam(param);
  return this;
}

ShelvesManagementSelectProxy.prototype.load = function () {
  this.DcProxy.load();
}

export default ShelvesManagementSelectProxy;