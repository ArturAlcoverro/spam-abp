<?php

namespace App\Http\Controllers\API;

use App\Models\Centro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CentroResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class CentroAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros = Centro::all();

        return CentroResource::collection($centros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $centro = new Centro();

        $centro->nombre = $request->input('nombre');

        try{
            $centro->save();
            $respuesta =  (new CentroResource($centro))
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
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function show(Centro $centro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_centro)
    {
        $centro = Centro::find($id_centro);

        $centro->nombre = $request->input('nombre');

        try{
            $centro->save();
            $respuesta =  (new CentroResource($centro))
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
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centro $centro)
    {
        //$centro = Centro::find($id_centro);

        try{
            $centro->delete();
            $respuesta = (new CentroResource($centro))
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
