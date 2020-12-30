<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playbook;
use Illuminate\Support\Facades\Auth;

class MakeController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('make', [
            "owner_id" => $user->id,
        ]);
    }

    /**
     * playbookを登録
     * @param  Request  $request
     */
    public function register(Request $request){

        // repositoryに入力があるか判定
        if (is_null($request->input('repository'))){
            exit('repositoryに正しい値を入力して下さい');
        }

        // 入力データを登録
        $element = new Playbook();
        $element->fill($request->all())->save();

        return redirect('/playbooks');
    }
    
    /**
     * playbook編集
     * @param  Request  $request
     */
    public function edit(Request $request){
        $id = $request->input('id');

        # 実行ユーザで認証処理
        $target_data = Playbook::where('id', $id)->get();
        $user = Auth::user();
        Playbook::authView($user, $target_data);

        $edit_playbook = new Playbook();
        $edit_playbook = $edit_playbook->getArrayParams($target_data);

        return view('edit', [
            "edit_playbook" => $edit_playbook,
        ]);
    }

    /**
     * playbook更新
     * @param  Request  $request
     */
    public function update(Request $request){
        # 実行ユーザで認証処理
        $target_data = Playbook::where('id', $request->input('id'))->get();
        $user = Auth::user();
        Playbook::authRun($user, $target_data);

        # repositoryに入力があるか判定
        if (is_null($request->input('repository'))){
            exit('repositoryに正しい値を入力して下さい');
        }

        # データ更新
        Playbook::where('id', $request->input('id'))->update($request->except(['_token', '_method']));

        return redirect('/playbooks');
    }

    /**
     * playbook実行準備
     * @param  Request  $request
     */
    public function exec(Request $request){
        $id = $request->input('id');

        # 実行ユーザで認証処理
        $target_data = Playbook::where('id', $id)->get();
        $user = Auth::user();
        Playbook::authView($user, $target_data);

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        return view('exec', [
            "playbook" => $playbook,
        ]);
    }

    /**
     * playbook削除
     * @param  Request  $request
     */
    public function remove(Request $request){
        # 実行ユーザで認証処理
        $target_data = Playbook::where('id', $request->input('id'))->get();
        $user = Auth::user();
        Playbook::authRun($user, $target_data);

        Playbook::where('id', $request->input('id'))->delete($request->except(['_token', '_method']));
        return redirect('/playbooks');

    }

}
