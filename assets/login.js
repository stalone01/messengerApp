import './bootstrap.js';
import './styles/app.css';

import axios from 'axios';

import { createApp } from 'vue';
import Login from './components/Login.vue';
import router from './router/index.js';

axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  });

createApp(Login).use(router).mount('#app');