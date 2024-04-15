<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Auth extends Controller
{

    public function checkLoginStatus(Request $request)
    {
        $token = $request->bearerToken();
        return response()->json([
            'status'  => false,
            'message' => "用戶已登入"
        ]);
    }
}
