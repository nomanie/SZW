import Vue from "vue";
import {Ziggy} from './ziggy';
import VueResource from "vue-resource"
import Router from 'vue-router'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import 'bootstrap';
import Vuex from 'vuex';
import store from "./store";
import main from "./router/main";

window.Vue = require('vue').default;
// auth components
Vue.component('register-client', require('../views/auth/components/partials/client.vue').default);
Vue.component('register-workshop', require('../views/auth/components/partials/workshop.vue').default);
Vue.component('login', require('../views/auth/components/login').default);
// Global components
Vue.component('v-select', vSelect)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('card', require('./assets/cards/Card').default);
Vue.component('support', require('./components/Support').default);
Vue.component('messages', require('./components/Messages').default);
Vue.component('calendar', require('./components/Calendar').default);
Vue.component('error-report', require('./components/ErrorReport').default);
Vue.component('v-input', require('./assets/form/error').default);
Vue.component('datatable', require('./components/dataTables').default);
Vue.component('vselect', require('./components/Vselect').default);
//Workshop components
//global
Vue.component('sidebar', require('../views/workshop/components/Sidebar.vue').default);
Vue.component('header-nav', require('../views/workshop/components/Header.vue').default);
//sidebar
Vue.component('dashboard', require('../views/workshop/components/Dashboard.vue').default);
Vue.component('clients', require('../views/workshop/components/Clients').default);
Vue.component('clients-list', require('../views/workshop/components/Clients/List').default);
Vue.component('documents', require('../views/workshop/components/Documents').default);
Vue.component('repairs', require('../views/workshop/components/Repairs').default);
Vue.component('users', require('../views/workshop/components/Users').default);
//header
Vue.component('information', require('../views/workshop/components/Workshop/Information').default);
Vue.component('settings', require('../views/workshop/components/Settings').default);
    //workers
    Vue.component('workers-list', require('../views/workshop/components/Workers/workers/list').default);
    Vue.component('workers-show', require('../views/workshop/components/Workers/workers/show').default);
    //clients
    Vue.component('clients-show', require('../views/workshop/components/Clients/show').default);

// Components for wiki.
Vue.component('wiki-header', require('../views/wiki/components/header.vue').default);
// Admin component
Vue.component('car-brands', require('../views/admin/components/cars/brands/brand').default);

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('datatables.net-bs4');
    require('datatables.net-buttons-bs4');

} catch (e) {}
Vue.use(VueResource);
Vue.use(Router);
Vue.use(Ziggy)
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(Vuex)

Vue.prototype.$store = store;

Vue.http.interceptors.push((request, next) => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    if (token) {
        request.headers.set('X-CSRF-TOKEN', token)
        request.headers.set('Authorization', 'Bearer ' + localStorage.getItem('token'))
        request.headers.set('Type', localStorage.getItem('type'))
    }

    next()
})

//global variables
Vue.http.interceptors.push(function (request) {
    store.dispatch('loader/pending');
    return function (response) {
        store.dispatch('loader/done');
        if (response.status >= 300) {
            this.errors = response.data.errors
            this.$bvToast.toast(response.body.errors ? "Wystąpił błąd w formuląrzu" : response.data.message, {
                title: 'Błąd', variant: 'danger',
            })
        } else {
            this.errors = {}
            this.$bvToast.toast(response.data.message, {
                title: 'Komunikat', variant: 'success',
            })
        }
    }
})

export function priceFormat(number) {
    return number.toFixed(2)
}

const app = new Vue({
    router: main,
    el: '#app',
    store: store
});
