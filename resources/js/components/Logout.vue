<template></template>
<script setup>
    import { getCurrentInstance } from 'vue'
    import sweetalert from '@/modules/sweetalert2'

    const Vue = getCurrentInstance().proxy;
    const swal = new sweetalert();

    $fetch({
        url: "/auth/logout",
        method: "get",
        token: Vue.$pinia.$state.token,
        origin: true
    })
    .then((res) => {
        if (res.status == 200) {
            Vue.$pinia.logout();
            swal.show({ title: "登出成功", icon: "success" })
            .then(() => {
                Vue.$router.push({ name: "login" });
            });
        } else {
            swal.show({ title: "登出失敗" });
        }
    });
</script>
