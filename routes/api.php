<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Api\Auth;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/auth/checkLoginStatus', [Auth::class, 'checkLoginStatus']);
Route::post('/auth/login', [Auth::class, 'login']);