import { createApp } from 'vue'
import router from './router'
import Content from './components/layouts/Content.vue'

import pinia from '@/stores/index'
import useStore from '@/stores/store'

const app = createApp({});

app.component("Content", Content);
app.use(pinia);
app.config.globalProperties.$pinia = useStore(); // 定義在 Vue 全域

app.use(router);
app.mount('#app');