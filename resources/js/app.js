import Vue from "vue";
import {Ziggy} from './ziggy';
import router from './router';
import VueResource from "vue-resource"
import Router from 'vue-router'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
//Vselect
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

window.Vue = require('vue').default;
// auth components
Vue.component('register-client', require('../views/auth/components/client').default);
Vue.component('register-workshop', require('../views/auth/components/workshop').default);
Vue.component('login', require('../views/auth/components/login').default);
// Components
Vue.component('v-select', vSelect)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sidebar', require('./components/workshop/Sidebar.vue').default);
Vue.component('header-nav', require('./components/workshop/Header.vue').default);
Vue.component('dashboard', require('./components/workshop/Dashboard.vue').default);
Vue.component('card', require('./assets/cards/Card').default);
Vue.component('support', require('./components/Support').default);
Vue.component('clients', require('./components/workshop/Clients').default);
Vue.component('clients-list', require('./components/workshop/Clients/List').default);
Vue.component('car-list', require('./components/workshop/Clients/Cars').default);
Vue.component('cars', require('./components/workshop/Clients/Cars').default);
Vue.component('documents', require('./components/workshop/Documents').default);
Vue.component('repairs', require('./components/workshop/Repairs').default);
Vue.component('messages', require('./components/Messages').default);
Vue.component('calendar', require('./components/Calendar').default);
Vue.component('error-report', require('./components/ErrorReport').default);
Vue.component('information', require('./components/workshop/Workshop/Information').default);
Vue.component('settings', require('./components/workshop/Settings').default);
Vue.component('users', require('./components/workshop/Users').default);
Vue.component('v-input', require('./assets/form/error').default);
// Components for wiki.
Vue.component('wiki-header', require('../views/wiki/components/header.vue').default);

Vue.use(VueResource);
Vue.use(Router);
Vue.use(Ziggy)
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.http.interceptors.push((request, next) => {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    if (token) {
        request.headers.set('X-CSRF-TOKEN', token)
    }

    next()
})

Vue.http.interceptors.push(function (request) {
    return function (response) {
        console.log(response)
        if (response.status >= 300) {
            this.$bvToast.toast(response.body.errors ? "Wystąpił błąd w formuląrzu" : response.data.message, {
                title: 'Błąd', variant: 'danger',
            })
        } else {
            this.$bvToast.toast(response.data.message, {
                title: 'Komunikat', variant: 'success',
            })
        }
    }
})

const app = new Vue({
    router, el: '#app',
});
