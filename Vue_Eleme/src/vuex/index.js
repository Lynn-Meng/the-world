/**
 * Created by if-information on 2017/9/22.
 */
import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({


    state:{
        count:1,
        positions:null,
    },

    mutations:{
        increment: state => state.count *= 2,
        decrement: state => state.count /= 2,
        changePositions (state,location)
        {
            state.positions = {
                latitude : location.latitude,
                longiotude : location.longitude
            }
        }
    },



});
