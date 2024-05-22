<template>
    <!-- 建立 Vue Router 連結-->
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <div class="container-fluid">
            <router-link to="/index" class="navbar-brand" href="#">Home</router-link>
            <button @click="changeHamburgetStatus" :status="hamburgerStatus"
                id="hamburger" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" v-for="nav of navList" :key="nav.name">
                    <li class="nav-item">
                      <router-link :to="nav.path" class="nav-link">{{ nav.meta.text }}</router-link>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link :to="menuLoginStatus.href" class="nav-link">{{ menuLoginStatus.text }}</router-link>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <!-- Vue Router 代入的內容 -->
    <router-view />
</template>

<script setup>
    import { ref, onMounted, getCurrentInstance, watch } from 'vue'

    const Vue = getCurrentInstance().proxy; // 取得 vue 實例 (等於取得 vue2 的 this)
    const Routes = Vue.$router.options.routes;
    const Store = Vue.$pinia.$state;

    // data()
    let menuLoginStatus = ref({
        href: "",
        text: ""
    });
    let navList = ref([]);
    let hamburgerStatus = ref(false);

    // event
    onMounted(() => {
        navList.value = Routes.filter(nav => nav.meta.inMenu);
        checkLoginStatus(Store.token);
    });

    // 登入狀態
    watch(() => Store.token,
        (token) => {
            checkLoginStatus(token);
        }
    );

    // 切換路由
    watch(() => Vue.$route,
        () => {
            if (hamburgerStatus.value) {
                document.querySelector("#hamburger").click();
            }
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
    }

    function changeHamburgetStatus() {
        hamburgerStatus.value = !hamburgerStatus.value;
    }
</script>