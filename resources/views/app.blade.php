<!DOCTYPE html>
<html>
    <head>
        <title>My SPA</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <!-- NProgress 進度條 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nprogress/nprogress.css">

        <!-- Sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- 引入 Vue app -->
        @vite('resources/js/main.js')

        <script src="{{ asset('js/helper.js') }}"></script>
    </head>
    <body>
        <div id="app">
            <Content />
        </div>

        <!-- NProgress 進度條 -->
        <script src="https://cdn.jsdelivr.net/npm/nprogress"></script>
    </body>
</html>