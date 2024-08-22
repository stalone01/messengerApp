import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/Dashboard.vue';
// import Login from '../components/Login.vue';
// import App from '../components/App.vue';

const routes = [
  { path: '/dashboard', component: Dashboard },
  // { path: '/login', component: Login },
  // { path: '/chat', component: App },
  // autres routes
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
