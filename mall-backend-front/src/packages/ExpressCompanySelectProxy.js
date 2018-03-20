import SelectProxy from './SelectProxy';
import ExpressCompany from '../ajaxProxy/ExpressCompany';

const ExpressCompanySelectProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.DcProxy = new SelectProxy(ExpressCompany.getUrl(), callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

ExpressCompanySelectProxy.prototype.setParam = function (param) {
  this.DcProxy.setExtraParam(param);
  return this;
}

ExpressCompanySelectProxy.prototype.load = function () {
  this.DcProxy.load();
}

export default ExpressCompanySelectProxy;