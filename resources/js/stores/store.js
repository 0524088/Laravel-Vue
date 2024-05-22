import { defineStore } from 'pinia'

// 建立 store 的實例
export default defineStore("store", {
    state() {
        return {
            token: localStorage.getItem("token")
        }
    },

    actions: {
        login(token = "") {
            localStorage.setItem("token", token);
            this.token = token;
        },
        logout(token = "") {
            localStorage.removeItem("token");
            this.token = token;
        },
    },

    getters: {

    },
});