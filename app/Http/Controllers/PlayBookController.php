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

        $playbooks = \DB::table('playbooks')
        ->select('playbooks.id as playbooks_id', 'playbooks.name as playbooks_name', 'playbooks.*', 'users.*')
        ->leftjoin('users','playbooks.owner_id','=' ,'users.id')
        ->where('enable_flag', 0)
        ->get();

        return view('playbook', [
            "playbooks" => $playbooks,
        ]);
    }

    /**
     * playbooksテーブルとusersテーブルの内容を外部結合してアーカイブを一覧表示
     */
    public function archive(){

        $playbooks = \DB::table('playbooks')
        ->select('playbooks.id as playbooks_id', 'playbooks.name as playbooks_name', 'playbooks.*', 'users.*')
        ->leftjoin('users','playbooks.owner_id','=' ,'users.id')
        ->where('enable_flag', 1)
        ->get();

        return view('archive', [
            "playbooks" => $playbooks,
        ]);
    }
}
