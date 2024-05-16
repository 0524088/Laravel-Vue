<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth as LaravelAuth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use App\Repository\User as UserRepository;

class Auth
{
    private $userRepository;

    public function __construct() {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * 驗證登入狀態
     */
    public function checkLoginStatus(Request $request)
    {
        return response()->json([
            "status"  => false,
            "message" => "用戶已登入"
        ]);
    }

    /**
     * 登入
     */
    public function login(Request $request)
    {
        try {
            // 驗證
            $request->validate([
                "account"  => "required|string",
                "password" => "required|string"
            ]);

            // 登入
            $credentials = $request->only("account", "password");
            if (LaravelAuth::attempt($credentials)) {
                $token = Str::random(60);
                $user = LaravelAuth::user();
                $user->remember_token = $token;
                $user->save();

                return response()->json([
                    "status"  => true,
                    "message" => "登入成功",
                    "remember_token" => $token
                ]);
            } else {
                // 认证失败，检查失败原因
                // $lastAttempted = LaravelAuth::getLastAttempted();
                return response()->json([
                    "status"  => false,
                    "message" => "登入失敗，帳號或密碼錯誤"
                ]);
            }
        } catch(ValidationException $e) {
            return response()->json([
                "status"  => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
