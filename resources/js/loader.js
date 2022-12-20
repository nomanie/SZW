import Vuex from 'vuex'
import Vue from 'vue'
Vue.use(Vuex)

const loader = new Vuex.Store({
    namespaced: true,
    state: {
        loading: false,
        requestsPending: 0,
    },
    actions: {
        show({ commit }) {
            commit("show");
        },
        hide({ commit }) {
            commit("hide");
        },
        pending({ commit }) {
            commit("pending");
        },
        done({ commit }) {
            commit("done");
        }
    },
    mutations: {
        show(state) {
            state.loading = true;
        },
        hide(state) {
            state.loading = false;
        },
        pending(state) {
            if (state.requestsPending === 0) {
                this.commit("show");
            }

            state.requestsPending++;
        },
        done(state) {
            if (state.requestsPending >= 1) {
                state.requestsPending--;
            }

            if (state.requestsPending <= 0) {
                this.commit("hide");
            }
        }
    }
});
export default loader
