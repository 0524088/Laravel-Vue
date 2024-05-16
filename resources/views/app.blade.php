<!DOCTYPE html>
<html>
    <head>
        <title>My SPA</title>
        <script src="{{ asset('js/helper.js') }}"></script>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

        <!-- NProgress 進度條 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nprogress/nprogress.css">

        <!-- 引入 Vue app -->
        @vite('resources/js/main.js')
    </head>
    <body>
        <div id="app">
            <!-- 建立 Vue Router 連結-->
            <div v-if="Menu">
                <ul>
                    <li>
                        <router-link to="/index">Index</router-link>
                    </li>
                </ul>
                <ul>
                    <li>
                        <router-link to="/about">About</router-link>
                    </li>
                </ul>
            </div>
        
            <!-- Vue Router 代入的內容 -->
            <router-view />
        </div>

        <!-- NProgress 進度條 -->
        <script src="https://cdn.jsdelivr.net/npm/nprogress"></script>
    </body>
</html>