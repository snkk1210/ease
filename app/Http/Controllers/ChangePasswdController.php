<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangePasswdController extends Controller
{
    /**
     * パスワード更新フォームを表示するアクション
     */
    public function showChangePasswordForm() {
        return view('auth.changepassword');
    }

    // パスワード変更用のメソッド
    /**
     * showChangePasswordForm()からPOSTされた情報を元にパスワードを更新するアクション
     */
    public function changePassword(Request $request) {
        // 現在のパスワードが正しいかを調べる
        if(!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
        }

        // 現在のパスワードと新しいパスワードが違っているかを調べる
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        // パスワードのバリデーション。新しいパスワードは6文字以上、new-password_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        // パスワードを変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        //return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
        return redirect('/');
    }
}
