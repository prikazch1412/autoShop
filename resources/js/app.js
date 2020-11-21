require('./bootstrap');

import Vue from 'vue';
import router from "./routes";
import store from "./store";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VeeValidate, { Validator } from 'vee-validate';
import VueSilentbox from 'vue-silentbox'



import HeaderComponent from './components/site/Header';
import FooterComponent from './components/site/Footer';

Vue.use(VueSilentbox);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VeeValidate);

Vue.prototype.$http = axios;

const token = localStorage.getItem('token');
if (token) {
    Vue.prototype.$http.defaults.headers.common['Authorization'] = token;
}

Vue.config.productionTip = false

const app = new Vue({
    el: '#app',
    components: {
        HeaderComponent,
        FooterComponent
    },
    store,
    router
});
