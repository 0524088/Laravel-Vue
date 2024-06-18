<template>
    <!-- 建立 Vue Router 連結-->
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg" ref="Nav">
        <div class="container-fluid">
            <router-link to="/index" class="navbar-brand fs-4">Laravel-Vue-Demo</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start bg-primary" id="navbarOffcanvas">
                <div class="offcanvas-header">
                    <router-link class="text-decoration-none" to="/index" @click="hideNavOffcanvas">
                        <h5 class="offcanvas-title text-light fw-bold fs-2">Laravel-Vue-Demo</h5>
                    </router-link>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav" v-for="nav of navList" :key="nav.name" @click="hideNavOffcanvas">
                        <li class="nav-item">
                            <router-link :to="nav.path" class="nav-link fw-bold fs-5">{{ nav.meta.text }}</router-link>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <ul class="navbar-nav" @click="hideNavOffcanvas">
                            <li class="nav-item">
                                <router-link :to="menuLoginStatus.href" class="nav-link fw-bold fs-5">{{ menuLoginStatus.text }}</router-link>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#calculatorOffcanvas"><i class="bi bi-calculator"></i></button>

    <!-- Vue Router 代入的內容 -->
    <router-view/>

    <!-- 計算機 -->
    <calculator/>
</template>

<style scoped>
    .navbar-toggler,
    .offcanvas-header,
    .offcanvas-body {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    /* 調整縮放前 */
    @media (min-width: 992px) {
        .navbar:not(.offcanvas-active) {
            padding: 0;
        }
    }
</style>

<script setup>
    import { ref, onMounted, getCurrentInstance, watch } from 'vue'
    import { calculator } from '@/components';

    const Vue = getCurrentInstance().proxy; // 取得 vue 實例 (等於取得 vue2 的 this)
    const Nav = ref(null);
    let NavbarOffcanvas;

    const Routes = Vue.$router.options.routes;
    const Store = Vue.$pinia.$state;
    let isLogin = ref(false);

    // data()
    let menuLoginStatus = ref({
        href: "",
        text: ""
    });
    let navList = ref([]);

    // event
    onMounted(() => {
        checkLoginStatus(Store.token);

        // 綁定到 bs5 navoffcanvas
        NavbarOffcanvas = new bootstrap.Offcanvas(Nav.value.querySelector("#navbarOffcanvas"));
    });

    // 登入狀態
    watch(() => Store.token,
        (token) => {
            checkLoginStatus(token);
        }
    );

    // 切換 menu 要顯示 Login/Logout
    function checkLoginStatus(token) {
        const router = Vue.$router;
        if (token) {
            const logout = router.resolve({ name: "logout" });
            menuLoginStatus.value = {
                href: logout.href,
                text: logout.meta.text
            }
        } else {
            const login = router.resolve({ name: "login" });
            menuLoginStatus.value = {
                href: login.href,
                text: login.meta.text
            }
        }
        // menu list
        isLogin = (Store.token) ? true : false;
        navList.value = Routes.filter(nav => nav.meta.inMenu && isLogin == nav.meta?.needLogin);
    }

    // 關閉 offcanvas
    function hideNavOffcanvas() {
        NavbarOffcanvas.hide();
    }
</script>