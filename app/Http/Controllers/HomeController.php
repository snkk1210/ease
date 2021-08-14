<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playbook;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $enable_playbook_num = Playbook::where('owner_id', $user->id)
        ->where('enable_flag', 0)
        ->count();

        $disable_playbook_num = Playbook::where('owner_id', $user->id)
        ->where('enable_flag', 1)
        ->count();

        return view('home', [
            "user_name" => $user->name,
            "enable_playbook_num" => $enable_playbook_num,
            "disable_playbook_num" => $disable_playbook_num,
        ]);
    }
}
