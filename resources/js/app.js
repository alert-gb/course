require('./bootstrap');

import { createApp } from "vue";





import App from './App.vue';
import routes from './routes.js';
import store from "./store/index.js";
import Toaster from "@meforma/vue-toaster";



import TheModal from "./components/UI/TheModal.vue";
import ModalButton from "./components/UI//ModalButton.vue";
import BaseSpinner from "./components/UI//BaseSpinner.vue";

const app = createApp(App);

app.component('the-modal', TheModal);
app.component('modal-button', ModalButton);
app.component('base-spinner', BaseSpinner);


app.use(routes);
app.use(store);
app.use(Toaster, {
    position: "top-right",
    duration: 6000,
});


app.mount('#app');

