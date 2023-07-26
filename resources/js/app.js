import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js'
import './style.css'
import store from './store/store.js'
import router from './router/index.js'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import App from './App.vue'

createApp(App)
.use(store)
.use(router)
.use(VueSweetalert2).
mount('#app')
