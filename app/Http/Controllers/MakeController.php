<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MakeController extends Controller
{
    public function index(){
        return view('make');
    }

    /**
     * playbookを登録
     * @param  Request  $request
     */
    public function register(Request $request){
        $name = $request->input('name');
        $repository = $request->input('repository');
        $enable_flag = $request->input('enable_flag');
        $private_key = $request->input('private_key');
        $inventory = $request->input('inventory');
        $vars = $request->input('vars');
        $main = $request->input('main');
    }
    
}
