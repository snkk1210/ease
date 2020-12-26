<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* welcomeページを無効
Route::get('/', function () {
    //return view('welcome');
    Auth::routes();
});
*/

Route::redirect('/', '/login');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// パスワード更新用のルーティング
Route::get('changepassword', 'App\Http\Controllers\ChangePasswdController@showChangePasswordForm');
Route::post('changepassword', 'App\Http\Controllers\ChangePasswdController@changePassword')->name('changepassword');

Route::get('/playbooks','App\Http\Controllers\PlayBookController@index');
Route::get('/make','App\Http\Controllers\MakeController@index');
Route::post('/register_playbook','App\Http\Controllers\MakeController@register');

Route::post('/edit_playbook','App\Http\Controllers\MakeController@edit');
Route::post('/update_playbook','App\Http\Controllers\MakeController@update');
