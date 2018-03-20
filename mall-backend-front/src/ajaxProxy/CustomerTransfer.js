import RestfulProxy from './RestfulProxy';

const URL = '/customers-transfer';
const proxy = new RestfulProxy(URL);

proxy.updates = function(model){
    return this.getAxios().put(URL, model);
};

export default proxy;