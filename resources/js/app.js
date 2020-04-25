import './bootstrap';
import Vue from 'vue';
import Vuetify from '@/js/plugins/vuetify';

import Route from '@/js/routes.js';

import App from '@js/views/App';

Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    vuetify,
    router: Routes,
    render: h => h(App)
});

export default app;
