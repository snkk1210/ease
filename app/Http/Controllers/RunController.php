<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playbook;
use Illuminate\Support\Facades\Auth;

class RunController extends Controller
{
    /**
     * playbook実行
     * @param  Request  $request
     */
    public function run(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        # 実行ユーザで認証処理
        $user = Auth::user();
        Playbook::authRun($user, $target_data);

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # playbookのレポジトリディレクトリ
        $dir = $playbook['repository'];

        # ランダムなディレクトリ名を生成
        $copy_dir = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 16);

        # tmpディレクトリを生成
        $copy_repo = "cd ../storage/app && cp -rp $dir $copy_dir";
        exec($copy_repo, $copy_repo_output, $copy_repo_return);

        # playbook実行ファイルを生成
        Storage::prepend("$copy_dir/host", $playbook['inventory']);
        Storage::prepend("$copy_dir/group_vars/all.yml", $playbook['vars']);
        Storage::prepend("$copy_dir/main.yml", $playbook['main']);
        Storage::prepend("$copy_dir/private.pem", $playbook['private_key']);

        # 秘密鍵の権限調整コマンド
        $chmod_key = "cd ../storage/app/$copy_dir && chmod 600 private.pem";
        # ansible実行コマンド
        $run_ansible = "cd ../storage/app/$copy_dir && ansible-playbook -i host main.yml --private-key=private.pem 2>&1";

        # ansible実行
        exec($chmod_key, $chmod_key_output, $chmod_key_return);
        exec($run_ansible, $ansible_output, $run_ansible_return);

        # playbook実行用ファイルのクリア
        Storage::delete(["$copy_dir/host", "$copy_dir/group_vars/all.yml", "$copy_dir/main.yml", "$copy_dir/private.pem"]);
        Storage::deleteDirectory("$copy_dir");

        return view('return', [
            "ansible_output" => $ansible_output,
        ]);
    }

    /**
     * playbook実行（ドライラン）
     * @param  Request  $request
     */
    public function dryrun(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        # 実行ユーザで認証処理
        $user = Auth::user();
        Playbook::authRun($user, $target_data);

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # playbookのレポジトリディレクトリ
        $dir = $playbook['repository'];

        # ランダムなディレクトリ名を生成
        $copy_dir = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 16);

        # tmpディレクトリを生成
        $copy_repo = "cd ../storage/app && cp -rp $dir $copy_dir";
        exec($copy_repo, $copy_repo_output, $copy_repo_return);

        # playbook実行ファイルを生成
        Storage::prepend("$copy_dir/host", $playbook['inventory']);
        Storage::prepend("$copy_dir/group_vars/all.yml", $playbook['vars']);
        Storage::prepend("$copy_dir/main.yml", $playbook['main']);
        Storage::prepend("$copy_dir/private.pem", $playbook['private_key']);

        # 秘密鍵の権限調整コマンド
        $chmod_key = "cd ../storage/app/$copy_dir && chmod 600 private.pem";
        # ansible実行コマンド
        $run_ansible = "cd ../storage/app/$copy_dir && ansible-playbook -i host main.yml --private-key=private.pem -C 2>&1";

        # ansible実行
        exec($chmod_key, $chmod_key_output, $chmod_key_return);
        exec($run_ansible, $ansible_output, $run_ansible_return);

        # playbook実行用ファイルのクリア
        Storage::delete(["$copy_dir/host", "$copy_dir/group_vars/all.yml", "$copy_dir/main.yml", "$copy_dir/private.pem"]);
        Storage::deleteDirectory("$copy_dir");

        return view('return', [
            "ansible_output" => $ansible_output,
        ]);
    }
}
