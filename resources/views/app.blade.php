<!DOCTYPE html>
<html>
    <head>
        <title>My SPA</title>

        <!-- 引入 Vue app -->
        @vite('resources/js/main.js')
    </head>
    <body>
        <div id="app">
            <!-- 建立 Vue Router 連結-->
            <ul>
                <li>
                    <router-link to="/home">Home</router-link>
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