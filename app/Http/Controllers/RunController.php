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

        //$run_ansible = "cd $repository && ansible-playbook -i $host $main --private-key=$private_key";
        return $playbook;

    }

    public function dryrun(Request $request){
        //
    }
}
