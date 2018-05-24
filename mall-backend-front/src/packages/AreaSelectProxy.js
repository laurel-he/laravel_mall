import SelectProxy from './SelectProxy';

const AreaSelectProxy = function (param, callback, scope) {
  this.extraParm = param || null;
  this.partProxy = new SelectProxy('/area', callback, scope);

  if (this.extraParm) {
    this.setParam(this.extraParm);
  }
}

AreaSelectProxy.prototype.setParam = function (param) {
  // this.extraParm = param;
  if (!param.fields) {
    param.fields = ['id', 'name'];
  }

  // if (!param.business) {
  //     param.business = 'select';
  // }
  this.partProxy.setExtraParam(param);
  return this;
}

AreaSelectProxy.prototype.load = function () {
  this.partProxy.load();
}

export default AreaSelectProxy;