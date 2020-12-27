<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    /**
     * Profile表示
     */
    public function index(){

        # ログインユーザの情報を取得
        $user = Auth::user();
        $name = $user->name;
        $email = $user->email;

        return view('profile', [
            'name' => $name,
            'email' => $email
        ]);
    }
}
