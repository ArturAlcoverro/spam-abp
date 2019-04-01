<?php

namespace App\Http\Controllers\API;

use App\Models\Tipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipoResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class TipoDonacioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();

        return TipoResource::collection($tipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoController  $tipoController
     * @return \Illuminate\Http\Response
     */
    public function show($id_tipo)
    {
        $tipo = Tipo::find($id_tipo);

        return new TipoRersource($tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoController  $tipoController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoController $tipoController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoController  $tipoController
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoController $tipoController)
    {
        //
    }
}
