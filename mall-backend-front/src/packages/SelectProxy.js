// import Axios from 'axios';
// import Vue from 'vue'
//http://www.cnblogs.com/libin-1/p/6607945.html
//bas url  or proxy
// todo 错误提示


import AxiosInstance from './AxiosProxy';


const orderMap =  {
    'ascending':'asc',
    'descending':'desc'
};
const DataProxy = function( url,  callback ,scope ){
    this.url = url;
    this.pageSize = 1000;

    this.page = 1;
    this.extraParm = null;

    this._scope = scope;
    this._callback = callback;

}


DataProxy.prototype.setPageSize = function(pageSize){
    this.pageSize = pageSize;
    return this;
}

DataProxy.prototype.setExtraParam = function(param){
    for(var x in param){
        if (this[x]) {
            console.warn('extraParam 里的参数会覆盖 DataProxy里面的属性');
            // return false;
            continue;
        }
    }
    this.extraParm = param;
    return this;
}

DataProxy.prototype.reset = function(){

    this.page = 1;
    this.extraParm = null;
    return this;
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

    return o;
}




DataProxy.prototype.load = function(){
    let vmthis = this._scope;
    let sel = this;
    let proxy = this.url; 
    let promise = null;

    if (typeof(this.url) == 'string') {
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
    }).catch(function(response){
            // vmthis.$message.error('出错了');
            console.log(response);
        });
}

DataProxy.prototype.find = function(){
    let vmthis = this._scope;
    let sel = this;
    let proxy = this.url; 
    let promise = null;

    promise = proxy.find((this._getParam()).id);

    return promise.then(function(response){
        if(vmthis){
            sel._callback.apply(vmthis, [response.data]);
        } else {
            sel._callback(response.data);
        }
    }).catch(function(response){
            // vmthis.$message.error('出错了');
            console.log(response);
        });
}


export default DataProxy;