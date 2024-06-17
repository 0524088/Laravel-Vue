import * as components from '@/components'
import { createRouter, createWebHistory } from 'vue-router'
import NProgress from 'nprogress'
import pinia from '@/stores/index.js'
import useStore from '@/stores/store'

// 路由
const routes = [
    {
        path: "/",
        redirect: "/index", // 重定向到 index
        meta: {
            inMenu: false,
        },
    },
    {
        describe: "未定義的頁面",
        path: '/:pathMatch(.*)*',
        component: components.http_404,
        meta: {
            inMenu: false,
        },
    },
    {
        path: "/login",
        name: "login",
        component: components.login,
        meta: {
            inMenu: false,
            text: "登入",
        },
    },
    {
        path: "/logout",
        name: "logout",
        component: components.logout,
        meta: {
            inMenu: false,
            text: "登出",
        },
    },
    {
        path: "/register",
        name: "register",
        component: components.register,
        meta: {
            inMenu: false,
            text: "註冊",
        },
        
    },
    {
        path: "/index",
        name: "index",
        component: components.index,
        meta: {
            inMenu: false,
            text: "首頁",
        },
    },
    {
        path: "/about",
        name: "about",
        component: components.about,
        meta: {
            inMenu: true,
            text: "關於",
        },
    }
];

// 註冊路由
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

const $pinia = useStore(pinia);

// 中間件 - 驗證登入狀態
router.beforeEach(async (to, from) => {
    NProgress.start();
    const res = await $fetch({
        url: "/auth/checkLoginStatus",
        method: "GET",
        token: $pinia.$state.token
    });

    const user = res.user;
    const route = to.name;
    if (user && (route == "login" || route == "register")) {
        // 已登入且為登入頁面
        return { name: "index" };
    }
    if (!user && (route != "login" && route != "register" )) {
        // 未登入且非登入頁面
        return { name: "login" };
    }
});

router.afterEach((to) => {
    NProgress.done();
});
  
export default router;