<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playbook;

class PlayBookController extends Controller
{
    public function index(){
        $playbooks = PlayBook::all();
        return view('playbook', [
            "playbooks" => $playbooks,
        ]);
    }
}
