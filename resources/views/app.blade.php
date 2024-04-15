<!DOCTYPE html>
<html>
    <head>
        <title>My SPA</title>
        <script src="{{ asset('js/helper.js') }}"></script>
        
        <!-- NProgress 進度條 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nprogress/nprogress.css">

        <!-- 引入 Vue app -->
        @vite('resources/js/main.js')
    </head>
    <body>
        <div id="app">
            <!-- 建立 Vue Router 連結-->
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
        
            <!-- Vue Router 代入的內容 -->
            <router-view />
        </div>

        <!-- NProgress 進度條 -->
        <script src="https://cdn.jsdelivr.net/npm/nprogress"></script>
    </body>
</html>