/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

Vue.use(VueRouter);
Vue.use(VueResource);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app-header', require('./components/app/AppHeader.vue'));
Vue.component('app-footer', require('./components/app/AppFooter.vue'));
Vue.component('tags-list', require('./components/TagsList.vue'));

const routes = [
  {path: '/', component: require('./components/PageIndex.vue')}
];

const router = new VueRouter({
  routes,
  mode: 'history'
});

const app = new Vue({
  router,
  el: '#app',
});
