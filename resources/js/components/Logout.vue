<template></template>
<script setup>
    import { getCurrentInstance } from 'vue'

    const Vue = getCurrentInstance().proxy;

    $fetch({
        url: "/auth/logout",
        method: "get",
        token: Vue.$pinia.$state.token,
        origin: true
    })
    .then((res) => {
        if (res.status == 200) {
            Vue.$pinia.logout();
            Vue.$router.push({ name: "login" });
        }
    });
</script>
