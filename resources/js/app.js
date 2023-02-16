import './bootstrap';

import { createApp } from 'vue'
import App from './app.vue'
import router from '../js/router';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'

window.Swal = Swal
const toast = Swal.mixin({
    toast:true,
    postition:'top-end',
    showConfirmButton:false,
    timer:3000,
    timeProgressBar:true
})
window.toast = toast

const app = createApp(App)
app.use(router);
app.mount('#app');
