/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import "bootstrap/dist/css/bootstrap.min.css";

import "datatables.net/js/jquery.dataTables.min.js";
import "datatables.net-bs4";
import "datatables.net-bs4/css/dataTables.bootstrap4.min.css";
import "datatables.net-bs4/js/dataTables.bootstrap4.js";
import "jszip";
import "pdfmake";
import "datatables.net-buttons-bs4";
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css";

import "datatables.net-buttons/js/dataTables.buttons.js";

import "datatables.net-buttons/js/buttons.colVis.js";
import "datatables.net-buttons/js/buttons.flash.js";
import "datatables.net-buttons/js/buttons.html5.js";
import "datatables.net-buttons/js/buttons.print.js";

import moment from 'moment';

import Form from 'vform'
import HasError from 'vform'
import AlertError from 'vform'

/* import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user); */


window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

let Fire =new Vue();
  window.Fire = Fire;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Import Alert
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;

import VueProgressBar from 'vue-progressbar'
import Vue from 'vue';
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
  })

let routes = [
    { path: '/dashboard', component: require('./components/dashboard/dashboard.vue').default},
    { path: '/customer', component: require('./components/management/customer.vue').default},
    { path: '/status', component: require('./components/management/status.vue').default },
    { path: '/priority', component: require('./components/management/priority.vue').default },
    { path: '/profile', component: require('./components/profile/profile.vue').default },
    { path: '/user', component: require('./components/profile/user.vue').default },
    { path: '/rating', component: require('./components/rating/rating.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default },
    { path: '/ticket', name: 'ticket', component: require('./components/ticket/ticket.vue').default},
    /* 
    { path: '/password/reset', name: 'resetpassword', component: require('./components/resetpassword.vue').default}, */

    //ujicoba
    { path: '/ticket-user', name: 'ticket-user', component: require('./components/ticket/ticket-user.vue').default},
    { path: '/ticket-admin', name: 'ticket-admin', component: require('./components/ticket/ticket-admin.vue').default},
    { path: '/detail-user{:id}', name: 'detail-user', component: require('./components/ticket/detail-ticket-user.vue').default},
    //------//
    
    { path: '/detail{:id}', name: 'detail', component: require('./components/ticket/detail-ticket.vue').default},

    
    
  ]


  Vue.filter('myDate',function(created){
    return moment(created).format('MMMM Do YYYY');
  });

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('not-found', require('./components/NotFound.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//rating
Vue.component('start-rating', {
  template: '#Start-rating',
  props: ['max', 'current'],
  computed: {
    getRating: function(){
      return (this.current / this.max) * 100
    }
  }
})

const app = new Vue({
    el: '#app',
    data: {
      value: 5
    },
    router
});
