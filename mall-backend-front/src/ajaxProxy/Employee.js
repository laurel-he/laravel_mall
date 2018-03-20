import RestfulProxy from './RestfulProxy';

const URL = '/employees';
const proxy = new RestfulProxy(URL);


proxy.updates =function(model){
    return this.getAxios().put("/employeesupdate", model);
};


export default proxy;