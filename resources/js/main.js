import { createApp } from 'vue'
import router from './router'
import Navbar from './components/layouts/Navbar.vue'

import pinia from '@/stores/index'
import useStore from '@/stores/store'

const app = createApp({});

app.component("Navbar", Navbar);
app.use(pinia);
app.config.globalProperties.$pinia = useStore(); // 定義在 Vue 全域

app.use(router);
app.mount('#app');