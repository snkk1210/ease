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

// ログイン用ルーティング
Route::redirect('/', '/login');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 認証が必要なルーティング
Route::group(['middleware' => ['auth']], function () {

    // パスワード更新
    Route::get('changepassword', 'App\Http\Controllers\ChangePasswdController@showChangePasswordForm');
    Route::post('changepassword', 'App\Http\Controllers\ChangePasswdController@changePassword')->name('changepassword');
    // ログインユーザのプロファイル
    Route::get('/profile','App\Http\Controllers\ProfileController@index');
    // playbook周り
    Route::get('/playbooks','App\Http\Controllers\PlayBookController@index');
    Route::get('/make','App\Http\Controllers\MakeController@index');
    Route::post('/register_playbook','App\Http\Controllers\MakeController@register');
    Route::post('/edit_playbook','App\Http\Controllers\MakeController@edit');
    Route::post('/update_playbook','App\Http\Controllers\MakeController@update');
    // playbook実行
    Route::post('/exec_playbook','App\Http\Controllers\MakeController@exec');
    Route::post('/dryrun_playbook','App\Http\Controllers\RunController@dryrun');
    Route::post('/run_playbook','App\Http\Controllers\RunController@run');
    // playbook削除
    Route::post('/remove_playbook','App\Http\Controllers\MakeController@remove');

});