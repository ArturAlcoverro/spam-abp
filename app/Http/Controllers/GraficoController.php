<?php

namespace App\Http\Controllers;

use App\Models\Grafico;
use App\Models\Tipo;
use App\Models\Centro;
use App\Models\Animal;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;
use Session;

class GraficoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();
        $centros = Centro::all();
        $animales = Animal::all();
        $data["centros"] = $centros;
        $data["animales"] = $animales;

        return view('privada.grafics', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();
        $centros = Centro::all();
        $animales = Animal::all();
        $data["tipos"] = $tipos;
        $data["centros"] = $centros;
        $data["animales"] = $animales;
        return view('privada.createGrafic', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //var_dump($request);
        $modal = $request->input('modal');
        $tipos = Tipo::all();
        $campos = "";
        $objetivos = "";
        $grafico = new Grafico();
        $grafico->nombre            = $request->input("nombre");
        $grafico->origen            = $request->input("origen");
        $grafico->desti             = $request->input("destino");
        $grafico->animales          = $request->input("animales");
        $grafico->mostrar_valor     = $request->input("valor");
        $grafico->tipo_grafico      = $request->input("tipus_grafic");
        $grafico->ordenar           = $request->input("ordenar");
        $grafico->descripcion              = $request->input("desc");
        if ($modal == "d"){
            $grafico->tema          = 'dades';
        }elseif($modal == "c"){
            $grafico->tema          = 'comparativa';
        }else{
            $grafico->tema          = 'objectiu';
        }

        if ($request->input($modal . "Public") == "on"){
            $grafico->publica       = 1;
        }
        else{
            $grafico->publica       = 0;
        }


        if($request->has($modal . "TipoData")){
            $grafico->tipo_data         = $request->input($modal . "TipoData");
            if ( $request->input($modal . "TipoData") == "dinamic"){
                $grafico->intervalo     = $request->input("cantidad");
                $grafico->magnitud_intervalo = $request->input("medida");
            }
            else{
                $grafico->data_init     = $request->input('dataInit');
                $grafico->data_fin      = $request->input('dataFin');
            }

        }
        else{
            $grafico->tipo_data         = "comp";
        }

        foreach($tipos as $tipo){
            if($request->has($modal . $tipo->nombre)){
                if($request->input($modal . $tipo->nombre) == "on"){
                    if ($campos == ""){
                        $campos = $tipo->id;
                        if($modal == "o"){
                            $objetivos = $request->input('objectiu' . $tipo->nombre);
                        }
                    }
                    else{
                        $campos = $campos . "," . $tipo->id;
                        if($modal == "o"){
                            $objetivos = $objetivos . "," . $request->input('objectiu' . $tipo->nombre);
                        }
                    }
                }
            }
        }

        $grafico->tipos_donacion    = $campos;
        if($objetivos != ""){
            $grafico->objetivos = $objetivos;
        }
        try{
            $grafico->save();
        }
        catch(QueryException $e){

            $error = Utilitat::errorMessage($e);
            var_dump($error);
            $request->session()->flash('error', $error);
            return redirect()->action('GraficoController@create');
        }

        return redirect()->action('GraficoController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grafico  $grafico
     * @return \Illuminate\Http\Response
     */
    public function show(Grafico $grafico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grafico  $grafico
     * @return \Illuminate\Http\Response
     */
    public function edit(Grafico $grafico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grafico  $grafico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grafico $grafico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grafico  $grafico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grafico $grafico)
    {
        //
    }
}
