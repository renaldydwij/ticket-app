/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import moment from 'moment';

import Form from 'vform'
import HasError from 'vform'
import AlertError from 'vform'
window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

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
    { path: '/ticket', component: require('./components/ticket/ticket.vue').default },
    { path: '/profile', component: require('./components/profile/profile.vue').default },
    { path: '/user', component: require('./components/profile/user.vue').default },
    { path: '/rating', component: require('./components/rating/rating.vue').default },/* 
    { path: '/logout', require('./components/dashboard/dashboard.vue').default }, */
  ]


  Vue.filter('myDate',function(created){
    return moment(created).format('MMMM Do YYYY');
  });

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
