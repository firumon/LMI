/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Orders from "../components/Orders";

require('./bootstrap');

global.Vue = require('vue');
const VueRouter = require('vue-router').default;
Vue.use(VueRouter);


require('./component-regs');
const routes = _.map(['Orders','Invoices','Deliveries','Receipts'],(item) => _.zipObject(['name','path','component'],[item,item,require('../components/'+item+'.vue').default]));
const router = new VueRouter({ routes,mode:'hash',linkActiveClass:'active' });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
