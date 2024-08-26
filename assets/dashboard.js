import './bootstrap.js';
import './styles/app.css';

import { createApp } from "vue";
import Dashboard from './components/Dashboard.vue';
import router from './router/index.js';

createApp(Dashboard).use(router).mount('#app');
