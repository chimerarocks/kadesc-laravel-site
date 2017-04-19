
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from       'vue/dist/vue.js'
import store          from './store'

import About 			    from './components/views/about.vue'
import Clients 			  from './components/views/clients.vue'
import Contact 			  from './components/views/contact.vue'
import Apresentation 	from './components/views/apresentation.vue'
import Navigation 		from './components/views/nav.vue'
import Services 		  from './components/views/services.vue'
import Localization		from './components/views/localization.vue'
import LoginModal     from './components/views/_login_modal.vue'

Vue.http.interceptors.push((request, next)  => {
  request.headers.set('X-CSRF-TOKEN', window.Laravel.csrfToken)
  request.headers.set('X-Requested-With', 'XMLHttpRequest')
  request.headers.set('Accept', 'javascript/json')
  next()
});

let app = new Vue({
  el: '#app',
  components: {
  	About,
  	Clients,
  	Apresentation,
  	Navigation,
  	Services,
  	Contact,
  	Localization,
    LoginModal
  },
  store,
  beforeCreate() {
    this.$store.dispatch('load-page')
    this.$store.dispatch('load-services')
    this.$store.dispatch('load-clients')
    this.$store.dispatch('check-auth')
  }
})