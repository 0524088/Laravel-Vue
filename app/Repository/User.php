<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\User as UserModel;

class User
{
    public function fetchUserInfo($account)
    {
        //return DB::table("users")->where("account", $account)->get()->toArray();
        return UserModel::where("account", $account)->get()->toArray();
    }

    /**
     * 儲存 token
     */
    public function storeToken($account, $token)
    {
        return (UserModel::where("account", $account)->update([ "remember_token" => $token ]) == 1) ? true : false;
    }
}
