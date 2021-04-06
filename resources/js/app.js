require('./bootstrap');
import Vue from 'vue'
import App from './vue/app'
import Modal from "@burhanahmeed/vue-modal-2";

Vue.use(Modal, {
    componentName: "ModalVue"
  });

Vue.config.productionTip = false;
const app = new Vue({
    el: '#app',
    components: { App}
});