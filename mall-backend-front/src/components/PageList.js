import Navgation from './Navgation.vue';


const PageList = {
    'Navgation':Navgation,

    'GoodsDetails': (resolve) => { require(['./GoodsDetails/Index.vue'], resolve)},
    'GoodsSpecs': (resolve) => { require(['./GoodsSpecs/Index.vue'], resolve)},
    'GoodsType': (resolve) => { require(['./GoodsType/Index.vue'], resolve)},
    'Department':(resolve)=>{ require(['./Department/Index.vue'], resolve)},
    'Group':(resolve)=>{ require(['./Group/Index.vue'], resolve)},
    'Employee':(resolve)=>{ require(['./Employee/Index.vue'], resolve)},
    'Customer':(resolve)=>{ require(['./CustomerInformation/Index.vue'], resolve)},

    'BuyOrders': (resolve) => { require(['./BuyOrders/Index.vue'], resolve)},
    'OrderList':(resolve)=>{ require(['./OrderList/Index.vue'], resolve)},
    'Refund':(resolve)=>{ require(['./Refund/Index.vue'], resolve)},
    'InventoryList':(resolve)=>{ require(['./InventoryList/Index.vue'], resolve)},
    'GoodsInto':(resolve)=>{ require(['./GoodsInto/Index.vue'], resolve)},
    'GoodsOut':(resolve)=>{ require(['./GoodsOut/Index.vue'], resolve)},
    'ExpressInfo':(resolve)=>{ require(['./ExpressInfo/Index.vue'], resolve)},
    'Category':(resolve)=>{ require(['./Category/Index.vue'], resolve)},

    'Deposit':(resolve)=>{ require(['./Deposit/Index.vue'], resolve)},
    'Articles':(resolve)=>{ require(['./Article/Index.vue'], resolve)},
    'SkinCareInfo':(resolve)=>{ require(['./SkinCareInfo/Index.vue'], resolve)},
    'Connection': (resolve) => { require(['./Connection/Index.vue'], resolve)},
    'Workbench': (resolve) => { require(['./Workbench/Index.vue'], resolve)},
    'SysNotice': (resolve) => { require(['./SysNotice/Index.vue'], resolve)},
    'Website': (resolve) => { require(['./Website/Index.vue'], resolve)},
    'Contacts': (resolve) => { require(['./Contacts/Index.vue'], resolve)},
    
    'StockDetails': (resolve) => { require(['./StockDetails/Index.vue'], resolve)},
    'StockSum': (resolve) => { require(['./StockSum/Index.vue'], resolve)},
    'StockOutDetails': (resolve) => { require(['./StockOutDetails/Index.vue'], resolve)},
    'StockWarning': (resolve) => { require(['./StockWarning/Index.vue'], resolve)},
    'ShelvesPick': (resolve) => { require(['./ShelvesPick/Index.vue'], resolve)},

    'ExpressCompany': (resolve) => { require(['./ExpressCompany/Index.vue'], resolve)},
    'ExpressReceive': (resolve) => { require(['./ExpressReceive/Index.vue'], resolve)},
    'DistributionDelivery': (resolve) => { require(['./DistributionDelivery/Index.vue'], resolve)},
    'ShelvesManagement': (resolve) => { require(['./ShelvesManagement/Index.vue'], resolve)},
    'DistributionCenter': (resolve) => { require(['./DistributionCenter/Index.vue'], resolve)},


};

export default PageList;
