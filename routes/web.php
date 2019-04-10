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
    Session::put('locale', $locale);
    //$request->session()->put('locale', $locale);
    return redirect()->back();
});

Route::group(['middleware' => ['auth']], function () {

    Route::resource('/donations', 'DonativoController');

    Route::resource('/donants', 'DonanteController');

    Route::resource('/users', 'UsuarioController');

    Route::resource('/grafics', 'GraficoController');

    Route::resource('/centros', 'CentroController');

    Route::resource('/subtipos', 'SubtipoController');

    Route::resource('/tipos', 'TipoController');
});


// Route::get('/formtest', function () {
//     return view("privada/createDonacionMaterial");
// });

//ruta provisional a estadistiques publiques
Route::get('/charts', function(){
    return view('publica.charts');
})->name('charts');
