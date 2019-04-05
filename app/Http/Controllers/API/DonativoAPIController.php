<?php

namespace App\Http\Controllers\API;

use App\Models\Donativo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonanteResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class DonativoAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donativo = Donativo::with('centro_receptor')
        ->with('centro_desti')
        ->with('subtipo.tipo')
        ->with('donante')
        ->get();

        return DonanteResource::collection($donativo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donativo = new Donativo();

        $donativo->tipos_donantes_id = $request->input('tipos_donante');
        $donativo->cif = $request->input('cif');
        $donativo->telefono = $request->input('telefono');
        $donativo->correo = $request->input('correo');
        $donativo->direccion = $request->input('direccion');
        $donativo->poblacion = $request->input('poblacion');
        $donativo->pais = $request->input('pais');
        $donativo->nombre = $request->input('nombre');
        $donativo->fecha_alta = date('Y-m-d H:i:s');
        $donativo->tipo_colaboracion = $request->input('colaboracion');

        if($request->input('animales') == ""){
            $donativo->tiene_aninales = 0;
        }
        else{
            $donativo->tiene_aninales = 1;
        }

        if($request->input('colaboracion') == ""){
            $donativo->es_colaborador = 0;
        }
        else{
            $donativo->es_colaborador = 1;
        }

        if($request->input('tipos_donante') == 2){
            $donativo->sexos_id = $request->input('sexos');
        }
        elseif($request->input('tipos_donante') == 1){
            $donativo->vinculo_entidad = $request->input('vinculo');
        }

        if($request->input('habitual')=="on"){

            $donativo->es_habitual = 1;
        }
        else{
            $donativo->es_habitual = 0;
        }

        if($request->input('spam')=="on"){

            $donativo->spam = 1;
        }
        else{
            $donativo->spam = 0;
        }

        try{
            $donativo->save();
            $respuesta =  (new DonanteResource($donativo))
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
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donativo = Donativo::find($id);

        return new DonanteResource($donativo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donativo $donativo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donativo  $donativo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donativo = Donativo::find($id);

        try{
            $donativo->delete();
            $respuesta = (new DonanteResource($donativo))
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
