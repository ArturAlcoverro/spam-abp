<?php

namespace App\Http\Controllers\API;

use App\Models\Tipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipoResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class TipoDonacioAPIController extends Controller
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
        $tipo = new Tipo();

        $tipo->nombre = $request->input('nombre');

        try{
            $tipo->save();
            $respuesta =  (new TipoResource($tipo))
                            ->response()
                            ->setStatusCode(201);
        }
        catch(QueryException $e){

            $mensaje=Utilitat::errorMessage($e);
            $respuesta = response()
                            ->json(['error'=>$mensaje], 400);
        }

        return $respuesta;
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

        return new TipoResource($tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoController  $tipoController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tipo)
    {
        $tipo = Tipo::find($id_tipo);

        $tipo->nombre = $request->input('nombre');

        try{
            $tipo->save();
            $respuesta =  (new TipoResource($tipo))
                            ->response()
                            ->setStatusCode(201);
        }
        catch(QueryException $e){

            $mensaje=Utilitat::errorMessage($e);
            $respuesta = response()
                            ->json(['error'=>$mensaje], 400);
        }

        return $respuesta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoController  $tipoController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipo::find($id);

        try{
            $tipo->delete();
            $respuesta = (new TipoResource($tipo))
                            ->response()
                            ->setStatusCode(200);
        }
        catch(QueryException $e){

            $mensaje = Utilitat::errorMessage($e);
            $respuesta = response()
                           ->json(['error'=>$mensaje], 400);
        }

        return $respuesta;
    }
}
