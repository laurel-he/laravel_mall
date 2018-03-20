// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import store from './store'

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'

import VModal from 'vue-js-modal'
import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
// import Mock from './mock/mock';

Vue.use(VModal);
// Vue.use($);
Vue.use(VueQuillEditor);
// console.log(store);
//console.log(VueQuillEditor);

import newDialog from './components/common/Dialog';
import InitObject from './mix/InitObjectFromObject';
import ShowDialog from './mix/ShowDialog';
import Delete from './mix/Delete';
// import VueAreaLinkage from 'vue-area-linkage';

// Vue.use(VueAreaLinkage);
Vue.component('MyDialog',newDialog);

Vue.mixin(InitObject);
Vue.mixin(ShowDialog);
Vue.mixin(Delete);

Vue.use(ElementUI);


// @todo 过滤器 单独写个文件
// Vue.filter('capitalize', function (value) {
//     if (!value) return ''
//     value = value.toString()
//     return value.charAt(0).toUpperCase() + value.slice(1)
// })

Vue.filter('stringSuffix', function(value, length){
    let len = length ? length : 20;
    return value.toString().substr(0, len)+"...";
})



Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
    el: '#app',
    store: store,
    template: '<App/>',
    components: { App }
})
