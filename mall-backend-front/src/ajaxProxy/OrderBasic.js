import RestfulProxy from './RestfulProxy';

const URL = '/orderbasic';
const proxy = new RestfulProxy(URL);
proxy.updateCheckStatus = function(id, model){
    return this.getAxios().put("/updateCheckStatus/" + id, model);
}

proxy.cancel = function(id){
    return this.getAxios().put("/order-cancel/" + id);
}

export default proxy;