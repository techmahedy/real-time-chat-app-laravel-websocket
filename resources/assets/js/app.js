require('./bootstrap');

window.Vue = require('vue');

//support vuex
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"

const store = new Vuex.Store(
  storeData
)

//Vue chat scrol

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

//Import Vue Filter
require('./filter');

//Import progressbar
require('./progressbar');

//Setup custom events 
require('./customEvents');

//Setup markdownEditor
require('./editor');

//Import View Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//Pagination laravel-vue-pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//Import Sweetalert2
import Swal from 'sweetalert2'
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast = Toast

//Import v-from
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

//Laravel Passport
Vue.component(
  'passport-clients',
  require('./passport/Clients.vue').default
);

Vue.component(
  'passport-authorized-clients',
  require('./passport/AuthorizedClients.vue').default
);

Vue.component(
  'passport-personal-access-tokens',
  require('./passport/PersonalAccessTokens.vue').default
);

//All Frontend Component
//Vue.component('master-component', require('./components/user/MasterComponent.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default);

//Routes
import { routes } from './routes';

//Register Routes
const router = new VueRouter({
  routes,
  mode: 'history'
})

const app = new Vue({
  el: '#app',
  router,
  store, //vuex
  //instant search
  data: {
    search: ''
  },
  methods: {
    // searchit(){
    //   Fire.$emit('searching')
    // }
    //For better performance use dbounce
    searchit: _.debounce(() => {
      Fire.$emit('searching')
    }, 2000),

    printme() { //Print invoice
      window.print()
    }
  }
});
