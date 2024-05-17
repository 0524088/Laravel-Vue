<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\JwtMiddleware;

use App\Http\Api\Auth;


Route::prefix("/auth")->controller(Auth::class)->group(function() {
    Route::post("login", "login");        // 登入
    Route::post("register", "register");  // 註冊
    Route::get("logout", "logout")->middleware([JwtMiddleware::class]); // 登出
});

Route::middleware([JwtMiddleware::class])->group(function() {

});