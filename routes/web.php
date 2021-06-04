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
Auth::routes([
    'register' => false,
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 認証が必要なルーティング
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['auth', 'can:system-only']], function () {
            // ユーザ登録
            Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm');
            Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');
            // user一覧
            Route::get('/users','App\Http\Controllers\UserController@index');
            Route::post('/edit_user','App\Http\Controllers\UserController@edit');
            Route::post('/update_user','App\Http\Controllers\UserController@update');
            Route::post('/remove_user','App\Http\Controllers\UserController@remove');
    });

    // パスワード更新
    Route::get('changepassword', 'App\Http\Controllers\ChangePasswdController@showChangePasswordForm');
    Route::post('changepassword', 'App\Http\Controllers\ChangePasswdController@changePassword')->name('changepassword');

    // ログインユーザのプロファイル
    Route::get('/profile','App\Http\Controllers\ProfileController@index');

    // playbook周り
    Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
        // playbook登録
        Route::post('/register_playbook','App\Http\Controllers\MakeController@register');
        // 認証方法登録
        Route::post('/register_auth','App\Http\Controllers\AuthenticationController@register');
    });
    Route::get('/playbooks','App\Http\Controllers\PlayBookController@index');
    Route::get('/archives','App\Http\Controllers\PlayBookController@archive');
    Route::get('/make','App\Http\Controllers\MakeController@index');
    Route::get('/auths','App\Http\Controllers\AuthenticationController@index');
    Route::get('/auth','App\Http\Controllers\AuthenticationController@make');
    Route::post('/edit_playbook','App\Http\Controllers\MakeController@edit');
    Route::post('/disable_playbook','App\Http\Controllers\MakeController@disable');
    Route::post('/enable_playbook','App\Http\Controllers\MakeController@enable');
    Route::post('/edit_auth','App\Http\Controllers\AuthenticationController@edit');
    Route::post('/update_auth','App\Http\Controllers\AuthenticationController@update');
    Route::post('/remove_auth','App\Http\Controllers\AuthenticationController@remove');
    Route::post('/update_playbook','App\Http\Controllers\MakeController@update');
    // playbook実行
    Route::post('/exec_playbook','App\Http\Controllers\MakeController@exec');
    Route::post('/dryrun_playbook','App\Http\Controllers\RunController@dryrun');
    Route::post('/run_playbook','App\Http\Controllers\RunController@run');
    Route::post('/dryrunpass_playbook','App\Http\Controllers\RunController@dryrunPasswd');
    Route::post('/runpass_playbook','App\Http\Controllers\RunController@runPasswd');
    // playbook削除
    Route::post('/remove_playbook','App\Http\Controllers\MakeController@remove');
});