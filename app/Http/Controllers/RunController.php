<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playbook;

class RunController extends Controller
{
    public function run(Request $request){
        $id = $request->input('id');
        $target_data = Playbook::where('id', $id)->get();

        $playbook = new Playbook();
        $playbook = $playbook->getArrayParams($target_data);

        return $playbook;
    }

    public function dryrun(Request $request){
        //
    }
}
