import RestfulProxy from './RestfulProxy';

const URL = '/customers';
const proxy = new RestfulProxy(URL);

proxy.quitTransfer = function(model){
    return this.getAxios().put(URL+"-quit-transfer", model);
};

export default proxy;