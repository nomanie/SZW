/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import './custom';
import { createApp } from 'vue';
import { Ziggy } from './ziggy';
import {ZiggyVue } from './ziggy'
import router from './router';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.use(ZiggyVue);
app.use(Ziggy)
app.use(router);

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import Sidebar from './components/workshop/Sidebar.vue';
app.component('sidebar', Sidebar);

import HeaderNav from './components/workshop/Header.vue';
app.component('header-nav', HeaderNav);

import Dashboard from './components/workshop/Dashboard.vue';
app.component('dashboard', Dashboard);

import Card from './assets/cards/Card';
app.component('card', Card);

import Support from './components/Support';
app.component('support', Support);

import Clients from './components/workshop/Clients';
app.component('clients', Clients);

import ClientList from './components/workshop/Clients/List';
app.component('clients-list', ClientList);

import CarList from './components/workshop/Clients/Cars';
app.component('car-list', CarList);

import Cars from './components/workshop/Clients/Cars';
app.component('cars', Cars);

import Documents from './components/workshop/Documents';
app.component('documents', Documents);

import Repairs from './components/workshop/Repairs';
app.component('repairs', Repairs);

import Messages from './components/Messages';
app.component('messages', Messages);

import Calendar from './components/Calendar'
import {createRouter, createWebHistory} from "vue-router";
app.component('calendar', Calendar);

import ErrorReport from "./components/ErrorReport";
app.component('error-report', ErrorReport);

import Information from "./components/workshop/Information";
app.component('information', Information);

import Settings from "./components/workshop/Settings";
app.component('settings', Settings);

import Users from "./components/workshop/Users";
app.component('users', Users);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
