import './bootstrap'
import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes'

const app = createApp({});
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

app.use(router).mount('#app');
