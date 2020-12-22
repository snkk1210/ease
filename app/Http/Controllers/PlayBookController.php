<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayBookController extends Controller
{
    public function index(){
        return view('playbook');
    }
}
