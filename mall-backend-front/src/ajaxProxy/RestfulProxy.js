import AxiosInstance from '../packages/AxiosProxy';

/**
 *  axios#request(config)
    axios#get(url[,config])
    axios#delete(url[,config])
    axios#head(url[,config])
    axios#post(url[,data[,config]])
    axios#put(url[,data[,config]])
    axios#patch(url[,data[,config]])
 * 
 * 
 */


const RestfulProxy = function( url ){
    this.url = url
}

RestfulProxy.prototype.get = function(param){
    return AxiosInstance.get(this.url, {params:param})
};

RestfulProxy.prototype.delete = function(id){
    return AxiosInstance.delete(this.url + "/" + id);
};

RestfulProxy.prototype.create = function(param){
    return AxiosInstance.post(this.url, param);
};

RestfulProxy.prototype.update =function(id, model){
    return AxiosInstance.put(this.url + "/" + id, model);
};

RestfulProxy.prototype.find = function(id, param=null){
    if(param) {
        return AxiosInstance.get(this.url + "/" + id, {params:param});
    } else {
        return AxiosInstance.get(this.url + "/" + id);
    }
};

RestfulProxy.prototype.getAxios = function(){
    return AxiosInstance;
};

RestfulProxy.prototype.getUrl = function(){
    return this.url;
};


export default RestfulProxy;