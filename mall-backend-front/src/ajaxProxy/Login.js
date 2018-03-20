import AxiosInstance from '../packages/AxiosProxy';

const URL_IN = '/login';
const URL_OUT = '/logout';

const proxy = {};


Object.defineProperty(proxy, "login", {
    value: function(param){
        return AxiosInstance.post(URL_IN, param);
    },
    writable: false, //设置属性只读
    configurable: false,
    enumerable: false
});

Object.defineProperty(proxy, "out", {
    value: function(){
        return AxiosInstance.post(URL_OUT);
    },
    writable: false, //设置属性只读
    configurable: false,
    enumerable: false
});


export default proxy;