<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * users テーブルのデータを取得して一覧表示
     */
    public function index(){
        $users = User::all();

        return view('user',[
            "users" => $users,
        ]);
    }
}
