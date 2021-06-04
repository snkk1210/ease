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

    /**
     * ユーザ情報の更新
     * @param Request $request
     */
    public function update(Request $request){
        
        User::where('id', $request->input('id'))->update($request->except(['_token', '_method']));

        return redirect('/users');
    }

    /**
     * ユーザの削除
     * @param Request $request
     */
    public function remove(Request $request){

        User::where('id', $request->input('id'))->delete($request->except(['_token', '_method']));

        return redirect('/users');
    }
}
