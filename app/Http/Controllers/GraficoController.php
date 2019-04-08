<?php

namespace App\Http\Controllers;

use App\Models\Grafico;
use App\Models\Tipo;
use App\Models\Subtipo;
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
        return view('privada.grafics');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();
        $subtipos = Subtipo::all();
        $centros = Centro::all();
        $animales = Animal::all();
        $data["tipos"] = $tipos;
        $data["subtipos"] = $subtipos;
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
        $grafico = new Grafico();
        $grafico->nombre            = $request->input("nombre");
        $grafico->subtipos_donacion = $request->input("subtipo");
        $grafico->centro            = $request->input("centro");
        $grafico->animales          = $request->input("animales");
        $grafico->mostrar_valor     = $request->input("valor");
        $grafico->tipo_grafico      = $request->input("tipus_grafic");
        $grafico->ordenar           = $request->input("ordenar");
        $grafico->publica           = $request->input("public");

        try
        {
            $grafico->save();
        }
        catch(QueryException $e){

            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('GraficoController@create')->withInput();
        }

        return redirect('privada.grafics');
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
