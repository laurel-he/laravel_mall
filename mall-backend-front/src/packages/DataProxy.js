// import Axios from 'axios';
// // import Vue from 'vue'
// //http://www.cnblogs.com/libin-1/p/6607945.html
// //bas url  or proxy
// // todo 错误提示
//
// Axios.defaults.timeout = 3000;

import AxiosInstance from './AxiosProxy';



const orderMap =  {
    'ascending':'asc',
    'descending':'desc'
};
const DataProxy = function( url, pageSize, callback, scope ){
    this.url = url;
    this.pageSize = pageSize || 30;
    this.orderField = "";
    this.orderWay = 'desc';
    this.page = 1;
    this.extraParm = null;
    
    this._scope = scope || null;
    this._callback = callback;

    if (arguments[4]) {
        this._errorCallback = arguments[4];
    }
    
}
DataProxy.prototype.setOrderField = function(name){
    this.orderField = name;
    return this;
}
DataProxy.prototype.setOrderWay = function(name){
    this.orderWay = orderMap[name];
    return this;
}
DataProxy.prototype.setOrder = function(field, way){
    this.orderField = field;
    this.orderWay = orderMap[way];
    // this.page = 1;
    this._resetPage();
    return this;
}
DataProxy.prototype.setPage = function(page){
    this.page = page;
    return this;
}
DataProxy.prototype.setPageSize = function(pageSize){
    this.pageSize = pageSize;
    return this;
}
DataProxy.prototype.setExtraParam = function(param){
    if(param){
        for(var x in param){
            if (this[x]) {
                console.warn('extraParam 里的参数会覆盖 DataProxy里面的属性');
                // return false;
            }
        }
        this.extraParm = param;
    } else {
        this.extraParm = null;
    }
    
    // this.page = 1;
    this._resetPage();
    return this;
}
DataProxy.prototype.reset = function(){
    this.orderField = "";
    this.orderWay = 'desc';
    // this.page = 1;
    this._resetPage();
    this.extraParm = null;
    return this;
}

DataProxy.prototype.loadPage = function(page){
    this.setPage(page).load();
}

DataProxy.prototype._resetPage = function(){
    this.setPage(1);
}

DataProxy.prototype._getParam = function(){
    let o = {};
    if (this.extraParm) {
        for(let x in this.extraParm){
            o[x] = this.extraParm[x];
        }
    }
    o["pageSize"] = this.pageSize;
    o["page"] = this.page;
    if (this.orderField && this.orderField.length>0) {
        o["orderField"] = this.orderField;
        o['orderWay']   = this.orderWay;
    }
    return o;  
}




DataProxy.prototype.load = function(){
    let vmthis = this._scope;
    let sel = this;
    let proxy = this.url; 
    let promise = null;
    if (typeof this.url == 'string') {
        promise = AxiosInstance.get(this.url, {params:this._getParam()});
    } else {
        promise = proxy.get(this._getParam());
    }
    return promise.then(function(response){
        if(vmthis){
            sel._callback.apply(vmthis, [response.data]);
        } else {
            sel._callback(response.data);
        }

    })
    .catch(function(response){
        vmthis.$message.error('出错了');
        if (sel._errorCallback) {
            sel._callback.apply(vmthis);
        }
        console.log(response);
    });
}
export default DataProxy;
