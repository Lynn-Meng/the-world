/**
 * Created by if-information on 2017/9/22.
 */
import Vue from 'vue';
import Vuex from 'vuex';
import mutations from './mutations';
Vue.use(Vuex);

const state = {
    positions:null,
};

//本页面将状态和突变结合

export default new Vuex.Store({

    state,
    mutations

});
