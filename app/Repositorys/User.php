<?php

namespace App\Repositorys;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User as UserModel;

class User
{
    /**
     * 註冊
     */
    public function create($account, $password)
    {

        $user = UserModel::firstOrNew([
            "account"  => $account,
        ]);

        if (!$user->exists) {
            $user->password = Hash::make($password);
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    /**
     * 登入
     */
    public function login($account, $password)
    {
        $user = UserModel::where("account", $account)->first();
        return ($user && Hash::check($password, $user->password)) ? true : false;
    }

    public function fetchUserInfo($token)
    {
        //return DB::table("users")->where("account", $account)->get()->toArray();
        return UserModel::where("remember_token", $token)->get()->toArray();
    }

    /**
     * 判斷 token 是否正確 (判斷是否登入中)
     */
    public function checkToken($token)
    {
        return (UserModel::where("remember_token", $token)) ? true : false;
    }

    /**
     * 註銷 token
     */
    public function destroyToken($token)
    {
        return (UserModel::where("remember_token", $token)->delete() == 1) ? true : false;
    }
}
