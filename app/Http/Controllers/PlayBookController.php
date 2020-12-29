<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playbook;

class PlayBookController extends Controller
{
    /**
     * playbooksテーブルとusersテーブルの内容を外部結合して一覧表示
     */
    public function index(){
        #$playbooks = PlayBook::all()

        # クエリビルダーを使うことにした
        $playbooks = \DB::table('playbooks')
        ->select('playbooks.id as playbooks_id', 'playbooks.name as playbooks_name', 'playbooks.*', 'users.*')
        ->leftjoin('users','playbooks.owner_id','=' ,'users.id')
        ->get();

        return view('playbook', [
            "playbooks" => $playbooks,
        ]);
    }
}
