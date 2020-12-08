require('./bootstrap');

window.Vue = require('vue');

import vuetify from './plugins/vuetify'
import router from "./routerAdmin";
import store from "./store";

import AppComponent from './views/admin/App';

Vue.prototype.$http = axios;

const token = localStorage.getItem('token');
if (token) {
    Vue.prototype.$http.defaults.headers.common['Authorization'] = token;
}

Vue.config.productionTip = false

const app = new Vue({
    el: '#admin',
    vuetify,
    store,
    components: {
        AppComponent
    },
    router
});
