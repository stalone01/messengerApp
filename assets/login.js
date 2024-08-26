import './bootstrap.js';
import './styles/app.css';

import axios from 'axios';

import { createApp } from 'vue';
import Login from './components/Login.vue';

axios.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
  });

createApp(Login).mount('#app');