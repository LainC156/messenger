
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import store from './store'
import VueRouter from 'vue-router'
import MessengerComponent from './components/MessengerComponent'
import ExampleComponent from './components/ExampleComponent'

Vue.use(BootstrapVue);
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* Vue.component('messenger-component', require('./components/MessengerComponent.vue')); */
Vue.component('contact-component', require('./components/ContactComponent.vue'));
Vue.component('contact-form-component', require('./components/ContactFormComponent.vue'));
Vue.component('contact-list-component', require('./components/ContactListComponent.vue'));
Vue.component('active-conversation-component', require('./components/ActiveConversationComponent.vue'));
Vue.component('message-conversation-component', require('./components/MessageConversationComponent.vue'));
Vue.component('profile-form-component', require('./components/ProfileFormComponent.vue'));

const routes = [
    { path: '/chat', component: MessengerComponent},
    { path: '/chat/:conversationId', component: MessengerComponent }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    store,
    router,
    methods: {
        logout() {
            document.getElementById('logout_form').submit();
        }
    },
});

/**
 * Define logout method globally, because could be used anytime
 * 
 */

