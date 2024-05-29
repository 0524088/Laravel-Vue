<template>
        <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-3">
                                <a href="#!">
                                    <img src="" alt="Logo" width="175" height="57">
                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">註冊</h2>
                            <form @submit.prevent="register">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input v-model="account" type="text" class="form-control" id="username" placeholder="" required />
                                            <label class="form-label" for="username">帳號</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input v-model="password" type="password" class="form-control" id="password" placeholder="" required />
                                            <label class="form-label" for="form2Example2">密碼</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg" id="btn-register" type="submit">註冊</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { ref, getCurrentInstance } from 'vue'
    import sweetalert from '@/modules/sweetalert2'

    const swal = new sweetalert();
    const Vue = getCurrentInstance().proxy;
    let account  = ref('');
    let password = ref('');

    function register()
    {
        swal.loading({});
        $fetch({
            url: "/auth/register",
            method: "post",
            data: {
                account: account.value,
                password: password.value
            }
        })
        .then((res) => {
            swal.close();
            if (res.status == "success") {
                Vue.$pinia.login(res.authorisation.token);
                swal.show({ title: "登入成功", icon: "success" })
                .then(() => {
                    Vue.$router.push({ name: "index" });
                });
            } else {
                swal.show({ title: res.message });
            }
        });
    }
</script>
