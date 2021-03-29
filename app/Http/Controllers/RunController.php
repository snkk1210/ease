<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playbook;
use App\Models\Authentication;
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

        # Chatworkへの通知
        if (config('chatwork.cw-token')){ Playbook::notify2ChatworkStart($user); };

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # 後付けの認証鍵を設定していなければ、認証方法を更新
        if (is_null($playbook['private_key'])){
            $playbook['private_key'] = Authentication::where('id', $playbook['auth_id'])->get('ssh_key')[0]->ssh_key;
        }

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

        # Chatworkへの通知
        if (config('chatwork.cw-token')){ Playbook::notify2ChatworkEnd($ansible_output[count($ansible_output)-2]); };     

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

        

        # 後付けの認証鍵を設定していなければ、認証方法を更新
        if (is_null($playbook['private_key'])){
            $playbook['private_key'] = Authentication::where('id', $playbook['auth_id'])->get('ssh_key')[0]->ssh_key;
        }

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


    /**
     * playbookパスワード認証実行
     * @param  Request  $request
     */
    public function runPasswd(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        # 実行ユーザで認証処理
        $user = Auth::user();
        Playbook::authRun($user, $target_data);

        # Chatworkへの通知
        if (config('chatwork.cw-token')){ Playbook::notify2ChatworkStart($user); };

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # 後付けの認証鍵を設定していなければ、認証方法を更新
        if (is_null($playbook['private_key'])){
            $playbook['private_key'] = Authentication::where('id', $playbook['auth_id'])->get('ssh_key')[0]->ssh_key;
        }

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

        # パスワード認証利用コマンド
        $passwd = Authentication::where('id', $playbook['auth_id'])->get('ssh_pass')[0]->ssh_pass;
        $add_passwd = "cd ../storage/app/$copy_dir && echo '\n[all:vars]\nansible_ssh_pass=$passwd'>> host";
        # 秘密鍵の権限調整コマンド
        $chmod_key = "cd ../storage/app/$copy_dir && chmod 600 private.pem";
        # ansible実行コマンド
        $run_ansible = "cd ../storage/app/$copy_dir && ansible-playbook -i host main.yml 2>&1";

        # ansible実行
        exec($add_passwd, $add_passwd_output, $add_passwd_return);
        exec($chmod_key, $chmod_key_output, $chmod_key_return);
        exec($run_ansible, $ansible_output, $run_ansible_return);

        # playbook実行用ファイルのクリア
        Storage::delete(["$copy_dir/host", "$copy_dir/group_vars/all.yml", "$copy_dir/main.yml", "$copy_dir/private.pem"]);
        Storage::deleteDirectory("$copy_dir");

        # Chatworkへの通知
        if (config('chatwork.cw-token')){ Playbook::notify2ChatworkEnd($ansible_output[count($ansible_output)-2]); }; 

        return view('return', [
            "ansible_output" => $ansible_output,
        ]);
    }

    /**
     * playbookパスワード認証実行（ドライラン）
     * @param  Request  $request
     */
    public function dryrunPasswd(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        # 実行ユーザで認証処理
        $user = Auth::user();
        Playbook::authRun($user, $target_data);

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # 後付けの認証鍵を設定していなければ、認証方法を更新
        if (is_null($playbook['private_key'])){
            $playbook['private_key'] = Authentication::where('id', $playbook['auth_id'])->get('ssh_key')[0]->ssh_key;
        }

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

        # パスワード認証利用コマンド
        $passwd = Authentication::where('id', $playbook['auth_id'])->get('ssh_pass')[0]->ssh_pass;
        $add_passwd = "cd ../storage/app/$copy_dir && echo '\n[all:vars]\nansible_ssh_pass=$passwd'>> host";
        # 秘密鍵の権限調整コマンド
        $chmod_key = "cd ../storage/app/$copy_dir && chmod 600 private.pem";
        # ansible実行コマンド
        $run_ansible = "cd ../storage/app/$copy_dir && ansible-playbook -i host main.yml -C 2>&1";

        # ansible実行
        exec($add_passwd, $add_passwd_output, $add_passwd_return);
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
