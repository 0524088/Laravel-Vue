<?php

namespace App\Http\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Validators\Validator;

use App\Repositorys\User as RepositorysUser;

class Auth
{
    private $repositorysUser;
    private $validator;

    public function __construct()
    {
        $this->repositorysUser = app(RepositorysUser::class);
        $this->validator       = app(Validator::class);
    }

    public function login(Request $request)
    {
        // 驗證
        $validation = $this->validator->verifyInput($request, [
            "account"  => "required|string",
            "password" => "required|string"
        ]);

        if (!$validation["status"])
            return $validation["return"];

        $credentials = $request->only("account", "password");
        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json([
                "status"  => "error",
                "message" => "帳號或密碼錯誤",
            ]);
        }

        return response()->json([
                "status" => "success",
                "message" => "登入成功",
                "user"   => auth()->user(),
                "authorisation" => [
                    "token" => $token,
                    "type"  => "bearer",
                    "expires_in" => auth()->factory()->getTTL() * 60    // JWT 有效時間/分鐘
                ]
        ]);
    }

    public function register(Request $request)
    {
        $validation = $this->validator->verifyInput($request, [
            "account"  => "required|string",
            "password" => "required|string"
        ]);

        if (!$validation["status"])
            return $validation["return"];

        $user = $this->repositorysUser->create($request->account, $request->password);
        $token = auth()->login($user);
        return response()->json([
            "status"  => "success",
            "message" => "用戶註冊成功",
            "user"    => $user,
            "authorisation" => [
                "token"      => $token,
                "type"       => "bearer",
                "expires_in" => auth()->factory()->getTTL() * 60    // JWT 有效時間/分鐘
            ]
        ]);
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return response()->json([
                "status"  => "success",
                "message" => "登出成功",
            ]);
        } else {
            return response()->json([
                "status"  => "error",
                "message" => "尚無登入狀態",
            ]);
        }
    }

    public function refresh()
    {
        return response()->json([
            "status"        => "success",
            "user"          => auth()->user(),
            "authorisation" => [
                "token" => auth()->refresh(),
                "type"  => "bearer",
            ]
        ]);
    }

    /**
     * 判斷是否在線
     */
    public function checkLoginStatus()
    {
        if (auth()->check()) {
            return response()->json([
                "status"   => "success",
                "user"     => auth()->user(),
            ]);
        } else {
            return response()->json([
                "status" => "success",
                "user"   => null
            ]);
        }
    }
}
