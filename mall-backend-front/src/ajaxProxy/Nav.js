import RestfulProxy from './RestfulProxy';

const URL = '/menus';
const proxy = new RestfulProxy(URL);

proxy.getNav = function(){
    return this.getAxios().get(URL);
};
export default proxy;