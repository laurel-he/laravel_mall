/**
 * 仓库 商品 数量
 * 
 */

import RestfulProxy from './RestfulProxy';

const URL = '/entrepot-product';
const proxy = new RestfulProxy(URL);

/**
 * 指定员工关联仓库里的商品数量
 */
proxy.getEntrepotCount = function(sku_sn){
    return this.getAxios().get(this.url + "-count/" + sku_sn);
};


export default proxy;