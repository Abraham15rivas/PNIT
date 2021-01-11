
require('./bootstrap');

window.Vue = require('vue');

require("bootstrap-css-only/css/bootstrap.min.css");
require("mdbvue/lib/css/mdb.min.css");
require("@fortawesome/fontawesome-free/css/all.min.css");

import VueGoodTablePlugin from 'vue-good-table'
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);

import home from './pages/home.vue';

import VueRouter from 'vue-router'
Vue.use(VueRouter)


const router = new VueRouter({
    routes: [
        {
            path: '/registrados',
            component: home
        }
    ],
    mode: 'history'
})


const app = new Vue({
    el: '#app',
    router
});
