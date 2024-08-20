import { createRouter, createWebHistory } from 'vue-router';
// import Registration from '../components/Registration.vue';
// import Login from '../components/Login.vue';
// import App from '../components/App.vue';

const routes = [
  // { path: '/registration', component: Registration },
  // { path: '/login', component: Login },
  // { path: '/chat', component: App },
  // autres routes
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
