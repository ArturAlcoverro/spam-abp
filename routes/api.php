<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/donants', 'API\DonanteAPIController');
Route::apiResource('/donations', 'API\DonativoAPIController');
Route::apiResource('/users', 'API\UsuarioAPIController');
Route::apiResource('/tipos', 'API\TipoDonacioAPIController');
Route::apiResource('/subtipos', 'API\SubtipoAPIController');
Route::apiResource('/centros', 'API\CentroAPIController');

Route::apiResource('/filtro', 'API\FiltroAPIController');

Route::get("/estadisticas/donativos/{dataInici}/{dataFi}", 'API\EstadisticasController@DonatiusByData');
Route::get("/grafico", 'API\GraficoApiController@index');

Route::get("/filtro/{fechaInicio}/{fechaFinal}", 'API\FiltroAPIController@show');
