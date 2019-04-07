<?php

namespace App\Http\Controllers;

use App\Models\Subtipo;
use App\Models\Tipo;
use Illuminate\Http\Request;

class SubtipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::all();
        $data["tipos"] = $tipos;

        return view('privada.subtipus', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all();
        $unidades = array(
            "kg",
            "g",
            "l",
            "ml",
            "cm",
            "m"
        );

        $data['unidades'] = $unidades;
        $data['tipos'] = $tipos;
        return view('privada.createSubtipo', $data);

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
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function show(Subtipo $subtipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id_subtipo)
    {
        $subtipo = Subtipo::find($id_subtipo);
        $tipos = Tipo::all();
        $unidades = array(
            "kg",
            "g",
            "l",
            "ml",
            "cm",
            "m"
        );

        $data['unidades'] = $unidades;
        $data['subtipo'] = $subtipo;
        $data['tipos'] = $tipos;

        return view('privada.editSubtipo', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_subtipo)
    {
        $subtipo = Subtipo::find($id_subtipo);

        $subtipo->nombre = $request->input('nombre');
        $subtipo->tipos_id = $request->input('tipos');
        $subtipo->gama_alta = $request->input('gama_alta');
        $subtipo->gama_media = $request->input('gama_media');
        $subtipo->gama_baja = $request->input('gama_baja');
        $subtipo->tipo_unidad = $request->input('unidad');

        try
        {
            $subtipo->save();
        }
        catch(QueryException $e){
            $error = Utilitat::errorMessage($e);
            $request->session()->flash('error', $error);
            return redirect()->action('SubtipoController@edit')->withInput();
        }

        return redirect()->action('SubtipoController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtipo  $subtipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtipo $subtipo)
    {
        //
    }
}