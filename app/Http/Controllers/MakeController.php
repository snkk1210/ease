<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playbook;

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

        // postデータを登録
        $post = new Playbook();
        $post->fill($request->all())->save();

        return view('home');
    }
    
}
