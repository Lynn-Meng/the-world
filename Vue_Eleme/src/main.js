import Vue from 'vue'
import router from './router';
import './config/rem';
import './scss/index.scss';
import store from './vuex';

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    store
});
