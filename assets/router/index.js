import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/Dashboard.vue';
import Login from '../components/Login.vue';
import App from '../components/App.vue';
import Registration from '../components/Registration.vue';

const routes = [
  { path: '/dashboard', component: Dashboard },
  { path: '/login', component: Login },
  { path: '/logout', component: Login },
  { path: '/chat', component: App },
  { path: '/registration', component: Registration },
  // autres routes
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
