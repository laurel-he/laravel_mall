import RestfulProxy from './RestfulProxy';

const URL = '/roles';
const proxy = new RestfulProxy(URL);

proxy.getAssignRoles = function(param){
    return this.getAxios().get(this.url+"-assignable", {params:param})
}


export default proxy;