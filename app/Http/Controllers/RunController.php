<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Playbook;

class RunController extends Controller
{
    public function run(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        $dir = $playbook['repository'];

        Storage::prepend("$dir/host", $playbook['inventory']);
        Storage::prepend("$dir/group_vars/all.yml", $playbook['vars']);
        Storage::prepend("$dir/main.yml", $playbook['main']);
        Storage::prepend("$dir/private.pem", $playbook['private_key']);

        $chmod_key = "cd ../storage/app/$dir && chmod 600 private.pem";
        $run_ansible = "cd ../storage/app/$dir && ansible-playbook -i host main.yml --private-key=private.pem 2>&1";

        exec($chmod_key, $chmod_key_output, $chmod_key_return);
        exec($run_ansible, $run_ansible_output, $run_ansible_return);

        Storage::delete(["$dir/host", "$dir/group_vars/all.yml", "$dir/main.yml", "$dir/private.pem"]);
        return $run_ansible_output;

    }

    public function dryrun(Request $request){
        //
    }
}
