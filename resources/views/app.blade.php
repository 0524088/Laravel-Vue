<!DOCTYPE html>
<html>
    <head>
        <title>My SPA</title>
        <script src="{{ asset('js/helper.js') }}"></script>
        
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
    </body>
</html>