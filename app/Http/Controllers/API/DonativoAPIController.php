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
        ->with('donante.tipo_donante')
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

        $donativo->cantidad = $request->input('cantidad');
        $donativo->centros_desti_id = $request->input('centro_destino');
        $donativo->centros_receptor_id = $request->input('centro_receptor');
        $donativo->coste = $request->input('coste');
        $donativo->subtipos_id = $request->input('subtipo_donacion');
        $donativo->unidad = $request->input('unidades');
        $donativo->ruta_factura = $request->input('factura');
        $donativo->usuarios_id = $request->input('id_usuario');
        $donativo->donantes_id = $request->input('id_donante');
        $donativo->fecha_donativo = $request->input('fecha');

        $request->input('factura') == true ?
                $donativo->es_coordinada = 1 :
                $donativo->es_coordinada = 0;

        $request->input('factura') == "" ?
                $donativo->hay_factura = 0 :
                $donativo->hay_factura = 1 ;


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