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

    /**
     * ユーザの編集画面表示
     * @param Request $request
     */
    public function edit(Request $request){
        $id = $request->input('id');

        $user_data = User::where('id', $id)->get();
        
        $edit_user = new User();
        $edit_user = $edit_user->getArrayParams($user_data);
        
        return view('user_edit',[
            "edit_user" => $edit_user,
        ]);
    }
}
