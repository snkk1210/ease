<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playbook;

class RunController extends Controller
{
    /**
     * playbook実行
     * @param  Request  $request
     */
    public function run(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # playbook実行用ファイル作成
        $dir = $playbook['repository'];
        Storage::prepend("$dir/host", $playbook['inventory']);
        Storage::prepend("$dir/group_vars/all.yml", $playbook['vars']);
        Storage::prepend("$dir/main.yml", $playbook['main']);
        Storage::prepend("$dir/private.pem", $playbook['private_key']);

        # 秘密鍵の権限調整コマンド
        $chmod_key = "cd ../storage/app/$dir && chmod 600 private.pem";
        # ansible実行コマンド
        $run_ansible = "cd ../storage/app/$dir && ansible-playbook -i host main.yml --private-key=private.pem 2>&1";
        exec($chmod_key, $chmod_key_output, $chmod_key_return);
        exec($run_ansible, $ansible_output, $run_ansible_return);

        # playbook実行用ファイルのクリア
        Storage::delete(["$dir/host", "$dir/group_vars/all.yml", "$dir/main.yml", "$dir/private.pem"]);

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

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        # playbook実行用ファイル作成
        $dir = $playbook['repository'];
        Storage::prepend("$dir/host", $playbook['inventory']);
        Storage::prepend("$dir/group_vars/all.yml", $playbook['vars']);
        Storage::prepend("$dir/main.yml", $playbook['main']);
        Storage::prepend("$dir/private.pem", $playbook['private_key']);

        # 秘密鍵の権限調整コマンド
        $chmod_key = "cd ../storage/app/$dir && chmod 600 private.pem";
        # ansible実行コマンド
        $run_ansible = "cd ../storage/app/$dir && ansible-playbook -i host main.yml --private-key=private.pem -C 2>&1";
        exec($chmod_key, $chmod_key_output, $chmod_key_return);
        exec($run_ansible, $ansible_output, $run_ansible_return);

        # playbook実行用ファイルのクリア
        Storage::delete(["$dir/host", "$dir/group_vars/all.yml", "$dir/main.yml", "$dir/private.pem"]);

        return view('return', [
            "ansible_output" => $ansible_output,
        ]);
    }
}
