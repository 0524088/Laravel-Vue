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
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">使用者登入</h2>
                            <form @submit.prevent="login">
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input v-model="account" type="text" class="form-control" id="username" placeholder="" />
                                            <label class="form-label" for="username">帳號</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input v-model="password" type="password" class="form-control" id="password" placeholder="" />
                                            <label class="form-label" for="form2Example2">密碼</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex gap-2 justify-content-between">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="rememberMe" id="rememberMe">
                                                <label class="form-check-label text-secondary" for="rememberMe">
                                                    保持登入
                                                </label>
                                            </div>
                                            <a href="#!" class="link-primary text-decoration-none">忘記密碼?</a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-primary btn-lg" id="btn-login" type="submit">登入</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">還沒有帳號嗎? <a href="#!" class="link-primary text-decoration-none">註冊</a></p>
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

    const Vue = getCurrentInstance().proxy;
    let account  = ref('');
    let password = ref('');

    function login()
    {
        $fetch({
            url: "/auth/login",
            method: "post",
            data: {
                account: account.value,
                password: password.value
            }
        })
        .then((res) => {
            if (res.status != false) {
                Vue.$pinia.login(res.authorisation.token);
                Vue.$router.push({ name: "index" });
            }
        });
    }
</script>