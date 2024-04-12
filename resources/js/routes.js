import * as components from './components'

const routes = [
    { 
        path: '/',
        redirect: '/home'// 重定向到 /home
    },
    {
        path: "/home",
        name: "Home",
        component: components.Home
    },
    {
        path: "/about",
        name: "About",
        component: components.About
    }
];

export default routes;