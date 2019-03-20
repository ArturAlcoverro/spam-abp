<?php

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

Route::get('/', function () {
    return view('publica.home');
})->name("home");

Route::get('/login', 'Auth\LoginController@showLogin')->name("showLogin");
Route::post('/login', 'Auth\LoginController@login')->name("login");
Route::get('/logout', 'Auth\LoginController@logout')->name("logout");

Route::get('locale/{locale}', function($locale){
    $request->session()->put('locale', $locale);
    return redirect()->back();
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/index', function () {
        return view('privada.index');
    })->name("index");

    Route::get('/users', function(){
        return view('privada.users');
    })->name("users");

    Route::get('/donants', function(){
        return view('privada.donants');
    })->name("donants");

    Route::get('/donations', function(){
        return view('privada.donations');
    })->name("donations");

    Route::get('/users/create', 'UsuarioController@create')->name("createUser");
});
