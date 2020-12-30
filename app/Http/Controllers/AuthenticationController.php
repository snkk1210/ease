<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Authentication;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * 認証方法の一覧を表示
     */
    public function index(){
        //$auths = Authentication::all();

        # クエリビルダーを使うことにした
        $auths = \DB::table('authentications')
        ->select('authentications.id as authentications_id', 'authentications.*', 'users.*')
        ->leftjoin('users','authentications.a_owner_id','=' ,'users.id')
        ->get();

        return view('authentication', [
            "auths" => $auths,
        ]);
    }

    /**
     * 認証登録画面を表示
     */
    public function make(){
        $user = Auth::user();
        return view('auth_make', [
            "a_owner_id" => $user->id,
        ]);
    }

    /**
     * 認証方法を登録
     * @param  Request  $request
     */
    public function register(Request $request){

        // 入力データを登録
        $element = new Authentication();
        $element->fill($request->all())->save();

        return redirect('/playbooks');
    }

    /**
     * 認証方法の編集画面表示
     * @param  Request  $request
     */
    public function edit(Request $request){
        $id = $request->input('id');
        $target_data = Authentication::where('id', $id)->get();

        $edit_auth = new Authentication();
        $edit_auth = $edit_auth->getArrayParams($target_data);

        return view('auth_edit', [
            "edit_auth" => $edit_auth,
        ]);
    }

    /**
     * 認証情報の更新
     * @param  Request  $request
     */
    public function update(Request $request){
        # データ更新
        Authentication::where('id', $request->input('id'))->update($request->except(['_token', '_method']));

        return redirect('/auths');
    }

    /**
     * 認証情報の削除
     * @param  Request  $request
     */
    public function remove(Request $request){
        Authentication::where('id', $request->input('id'))->delete($request->except(['_token', '_method']));
        return redirect('/auths');
    }
}
