import router from "vue-router";

export default {
    namespaced: true,
    state: {
        authenticated: false,
        // authenticated: false\true\must_change_password\2fa\not_verified
        user: {
            uuid: null,
            token: null,
            type: null,
            email: null,
            is_admin: false
        }
    },
    getters: {
        authenticated(state) {
            return state.authenticated
        },
        user(state) {
            return state.user
        }
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value
        },
        SET_USER(state, value) {
            state.user = {
                email: value.email,
                uuid: value.uuid,
                token: value.token,
                type: value.type
            }
        },
        changePassword(state) {
            state.authenticated = 'must_change_password';
        },
        twoFA(state) {
            state.authenticated = '2fa';
        },
        notVerified(state) {
            state.authenticated = 'not_verified';
        },
        logged(state) {
            state.authenticated = 'logged'
        },
        logout(state) {
            state.user = {
                uuid: null,
                token: null,
                type: null,
                email: null,
                is_admin: false
            }
            state.authenticated = false
        }
    },
    actions: {
        twoFA({ commit }) {
            commit("twoFA");
        },
        changePassword({ commit }) {
            commit("changePassword");
        },
        notVerified({ commit }) {
            commit("notVerified");
        },
        logged({ commit }) {
            commit("logged")
        },
        logout ({ commit }) {
            commit ("logout")
        }
    }
}
