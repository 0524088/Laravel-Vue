<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

            </div>
            <table class="table border boder-2">
                <tr>
                    <th>商品名稱</th>
                    <th>成本</th>
                    <th>售價</th>
                    <th>庫存數量</th>
                    <th>賣出數量</th>
                    <th>建立時間</th>
                </tr>
                <tr v-for="a in []">
                    <td v-for="b in []"></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script setup>
    import { getCurrentInstance } from 'vue'

    
    

</script>
