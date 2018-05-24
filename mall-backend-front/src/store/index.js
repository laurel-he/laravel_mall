import Vue from 'vue';
import Vuex from 'vuex';

import app from './modules/app';
import user from './modules/user';
import strategy from './modules/strategy';
import role from './modules/role';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        //数据
    },
    mutations: {
        //方法 
    },
    actions: {
        //方法 异步
    }, 
    modules: {
        app,
        user,
        strategy,
        role
    },
    strict: process.env.NODE_ENV !== 'production'
});

export default store;