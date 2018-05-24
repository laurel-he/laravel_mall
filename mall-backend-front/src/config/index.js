import editor_config from './editor';
import attr_config from './Attr'; 

/**
 * 取错名字 这里是常量 不是 配置
 */

let domain;
if (process.env.NODE_ENV == 'production') {
    domain = "/admin";
} else {
    domain = "/admin"
}

let upload_url = domain + "/upload";



const APP_CONST = {};

Object.defineProperty(APP_CONST, "DOMAIN", {
    value: domain,
    writable: false, //设置属性只读
    configurable: true,
    enumerable: true
});

Object.defineProperty(APP_CONST, "UPLOAD_URL", {
    value: upload_url,
    writable: false, //设置属性只读
    configurable: true,
    enumerable: true
});

editor_config.uploadConfig.action = upload_url;
Object.defineProperty(APP_CONST, 'editor_option',{
    value: editor_config,
    writable: false, //设置属性只读
    configurable: true,
    enumerable: true
});

Object.defineProperty(APP_CONST, 'ATTR',{
    value: attr_config,
    writable: false, //设置属性只读
    configurable: true,
    enumerable: true
});


export const PHONE_REG = /^[0-9]+$/;
export const QQ_REG = /^[0-9]+$/;
export const PRICE_REG = /^(([1-9]\d{0,9})|0)(\.\d{1,2})?$/;

export default APP_CONST;