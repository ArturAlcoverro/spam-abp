<?php

namespace App\Http\Controllers\API;

use App\Models\Donante;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonanteResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class DonanteAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donantes = Donante::with('tipo_donante')->get();

        return DonanteResource::collection($donantes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $donante = new Donante();

        $donante->tipos_donantes_id = $request->input('tipos_donante');
        $donante->cif = $request->input('cif');
        $donante->telefono = $request->input('telefono');
        $donante->correo = $request->input('correo');
        $donante->direccion = $request->input('direccion');
        $donante->poblacion = $request->input('poblacion');
        $donante->pais = $request->input('pais');
        $donante->nombre = $request->input('nombre');
        $donante->fecha_alta = date('Y-m-d H:i:s');
        $donante->tipo_colaboracion = $request->input('colaboracion');

        if($request->input('animales') == ""){
            $donante->tiene_aninales = 0;
        }
        else{
            $donante->tiene_aninales = 1;
        }

        if($request->input('colaboracion') == ""){
            $donante->es_colaborador = 0;
        }
        else{
            $donante->es_colaborador = 1;
        }

        if($request->input('tipos_donante') == 2){
            $donante->sexos_id = $request->input('sexos');
        }
        elseif($request->input('tipos_donante') == 1){
            $donante->vinculo_entidad = $request->input('vinculo');
        }

        if($request->input('habitual')=="on"){

            $donante->es_habitual = 1;
        }
        else{
            $donante->es_habitual = 0;
        }

        if($request->input('spam')=="on"){

            $donante->spam = 1;
        }
        else{
            $donante->spam = 0;
        }

        try{
            $donante->save();
            $respuesta =  (new DonanteResource($donante))
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
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function show($dni)
    {
        $donante = Donante::where('cif',$dni)->first();

        return new DonanteResource($donante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donante $donante)
    {
        $donante = Donante::find($id_donante);

        $donante->tipos_donantes_id = $request->input('tipos_donante');
        $donante->cif = $request->input('cif');
        $donante->telefono = $request->input('telefono');
        $donante->correo = $request->input('correo');
        $donante->direccion = $request->input('direccion');
        $donante->poblacion = $request->input('poblacion');
        $donante->pais = $request->input('pais');
        $donante->nombre = $request->input('nombre');
        $donante->fecha_alta = date('Y-m-d H:i:s');
        $donante->tipo_colaboracion = $request->input('colaboracion');

        if($request->input('animales') == ""){
            $donante->tiene_aninales = 0;
        }
        else{
            $donante->tiene_aninales = 1;
        }

        if($request->input('colaboracion') == ""){
            $donante->es_colaborador = 0;
        }
        else{
            $donante->es_colaborador = 1;
        }

        if($request->input('tipos_donante') == 2){
            $donante->sexos_id = $request->input('sexos');
        }
        elseif($request->input('tipos_donante') == 1){
            $donante->vinculo_entidad = $request->input('vinculo');
        }

        if($request->input('habitual')=="on"){

            $donante->es_habitual = 1;
        }
        else{
            $donante->es_habitual = 0;
        }

        if($request->input('spam')=="on"){

            $donante->spam = 1;
        }
        else{
            $donante->spam = 0;
        }

        try{
            $donante->save();
            $respuesta =  (new DonanteResource($donante))
                            ->response()
                            ->setStatusCode(200);
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
     * @param  \App\Models\Donante  $donante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_donante)
    {
        $donante = Donante::find($id_donante);

        try{
            $donante->delete();
            $respuesta = (new DonanteResource($donante))
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
