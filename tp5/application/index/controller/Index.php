<?php

namespace app\index\controller;

use app\index\model\User;
use think\controller;

class Index extends controller
{
    public function index()
    {
        return view('index');
    }

    public function login($username, $password)
    {

        if ($username == "admin" && $password == "admin") {
            return "admin";
        }

        $user = User::get(['username' => $username]);
        if ($user != null && $user->password == $password) {
            return "success";
        } else {
            return "passwordError";
        }
    }

    public function register($username, $password)
    {

        $register = User::get(["username" => $username]);

        if ($register != null) {
            return "exist";
        }

        $user = new User(["username" => $username, "password" => $password]);

        $user->save();

        return "success";

    }

    public function change($username, $password){

        $user = User::get(["username"=>$username]);

        if ($user != null) {

            $user->username = $username;
            $user->password = $password;

            $user->save();

            return "success";
        } else {
            return "notExist";
        }
    }

    public function getUserList()
    {
        $list = User::all();
        return json_encode($list);
    }

    public function getUser($username)
    {
        $user = User::get(["username" => $username]);

        return json_encode($user);
    }

}