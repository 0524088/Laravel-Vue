import * as components from './components'
import { createRouter, createWebHistory } from 'vue-router'
import NProgress from 'nprogress'

// 路由
const routes = [
    {
        path: "/",
        redirect: "/index" // 重定向到 index
    },
    {
        describe: "未定義的頁面",
        path: '/:pathMatch(.*)*',
        component: components.http_404
    },
    {
        path: "/login",
        name: "login",
        component: components.Login,
    },
    {
        path: "/index",
        name: "index",
        component: components.Index
    },
    {
        path: "/about",
        name: "about",
        component: components.About
    }
];

// 註冊路由
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

// 中間件 - 驗證登入狀態
router.beforeEach(async (to) => {
    NProgress.start();
    let res = await $_fetch({
        url: "/api/auth/checkLoginStatus",
        method: "GET",
        useToken: true
    });

    const status = res.status;
    const route  = to.name;

    if (status == true && route == "login") {
        // 已登入且為登入頁面
        return { name: "index" };
    }
    if (status != true && route != "login") {
        // 未登入且非登入頁面
        return { name: "login" };
    }
});

router.afterEach((to) => {
    NProgress.done()
});
  

export default router;