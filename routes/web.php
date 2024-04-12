<?php

use Illuminate\Support\Facades\Route;

// 將除了 api prefix 的 request 都導向 index.blade.php
Route::get('/{path}', function () {
    return view('app');
})->where('path', '^((?!api).)*$');