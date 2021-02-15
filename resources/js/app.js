// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// window.Vue = require('vue');

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app',
// });
//require('./bootstrap');

//window.Vue = require('vue');

 require('./bootstrap');
import './bootstrap'
import Vue from 'vue'
import Exampele from './components/ExampleComponent'
import Camera from './components/camera'
import App from './components/App'
import Navbar from './components/navbar'

import VueQrcodeReader from "vue-qrcode-reader";
import { StreamBarcodeReader } from "vue-barcode-reader";
// import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'

import router from './router';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import 'bootstrap/dist/css/bootstrap.min.css'
// import 'bootstrap/dist/bootstrap.min.js'

import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)


// Vue.use(BootstrapVue);
// Vue.use(BootstrapVueIcons);


import VueRouter from 'vue-router';
Vue.use(VueRouter);

Vue.use(VueQrcodeReader);
Vue.component('vue-qr-code-reader', VueQrcodeReader);

Vue.component('Navbar', Navbar);


const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
    
})
