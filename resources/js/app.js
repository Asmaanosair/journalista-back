require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Routes from './routes';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueSweetAlert2 from 'vue-sweetalert2';
Vue.config.productionTip = false
Vue.use(VueSweetAlert2);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
axios.defaults.baseURL = '/admin';
Vue.component('main-component', require('./components/Main.vue').default);
Vue.component('notification-component', require('./components/admin/notification/Notification').default);
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );
const app = new Vue({
    el: '#main-wrapper',
    router: new VueRouter(Routes),


});








