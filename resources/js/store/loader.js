export default {
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
        },
        reset({commit}) {
            commit("reset")
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
                this.commit("loader/show");
            }

            state.requestsPending++;
        },
        done(state) {
            if (state.requestsPending >= 1) {
                state.requestsPending--;
            }

            if (state.requestsPending <= 0) {
                this.commit("loader/hide");
            }
        },
        reset(state) {
            state.loading = false
            state.requestsPending = 0
        }
    }
};
