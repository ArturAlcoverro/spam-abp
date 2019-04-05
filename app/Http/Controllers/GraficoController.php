<?php

namespace App\Http\Controllers;

use App\Models\Grafico;
use App\Models\Tipo;
use App\Models\Subtipo;
use App\Models\Centro;
use Illuminate\Http\Request;

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
        $data["tipos"] = $tipos;
        $data["subtipos"] = $subtipos;
        $data["centros"] = $centros;
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
        //
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
