import SelectProxy from './SelectProxy';
import Category from '../ajaxProxy/Assign';

const CategorySelectProxy = function (param, callback, scope) {
    this.extraParm = param || null;
    this.CategoryProxy = new SelectProxy(Category.getUrl(), callback, scope);

    if (this.extraParm) {
      this.setParam(this.extraParm);
    }
}

CategorySelectProxy.prototype.setParam = function (param) {
    this.CategoryProxy.setExtraParam(param);
    return this;
}

CategorySelectProxy.prototype.load = function () {
    this.CategoryProxy.load();
}

CategorySelectProxy.prototype.getTheChildren = function (pid) {
    let getTheChildrenProxy = new SelectProxy("/getCategorys/" + pid, callback, scope);
    getTheChildrenProxy.load();
}

export default CategorySelectProxy;