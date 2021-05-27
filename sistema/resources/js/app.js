/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('List', require('./components/List.vue').default);

// Clients
Vue.component('ListClients', require('./components/clients/List.vue').default);
Vue.component('FormClient', require('./components/clients/Form.vue').default);

// Movies
Vue.component('ListMovies', require('./components/movies/List.vue').default);
Vue.component('FormMovies', require('./components/movies/Form.vue').default);

// Rentals
Vue.component('ListRentals', require('./components/rentals/List.vue').default);
Vue.component('FormRentals', require('./components/rentals/Form.vue').default);

// Users
Vue.component('ListUsers', require('./components/users/List.vue').default);
Vue.component('FormUsers', require('./components/users/Form.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
